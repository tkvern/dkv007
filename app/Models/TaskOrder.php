<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'out_trade_no';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() {
        return $this->hasMany(Task::class, 'order_no', 'out_trade_no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function express() {
        return $this->hasOne(OrderExpress::class, 'order_no', 'out_trade_no');
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

    /**
     * @param $user
     * @param $deliver_type
     * @param $price
     * @param $real_price
     * @return TaskOrder
     */
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
