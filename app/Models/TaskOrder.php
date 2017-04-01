<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    //
    public function tasks() {
        return $this->hasMany(Task::class, 'order_sn', 'sn');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * generate a unique order sequence
     * @return string
     */
    public static function genOrderSN() {
        while(True) {
            $choiceOne = chr(rand(65, 90));
            $choiceTwo = chr(rand(65, 90));
            $choiceThree = rand(0, 9);
            $choiceFour = rand(0, 9);
            $sn = $choiceOne . $choiceTwo . date('ymdHis') . $choiceThree . $choiceFour;
            if (!TaskOrder::where('sn', $sn)->first()) {
                return $sn;
            }
        }
    }

    public static function make($user, $deliver_type, $price, $real_price) {
        $order = new TaskOrder();
        $order->sn = static::genOrderSN();
        $order->user_id = $user->id;
        $order->user_name = $user->name;
        $order->total_price = $price;
        $order->real_price = $real_price;
        $order->deliver_type = $deliver_type;
        $order->state = 'created';
        return $order;
    }
}
