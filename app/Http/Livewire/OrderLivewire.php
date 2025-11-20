<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;


class OrderLivewire extends BaseLivewireComponent
{
    //
    public $model = Order::class;
    //
    public $orderId;
    public $deliveryBoyId;
    public $status;
    public $paymentStatus;
    public $note;

    //
    public $orderStatus;
    public $orderPaymentStatus;
    public $isPickup;
    public $filterType = null;



    public function getListeners()
    {
        return $this->listeners + [
            'autocompleteDeliveryAddressSelected' => 'autocompleteDeliveryAddressSelected',
            'deliveryBoyIdUpdated' => 'autocompleteDriverSelected',
        ];
    }

    public function mount()
    {
        // Detect if we are in 'order.success' route
        if (request()->routeIs('order.success')) {
            $this->filterType = 'delivered';
        }
    }

    public function render()
    {
        // return view('livewire.orders');
        $query = Order::with(['user', 'driver', 'statuses']);

    if ($this->filterType === 'delivered') {
        $query->whereHas('statuses', function($q) {
            $q->where('name', 'delivered')
              ->where('model_type', Order::class);
        });
    }

    $orders = $query->latest()->paginate($this->perPage);
    // dd($orders);

    return view('livewire.orders', [
        'orders' => $orders,
    ]);
    }


    public function loadCustomData()
    {
        if (empty($this->orderStatus)) {
            $this->orderStatus = $this->orderStatus();
        }
        if (empty($this->orderPaymentStatus)) {
            $this->orderPaymentStatus = $this->orderPaymentStatus();
        }
    }

    public function autocompleteDriverSelected($value)
    {
        try {
            //clear old products
            $this->deliveryBoyId = $value['value'];
        } catch (\Exception $ex) {
            logger("Error", [$ex]);
        }
    }

    public function showDetailsModal($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->orderId = $id;
        $this->showDetails = true;
        $this->stopRefresh = true;
    }

