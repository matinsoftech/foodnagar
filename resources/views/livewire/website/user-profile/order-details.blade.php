@extends('livewire.website.layouts.app')

@section('css')
    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin: 50px auto;
            padding: 0 20px;
            max-width: 100%;
            /* max-width: 800px; */
        }

        .progress-line {
            position: absolute;
            top: 30%;
            left: 10%;
            right: 10%;
            height: 4px;
            background-color: #ddd;
            z-index: 0;
            transform: translateY(-50%);
        }

        .progress-line.completed.desktop {
            background-color: #db3030;
            height: 4px;
            width: 0;
            max-width: 80%;
            transition: width 0.3s ease;
        }

        .progress-line.completed.mobile {
            display: none;
            background-color: #db3030;
            height: 0;
            width: 4px;
            max-height: 80%;
            transition: height 0.3s ease;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .status-step {
            position: relative;
            text-align: center;
            flex: 1;
            z-index: 2;
        }

        .status-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.5rem;
            color: #fff;
            border: 3px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .status-icon.completed {
            background-color: #db3030;
        }

        .status-icon.completed i {
            color: #fff;
        }

        .status-icon.active {
            border-color: #db3030;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 165, 0, 0.7);
            }

            50% {
                box-shadow: 0 0 10px 10px rgba(255, 165, 0, 0);
            }
        }

        .status-label {
            font-size: 0.9rem;
            color: #666;
        }

        .status-label.completed {
            color: #db3030;
            font-weight: bold;
        }

        @media (max-width: 767px) {
            .progress-container {
                flex-direction: column;
                align-items: start;
                max-width: 100%;
                position: relative;
            }

            .progress-line.completed.mobile {
                display: block;
                left: 45px;
            }

            .progress-line.pending.mobile {
                top: 0;
                left: 45px;
                transform: translateX(-50%);
                max-height: 80%;
                height: 80%;
                width: 4px;
            }

            .progress-line.pending.desktop {
                display: none;
            }

            .progress-line.completed.desktop {
                display: none;
            }

            .status-step {
                display: flex;
                align-items: center;
            }
        }
    </style>
@endsection

