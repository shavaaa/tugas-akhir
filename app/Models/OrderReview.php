<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    protected $fillable = [
        'order_id',
        'rating',
        'review',
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}