    // Updating model
    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->deliveryBoyId = $this->selectedModel->driver_id;
        $this->status = $this->selectedModel->status;
        $this->paymentStatus = $this->selectedModel->payment_status;
        $this->note = $this->selectedModel->note;
        $this->loadCustomData();
        //
        if ($this->deliveryBoyId != null) {
            $this->emit('deliveryBoyId_Loaded', $this->deliveryBoyId);
        }
        $this->showEditModal();
    }


    public function update()
    {
        try {
            DB::beginTransaction();

            // Update order details
            $this->selectedModel->driver_id = $this->deliveryBoyId ?? null;
            $this->selectedModel->payment_status = $this->paymentStatus;
            $this->selectedModel->note = $this->note;
            $this->selectedModel->setStatus($this->status);
            $this->selectedModel->save();

            DB::commit();

            // Send push notification
            $this->sendPushNotification(
                'Order Updated',
                'Your order #' . $this->selectedModel->id . ' status changed to ' . $this->status,
                [
                    'order_id' => (string) $this->selectedModel->id,
                    'status' => (string) $this->status,
                ]
            );

            // 2️⃣ Send notification to driver if assigned
            if ($this->deliveryBoyId) {
                $driver = User::find($this->deliveryBoyId);
                if ($driver) {
                    $this->sendPushNotificationToUser(
                        $driver,
                        'New Order Assigned',
                        'You have been assigned to order #' . $this->selectedModel->id,
                        [
                            'order_id' => (string) $this->selectedModel->id,
                            'status'   => (string) $this->status,
                        ]
                    );
                }
            }

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Order") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (\Exception $error) {
            DB::rollback();
            \Log::error("Order update failed for order #{$this->selectedModel->id}: " . $error->getMessage());
            $this->showErrorAlert($error->getMessage() ?? __("Order") . " " . __('update failed!'));
        }
    }

    // protected function sendPushNotification(string $title, string $body, array $data = [])
    // {
    //     $user = $this->selectedModel->user;

    //     if (!$user) {
    //         \Log::warning("Order #{$this->selectedModel->id} has no associated user.");
    //         return;
    //     }

    //     // Get all valid tokens for this user (ignore empty/malformed)
    //     $tokens = $user->userTokens()
    //         ->whereNotNull('token')
    //         ->pluck('token')
    //         ->toArray();

    //     if (!$tokens || !str_contains($tokens, ':')) {
    //         \Log::warning("User ID {$user->id} has no valid FCM token.");
    //         return;
    //     }

    //     $tokens = [$tokens];

    //     try {
    //         $factory = (new \Kreait\Firebase\Factory)
    //             ->withServiceAccount(storage_path('app/vault/firebase_service.json'));

    //         $messaging = $factory->createMessaging();

    //         $notification = \Kreait\Firebase\Messaging\Notification::create($title, $body);

    //         $message = \Kreait\Firebase\Messaging\CloudMessage::new()
    //             ->withNotification($notification)
    //             ->withData(array_merge($data, [
    //                 'order_id' => (string) $this->selectedModel->id,
    //                 'status'   => (string) $this->status,
    //             ]));

    //         // Send to all valid tokens
    //         $report = $messaging->sendMulticast($message, $tokens);

    //         foreach ($report->getItems() as $index => $response) {
    //             $token = $tokens[$index];

    //             if ($response->isSuccess()) {
    //                 \Log::info("Push sent successfully to token: {$token}");
    //             } else {
    //                 $exception = $response->error();
    //                 \Log::warning("Push failed for token {$token}: " . $exception->getMessage());

    //                 // Delete invalid tokens
    //                 if ($exception instanceof \Kreait\Firebase\Exception\Messaging\InvalidMessage) {
    //                     \DB::table('user_tokens')->where('token', $token)->delete();
    //                     \Log::info("Cleared invalid token {$token} from user_tokens table.");
    //                 }
    //             }
    //         }
    //     } catch (\Throwable $e) {
    //         \Log::error("Push notification error for order #{$this->selectedModel->id}: " . $e->getMessage());
    //     }
    // }

    protected function sendPushNotification(string $title, string $body, array $data = [])
    {
        $user = $this->selectedModel->user;

        if (!$user) {
            \Log::warning("Order #{$this->selectedModel->id} has no associated user.");
            return;
        }

        // Get all valid tokens for this user
        $tokens = $user->userTokens()
            ->whereNotNull('token')
            ->orderByDesc('created_at')
            ->pluck('token')
            ->toArray();

        $tokens = array_unique($tokens);

        if (empty($tokens)) {
            \Log::warning("User ID {$user->id} has no valid FCM token.");
            return;
        }

        try {
            $factory = (new \Kreait\Firebase\Factory)
                ->withServiceAccount(storage_path('app/vault/firebase_service.json'));

            $messaging = $factory->createMessaging();

            $notification = \Kreait\Firebase\Messaging\Notification::create($title, $body);

            $message = \Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification($notification)
                ->withData(array_merge($data, [
                    'order_id' => (string) $this->selectedModel->id,
                    'status'   => (string) $this->status,
                ]));

            // Send to all valid tokens
            $report = $messaging->sendMulticast($message, $tokens);

            foreach ($report->getItems() as $index => $response) {
                $token = $tokens[$index];

                if ($response->isSuccess()) {
                    \Log::info("Push sent successfully to token: {$token}");
                } else {
                    $exception = $response->error();
                    \Log::warning("Push failed for token {$token}: " . $exception->getMessage());

                    // Delete invalid tokens
                    if ($exception instanceof \Kreait\Firebase\Exception\Messaging\InvalidMessage) {
                        \DB::table('user_tokens')->where('token', $token)->delete();
                        \Log::info("Cleared invalid token {$token} from user_tokens table.");
                    }
                }
            }
        } catch (\Throwable $e) {
            \Log::error("Push notification error for order #{$this->selectedModel->id}: " . $e->getMessage());
        }
    }


    // protected function sendPushNotificationToUser($user, string $title, string $body, array $data = [])
    // {
    //     if (!$user) return;

    //     // Get all valid FCM tokens
    //     $tokens = $user->userTokens()->pluck('token')->filter(function ($token) {
    //         return !empty($token) && str_contains($token, ':'); // ensure valid FCM token
    //     })->toArray();

    //     if (empty($tokens)) {
    //         \Log::warning("User ID {$user->id} has no valid FCM token.");
    //         return;
    //     }

    //     try {
    //         $factory = (new \Kreait\Firebase\Factory)
    //             ->withServiceAccount(storage_path('app/vault/firebase_service.json'));

    //         $messaging = $factory->createMessaging();

    //         $notification = \Kreait\Firebase\Messaging\Notification::create($title, $body);

    //         $message = \Kreait\Firebase\Messaging\CloudMessage::new()
    //             ->withNotification($notification)
    //             ->withData($data);

    //         $report = $messaging->sendMulticast($message, $tokens);

    //         foreach ($report->getItems() as $index => $response) {
    //             $token = $tokens[$index];
    //             if ($response->isSuccess()) {
    //                 \Log::info("Push sent successfully to token: {$token}");
    //             } else {
    //                 $exception = $response->error();
    //                 \Log::warning("Push failed for token {$token}: " . $exception->getMessage());

    //                 // Delete invalid tokens
    //                 if ($exception instanceof \Kreait\Firebase\Exception\Messaging\InvalidMessage) {
    //                     \DB::table('user_tokens')->where('token', $token)->delete();
    //                     \Log::info("Cleared invalid token {$token} from user_tokens table.");
    //                 }
    //             }
    //         }
    //     } catch (\Throwable $e) {
    //         \Log::error("Push notification error for user ID {$user->id}: " . $e->getMessage());
    //     }
    // }

    protected function sendPushNotificationToUser($user, string $title, string $body, array $data = [])
    {
        if (!$user) return;

        // Get all valid tokens, latest first
        $tokens = $user->userTokens()
            ->whereNotNull('token')
            ->orderByDesc('created_at')
            ->pluck('token')
            ->toArray();

        // Remove duplicates
        $tokens = array_unique($tokens);

        if (empty($tokens)) {
            \Log::warning("User ID {$user->id} has no valid FCM token.");
            return;
        }

        try {
            $factory = (new \Kreait\Firebase\Factory)
                ->withServiceAccount(storage_path('app/vault/firebase_service.json'));

            $messaging = $factory->createMessaging();

            $notification = \Kreait\Firebase\Messaging\Notification::create($title, $body);

            $message = \Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification($notification)
                ->withData($data);

            $report = $messaging->sendMulticast($message, $tokens);

            foreach ($report->getItems() as $index => $response) {
                $token = $tokens[$index];
                if ($response->isSuccess()) {
                    \Log::info("Push sent successfully to token: {$token}");
                } else {
                    $exception = $response->error();
                    \Log::warning("Push failed for token {$token}: " . $exception->getMessage());

                    // Delete invalid tokens
                    if ($exception instanceof \Kreait\Firebase\Exception\Messaging\InvalidMessage) {
                        \DB::table('user_tokens')->where('token', $token)->delete();
                        \Log::info("Cleared invalid token {$token} from user_tokens table.");
                    }
                }
            }
        } catch (\Throwable $e) {
            \Log::error("Push notification error for user ID {$user->id}: " . $e->getMessage());
        }
    }


    //reivew payment
    public function reviewPayment($id)
    {
        //
        $this->selectedModel = $this->model::find($id);
        $this->emit('showAssignModal');
    }

    public function approvePayment()
    {
        //
        try {

            DB::beginTransaction();
            $this->selectedModel->payment_status = "successful";
            $this->selectedModel->save();
            //TODO - Issue fetch payment when prescription is been edited
            $this->selectedModel->payment->status = "successful";
            $this->selectedModel->payment->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Order") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Order") . " " . __('updated failed!'));
        }
    }

    //
    public function showEditOrderProducts()
    {
        $this->closeModal();
        //only allow cod payment edit orders
        if ($this->selectedModel->payment_method != null && !$this->selectedModel->payment_method->is_cash) {
            $this->showErrorAlert(__("Only Order with Cash Payment can be edited. Thank you"));
        } else {
            $link = route('order.edit.products', [
                "code" => $this->selectedModel->code,
            ]);
            $this->emit('newTab', $link);
        }
    }


    public function showCreateModal()
    {
        $link = route('order.create');
        $this->emit('newTab', $link);
    }
}
