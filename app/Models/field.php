<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class field extends Model
{
    use SoftDeletes;
    protected function casts() {
        return  [
            'comment' => 'array'
        ];
    }

    protected $fillable = [
        'picture',
        'name',
        'type',
        'description',
        'status',
        'comment'
    ];

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}
