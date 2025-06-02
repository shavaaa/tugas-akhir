<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'beautician_id',
        'schedule_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function beautician()
    {
        return $this->belongsTo(Beautician::class);
    }
    
    public function schedule()
    {
        return $this->belongsTo(ServiceSchedule::class, 'schedule_id');
    }
    
    public function review()
    {
        return $this->hasOne(OrderReview::class);
    }
    
    public function hasReview(): bool
    {
        return $this->review()->exists();
    }
}




