<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class schedule extends Model
{
    protected function casts() {
        return [
            'hour' => 'array'
        ];
    }

    use SoftDeletes;
    protected $fillable = [
        'field_id',
        'hour',
        'hourly_price',
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function field(){
        return $this->belongsTo(field::class);
    }
}
