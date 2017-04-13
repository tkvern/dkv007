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

if(!function_exists('get_color_by_pay_state')) {
    function get_color_by_pay_state($pay_state, $pay_label) {
        $class = '';
        if ($pay_state == '20101') {
            $class = 'danger';
        } elseif ($pay_state == '20102') {
            $class = 'success';
        } elseif ($pay_state == '20103') {
            $class = 'success';
        } else {
            $class = 'warning';
        }

        return "<span class='label label-" . $class . "'>" . $pay_label . "</span>";
    }
}


if(!function_exists('get_color_by_handle_state')) {
    function get_color_by_handle_state($handle_state, $handle_label) {
        $class = '';
        if ($handle_state == '20201' || 
            $handle_state == '20202' ||
            $handle_state == '20203' ||
            $handle_state == '20204' ||
            $handle_state == '20205') {
            $class = 'info';
        } elseif ($handle_state == '20206') {
            $class = 'warning';
        } elseif ($handle_state == '20207') {
            $class = 'success';
        } else {
            $class = 'danger';
        }

        return "<span class='label label-" . $class . "'>" . $handle_label . "</span>";
    }
}

