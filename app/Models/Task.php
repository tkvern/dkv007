<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'local_dir', 'handle_params', 'deliver_type'];

    protected $casts = [
        'handle_params' => 'array',
    ];
    //
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(TaskOrder::class, 'order_no', 'out_trade_no');
    }
}
