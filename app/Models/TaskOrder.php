<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    // 支付状态
    const PAY_PENDING = '20101';
    const PAY_SUCCESS = '20102';
    const PAY_FREE = '20103';

    // 订单状态
    const Ord_HANDING = '20301';
    const Ord_REFUNDING = '20302';
    const Ord_COMPLETE = '20303';

    public static $PayStateMap = [
        self::PAY_FREE => '免费',
        self::PAY_PENDING => '待支付',
        self::PAY_SUCCESS => '已支付',
    ];

    public static $StateMap = [
        self::Ord_HANDING => '进行中',
        self::Ord_REFUNDING => '退款中',
        self::Ord_COMPLETE => '已完成',
    ];

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
        $order->user_id = $user->id;
        $order->user_name = $user->name;
        $order->total_price = $price;
        $order->real_price = $real_price;
        $order->deliver_type = $deliver_type;
        return $order;
    }

    public static function payStateLabel($payState) {
        return isset(self::$PayStateMap[$payState]) ? self::$PayStateMap[$payState] : '未知';
    }

    public function iPayStateLabel() {
        return self::payStateLabel($this->pay_state);
    }

    public static function deliverLabel($deliverType) {
        return $deliverType == 'network' ? '网盘' : '快递';
    }

    public function iDeliverLabel() {
        return self::deliverLabel($this->deliver_type);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($instance) {
           if (empty($instance->out_trade_no)) {
               $instance->out_trade_no = self::genOrderNO();
           }
           if (empty($instance->state)) {
               $instance->state = self::Ord_HANDING;
           }
        });
    }
}
