<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'out_trade_no';

    public function tasks() {
        return $this->hasMany(Task::class, 'order_no', 'out_trade_no');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * generate a unique order sequence
     * @return string
     */
    public static function genOrderNO() {
        while(True) {
            $choiceOne = chr(rand(65, 90));
            $choiceTwo = chr(rand(65, 90));
            $choiceThree = rand(0, 9);
            $choiceFour = rand(0, 9);
            $out_trade_no = $choiceOne . $choiceTwo . date('ymdHis') . $choiceThree . $choiceFour;
            if (!TaskOrder::where('out_trade_no', $out_trade_no)->first()) {
                return $out_trade_no;
            }
        }
    }

    public static function make($user, $deliver_type, $price, $real_price) {
        $order = new TaskOrder();
        $order->out_trade_no = static::genOrderNO();
        $order->user_id = $user->id;
        $order->user_name = $user->name;
        $order->total_price = $price;
        $order->real_price = $real_price;
        $order->deliver_type = $deliver_type;
        $order->state = 'created';
        return $order;
    }
}
