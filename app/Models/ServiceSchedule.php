<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'schedule_id');
    }
    
    public function isBooked()
    {
        return $this->status === 'terisi' || $this->orders()->exists();
    }
    
    public function scopeAvailable($query)
    {
        return $query->where('status', 'tersedia');
    }
}

