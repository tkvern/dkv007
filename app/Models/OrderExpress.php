<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderExpress extends Model
{
    //
    protected $fillable = ['deliver_address', 'contact_address', 'contact_phone_number'];

    public function order() {
        return $this->belongsTo(TaskOrder::class, 'out_trade_no', 'order_no');
    }
}
