<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/10
 * Time: 上午9:20
 */
if(!function_exists('flash')) {
    function flash($message, $level='info') {
        \Illuminate\Support\Facades\Session::flash('flash_message', $message);
        \Illuminate\Support\Facades\Session::flash('flash_message_level', $level);
    }
}

if(!function_exists('get_flash_message')) {
    function get_flash_message() {
        return [
            'message' => \Illuminate\Support\Facades\Session::get('flash_message'),
            'level' => \Illuminate\Support\Facades\Session::get('flash_message_level')
        ];
    }
}

if(!function_exists('has_flash_message')) {
    function has_flash_message() {
        return \Illuminate\Support\Facades\Session::has('flash_message');
    }
}

if(!function_exists('get_statistic_by_state')) {
    function get_statistic_by_state($source, $stateField, $countField) {
        $statistic = ['total' => 0];
        foreach($source as $obj) {
            $statistic[$obj->{$stateField}] = $obj->{$countField};
            $statistic['total'] += $obj->{$countField};
        }
        return $statistic;
    }
}
