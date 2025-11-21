<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class SubscriptionPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_package_id',
        'amount',
        'status',
        'payment_receipt',
        'start_date',
        'end_date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'subscription_package_id');
    }

    // Accessor to get full URL for receipt
    public function getPaymentReceiptUrlAttribute()
    {
        return $this->payment_receipt ? asset('storage/' . $this->payment_receipt) : null;
    }

    public static function userHasActiveSubscription($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->exists();
    }


    public function getIsExpiredAttribute()
    {
        return $this->end_date && Carbon::now()->greaterThan($this->end_date);
    }

    public function getDisplayStatusAttribute()
    {
        if ($this->status === 'completed' && $this->is_expired) {
            return 'expired';
        }
        return $this->status;
    }
}
