<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function billingAddress() {
        return $this->belongsTo(Address::class);
    }
    
    public function shippingAddress() {
        return $this->belongsTo(Address::class);
    }
    
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
    
    public function payment() {
        return $this->hasOne(Payment::class);
    }
    
}
