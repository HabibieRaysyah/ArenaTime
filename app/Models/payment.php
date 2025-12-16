<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'Order_id',
        'booking_id',
        'user_id',
        'metode',
        'amount',
        'status',
        'link_payment',
        'payment_date',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
