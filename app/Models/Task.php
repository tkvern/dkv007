<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Task\HandleParameter;

class Task extends Model
{
    use HandleParameter;
    protected $fillable = ['name', 'local_dir', 'handle_params', 'deliver_type'];

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
        switch ($state) {
            case 'resource_waiting':
                return '等待素材上传';
            case 'resource_uploaded':
                return '素材上传完成';
            default:
                return $state;
        }
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

    public function formatHandleParams() {

    }
}