@section('content')
    <main>
        <section class="mt-4">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row mb-8">
                    <div class="col-md-12">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                            <div>
                                <!-- page header -->
                                <h2>Order Details</h2>
                                <!-- breacrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                                class="text-inherit">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ url('account-orders') }}"
                                                class="text-inherit">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- button -->
                            <div>
                                <a href="{{ url('account-orders') }}" class="btn btn-primary">Back to all orders</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-12 mb-5">
                        <!-- card -->
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="d-md-flex justify-content-between">
                                    <div>
                                        <h6>
                                            Order Date: {{ $order->created_at->format('F j, Y, g:i a') }}
                                        </h6>
                                        <h6>
                                            Payment Info: {{ $order->payment_method->name }}
                                        </h6>

                                        <div class="d-flex align-items-center mb-2 mb-md-0">
                                            <h2 class="mb-0">Order ID: #{{ $code }}</h2>
                                            <span class="badge bg-light-warning text-dark-warning ms-2">Pending</span>
                                        </div>

                                    </div>
                                    <!-- select option -->
                                    <div class="d-md-flex">
                                        <div class="mb-2 mb-md-0">
                                            <!-- button -->
                                            <div class="ms-md-3">
                                                <button onclick="downloadInvoice()" class="btn btn-primary">Download
                                                    PDF</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- steps -->
                                <div class="container_sec">
                                    <h4 class="mt-4 text-center">Order Status Progress</h4>
                                    <div class="progress-container">
                                        @php
                                            $steps = [
                                                'pending' => 'fa-hamburger',
                                                'preparing' => 'fa-clock',
                                                'ready' => 'fa-truck',
                                                'enroute' => 'fa-box-open',
                                                'delivered' => 'fa-check-circle',
                                            ];

                                            $failedIcon = 'fa-times-circle'; // Icon for failed status
                                            $canceledIcon = 'fa-ban'; // Icon for canceled status

                                            $currentStatus = $statuses->last()->name ?? 'pending'; // Get latest status
                                            $isFailed = $currentStatus == 'failed'; // Check if failed
                                            $isCancelled = $currentStatus == 'cancel'; // Check if canceled

                                            $statusKeys = array_keys($steps); // Get all step names as an array
                                            $currentIndex = array_search($currentStatus, $statusKeys); // Find index of current status

                                            // If failed, make all previous steps completed
                                            if ($isFailed) {
                                                $currentIndex = count($steps) - 2; // Set to the last valid step before delivered
                                            }
                                        @endphp

                                        @if ($isCancelled)
                                            {{-- Show only the "Cancelled" status --}}
                                            <div class="progress-lines">
                                                <div class="progress-line failed"></div>
                                            </div>

                                            <div class="status-step" data-status="cancel">
                                                <div class="status-icon failed">
                                                    <i class="fa {{ $canceledIcon }}"></i>
                                                </div>
                                                <p class="status-label failed">Cancelled</p>
                                            </div>
                                        @else
                                            <div class="progress-lines">
                                                @for ($i = 0; $i < count($steps) - 1; $i++)
                                                    @if ($isFailed && $i == count($steps) - 2)
                                                        @break

                                                        {{-- Stop at "enroute" if status is failed --}}
                                                    @endif
                                                    <div
                                                        class="progress-line {{ $isFailed || $i < $currentIndex ? 'completed' : 'pending' }}">
                                                    </div>
                                                @endfor
                                            </div>

                                            @foreach ($steps as $status => $icon)
                                                @php
                                                    $stepIndex = array_search($status, $statusKeys); // Get index of this step
                                                    $stepClass =
                                                        $isFailed || $stepIndex < $currentIndex
                                                            ? 'completed'
                                                            : ($stepIndex == $currentIndex
                                                                ? 'active'
                                                                : 'pending');
                                                @endphp

                                                @if ($isFailed && $status == 'delivered')
                                                    @continue {{-- Skip the "delivered" step if the status is failed --}}
                                                @endif

                                                <div class="status-step" data-status="{{ $status }}">
                                                    <div class="status-icon {{ $stepClass }}">
                                                        <i class="fa {{ $icon }}"></i>
                                                    </div>
                                                    <p class="status-label {{ $stepClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                    </p>
                                                </div>
                                            @endforeach

                                            @if ($isFailed)
                                                {{-- Append "Failed" step at the end --}}
                                                <div class="status-step" data-status="failed">
                                                    <div class="status-icon failed">
                                                        <i class="fa {{ $failedIcon }}"></i>
                                                    </div>
                                                    <p class="status-label failed">Failed</p>
                                                </div>
                                            @endif
                                        @endif
                                    </div>



                                </div>
                                <!-- steps ends -->

                                <div class="mt-8">
                                    <div class="row">
                                        <!-- address -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Customer Details</h6>
                                                <p class="mb-1 lh-lg">
                                                    {{ $order->user->name }}
                                                    <br />
                                                    {{ $order->user->email }}
                                                    <br />
                                                    {{ $order->user->phone }}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- address -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            @if ($order && $order->delivery_address)
                                                <div class="mb-6">
                                                    <h6>Shipping Address</h6>
                                                    <p class="mb-1 lh-lg">
                                                        {{ $order->delivery_address->name }}
                                                        <br />
                                                        {{ $order->delivery_address->address }}
                                                        <br />
                                                        Contact No. {{ $order->delivery_address->phone }}
                                                    </p>
                                                </div>
                                            @else
                                                <p>No shipping address available.</p>
                                            @endif
                                        </div>
                                        <!-- address -->

                                        <!-- Order Details -->
                                        {{-- <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Order Details</h6>
                                                <p class="mb-1 lh-lg">
                                                    Order ID:
                                                    <span class="text-dark">{{ $code }}</span>
                                                    <br />
                                                    Order Date:
                                                    <span
                                                        class="text-dark">{{ $order->created_at->format('F j, Y, g:i a') }}</span>
                                                    <br />
                                                    Total Amount:
                                                    <span class="text-dark"> {{ currencyFormat($order->total) }}</span>
                                                    <br />
                                                    Payment Info :
                                                    <span class="text-dark">{{ $order->payment_method->name }}</span>
                                                </p>
                                            </div>
                                        </div> --}}
                                        <!-- Order Details Ends -->

                                        <!-- Suppilier Details -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Seller Details</h6>
                                                <p class="mb-1 lh-lg">
                                                    <span class="text-dark">Seller / Shop Name</span>
                                                    <br />
                                                    <span class="text-dark">Biratnagar, Nepal</span>
                                                    <br />
                                                    <span class="text-dark"> seller@gmail.com</span>
                                                    <br />
                                                    {{-- Payment Info :
                                                    <span class="text-dark">{{ $order->payment_method->name }}</span> --}}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Suppilier Details Ends -->

                                        <div class="col-12">
                                            <strong>Note:</strong>
                                            <p>{{ $order->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <!-- Table -->
                                        <table class="table mb-0 text-nowrap table-centered">
                                            <!-- Table Head -->
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Products</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <!-- tbody -->
                                            <tbody>

                                                @foreach ($orders_details as $order_product)
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div>
                                                                        <img src="{{ $order_product->product->getFirstMediaUrl('default') }}"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">
                                                                            {{ $order_product->product->name }}</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">
                                                                {{ currencyFormat($order_product->product_price > 0 ? $order_product->product_price : $order_product->price) }}</span>
                                                        </td>
                                                        @php
                                                            $quantity = 1; // Default value

                                                            if (isset($order_product->product->duration)) {
                                                                if (isset($order_product->hour)) {
                                                                    $quantity = $order_product->hour;
                                                                } elseif (isset($order_product->day)) {
                                                                    $quantity = $order_product->day;
                                                                } elseif (isset($order_product->month)) {
                                                                    $quantity = $order_product->month;
                                                                }
                                                            } elseif (isset($order_product->quantity)) {
                                                                $quantity = $order_product->quantity ?: 1;
                                                            }
                                                        @endphp

                                                        <td>
                                                            {{ $quantity }}
                                                            <span>{{ $order_product->product->duration ?? '' }}</span>
                                                        </td>
                                                        <td> {{ currencyFormat($order_product->price) }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td colspan="1" class="fw-medium text-dark">
                                                        <!-- text -->
                                                        Sub Total :
                                                    </td>
                                                    <td class="fw-medium text-dark">
                                                        <!-- text -->
                                                        {{ currencyFormat($order->sub_total) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td colspan="1" class="fw-medium text-dark">
                                                        <!-- text -->
                                                        Shipping Cost
                                                    </td>
                                                    <td class="fw-medium text-dark">
                                                        <!-- text -->
                                                        {{ currencyFormat($order->delivery_fee) }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="1" class="fw-semibold text-dark">
                                                        <!-- text -->
                                                        Grand Total
                                                    </td>
                                                    <td class="fw-semibold text-dark">
                                                        <!-- text -->
                                                        {{ currencyFormat($order->total) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="invoice" style="display: none; padding: 20px; font-family: Arial, sans-serif; width: 800px; margin: auto;">
        <!-- Company Logo -->
        <div style="text-align: center;">
            <img src="https://kartcomfort.com/storage/logos/hjSmlPDIofk2xVnIfPStTGjlRUwGCydblXqNo6QL.png" alt="Nirmayan"
                style="width: 150px; height: auto;">
            <h2 style="margin: 5px 0;">INVOICE</h2>
        </div>

        <!-- Order & Customer Details -->
        @foreach ($orders_details as $product)
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <div>
                    <p><strong>Order Code:</strong> {{ $code }}</p>
                    <p><strong>Date:</strong>
                        {{ $product->created_at->format('F j, Y, g:i a') }}</p>
                </div>
                <div style="text-align: right;">
                    <p><strong>Customer Name:</strong> {{ $product->order->user->name ?? '' }}</p>
                    <p><strong>Email:</strong> {{ $product->order->user->email ?? '' }}</p>
                    <p><strong>Phone:</strong> {{ $product->order->user->phone ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Shipping Address -->
            <div
                style="display: flex; justify-content: space-between; margin-top: 20;  border: 1px solid #ddd; padding: 10px; background: #f9f9f9;">
                <div style="padding: 10px; width: 50%;">
                    <h4 style="margin: 0;">Shipping Address</h4>
                    <p>{{ $product->order->delivery_address->name ?? '' }}</p>
                    <p>{{ $product->order->delivery_address->address ?? '' }}</p>
                    <p>{{ $product->order->delivery_address->phone ?? '' }}</p>
                </div>
                <div style="padding: 10px; width: 50%;">
                    <h4 style="margin: 0;">Vendor Details</h4>
                    <p>{{ $product->vendor->name ?? '' }}</p>
                    <p>{{ $product->vendor->email ?? '' }}</p>
                    <p>{{ $product->vendor->phone ?? '' }}</p>
                </div>
            </div>
        @endforeach

        <!-- Order Table -->
        <table border="1" width="100%" cellpadding="10" style="margin-top: 20px; border-collapse: collapse;">
            <thead style="background: #333; color: white;">
                <tr>
                    <th>Product Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders_details as $order_product)
                    <tr>
                        <td><img src="{{ $order_product->product->getFirstMediaUrl('default') }}"
                                alt="{{ $order_product->product->name }}" width="50" height="50"></td>
                        <td>{{ $order_product->product->name }}</td>
                        <td>{{ currencyFormat($order_product->product_price) }}</td>
                        <td>{{ $order_product->quantity }}</td>
                        <td>{{ currencyFormat($order_product->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Section -->
        <div style="margin-top: 20px;">
            <table width="100%" cellpadding="10" style="border-collapse: collapse;">
                @foreach ($orders_details as $order_product)
                    <tr>
                        <td style="text-align: right; font-weight: bold;">Subtotal:</td>
                        <td style="text-align: right;">
                            {{ $order_product->order->sub_total ? currencyFormat($order_product->order->sub_total) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold;">Shipping Cost:</td>
                        <td style="text-align: right;">
                            {{ $order_product->order->delivery_fee ? currencyFormat($order_product->order->delivery_fee) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; font-size: 18px;">Grand Total:</td>
                        <td style="text-align: right; font-size: 18px;">
                            {{ $order_product->order->total ? currencyFormat($order_product->order->total) : '' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <!-- Footer -->
        <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #777;">
            <p>Thank you for shopping with us!</p>
            <p>KartComfort </p>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll(".status-step");
            const completedLineDesktop = document.querySelector(".progress-line.completed.desktop");
            const completedLineMobile = document.querySelector(".progress-line.completed.mobile");

            let lastCompletedIndex = -1;

            steps.forEach((step, index) => {
                const status = step.dataset.status;
                const icon = step.querySelector(".status-icon");
                const label = step.querySelector(".status-label");

                if (status === "completed") {
                    icon.classList.add("completed");
                    label.classList.add("completed");
                    lastCompletedIndex = index;
                } else if (status === "active") {
                    icon.classList.add("active");
                }
            });

            if (lastCompletedIndex >= 0) {
                const totalSteps = steps.length;
                const percentage = ((lastCompletedIndex + 1) / totalSteps) * 100;

                // Cap percentage at 100% to avoid overflow
                const cappedPercentage = Math.min(percentage, 100);

                // Update progress line for desktop
                if (completedLineDesktop) {
                    completedLineDesktop.style.width = `${cappedPercentage}%`;
                }

                // Update progress line for mobile
                if (completedLineMobile) {
                    completedLineMobile.style.height = `${cappedPercentage}%`;
                    completedLineMobile.style.top = "0"; // Ensure it starts from the top
                }
            }
        });
    </script>
    <script>
        function downloadInvoice() {
            var invoiceContent = document.getElementById('invoice').innerHTML;
            var printWindow = window.open('', '', 'width=800,height=900');
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write('<style>body{font-family:Arial,sans-serif;}</style></head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection
