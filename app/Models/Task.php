<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $cast = [
        'handle_params' => 'array',
    ];
    //
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(TaskOrder::class, 'order_sn', 'sn');
    }
}
