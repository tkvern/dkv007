<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    //
    public function tasks() {
        return $this->hasMany('Task', 'order_sn', 'sn');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

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
}
