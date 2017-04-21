<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Task\HandleParameter;

class Task extends Model
{
    use HandleParameter;

    // 任务状态常量
    const H_RES_PENDING = '20201';
    const H_RES_RECEIVED = '20202';
    const H_JOINT = '20203';
    const H_POST_PROCESSING = '20204';
    const H_MOVIE_GENERATING = '20205';
    const H_MOVIE_DELIVERING = '20206';
    const H_MOVIE_ACCEPTED = '20207';

    public static $StateMap = [
        self::H_RES_PENDING => '素材接收中',
        self::H_RES_RECEIVED => '素材接收完成',
        self::H_JOINT => '拼接处理中',
        self::H_POST_PROCESSING => '后期处理中',
        self::H_MOVIE_GENERATING => '成品生成中',
        self::H_MOVIE_DELIVERING => '成品已发出等待验收',
        self::H_MOVIE_ACCEPTED => '已验收',
    ];

    protected $fillable = ['name', 'local_dir', 'handle_params', 'deliver_type'];

    protected $appends = ['order_state', 'order_pay_state'];

    protected $hidden = ['order'];

    protected $casts = [
        'handle_params' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(TaskOrder::class, 'order_no', 'out_trade_no');
    }

    /**
     * @param $state
     * @return string
     */
    public static function stateLabel($state) {
       return isset(self::$StateMap[$state]) ? self::$StateMap[$state] : '未知';
    }

    public function iStateLabel() {
        return self::stateLabel($this->handle_state);
    }

    public function iDeliverLabel() {
        return TaskOrder::deliverLabel($this->deliver_type);
    }

    public function iPayLabel() {
        return TaskOrder::payStateLabel($this->pay_state);
    }

    public function readableHandleParams() {

    }

    public function getOrderStateAttribute() {
        return $this->order->state;
    }

    public function getOrderPayStateAttribute() {
        return $this->order->pay_state;
    }

    public function hasPayed() {
        return $this->order->pay_state == TaskOrder::PAY_SUCCESS || $this->order->pay_state == TaskOrder::PAY_FREE;
    }
}
