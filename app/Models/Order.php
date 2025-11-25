<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'shipping_address',
        'billing_address',
        'status',
    ];

    /**
     * An Order belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * An Order has many OrderDetails (items).
     */
    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
}