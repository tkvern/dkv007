<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/11
 * Time: 下午3:00
 */
namespace App\Traits\Task;

trait HandleParameter {
    public function getHandleParameter() {
        return $this->handle_params;
    }

    public function getSizeList() {
        return $this->getOriginParamListByKey('SizeList');
    }

    public function getDimensionList() {
        return $this->getOriginParamListByKey('DimensionList');
    }

    public function getFormatList() {
        return $this->getOriginParamListByKey('FormatList');
    }

    public function getPlatformList() {
        return $this->getOriginParamListByKey('PlatFormList');
    }

    public function getExtraList() {
        return $this->getOriginParamListByKey('ExtraList');
    }

    public function getReadableSizeList() {
        return $this->getReadableParamsListByKey('SizeList');
    }

    public function getReadableDimensionList() {
        return $this->getReadableParamsListByKey('DimensionList');
    }

    public function getReadableFormatList() {
        return $this->getReadableParamsListByKey('FormatList');
    }

    public function getReadablePlatformList() {
        return $this->getReadableParamsListByKey('PlatformList');
    }

    public function getReadableExtraList() {
        return $this->getReadableParamsListByKey('ExtraList');
    }

    private function getReadableParamsListByKey($key) {
        $keys = $this->getOriginParamListByKey($key);
        if (empty($keys)) {
            return [];
        }
        $paramTable = config('task_parameters');
        $readable = array_map(function($value) use ($paramTable) {
            return array_get($paramTable, $value, $value);
        }, $keys);
        return $readable;
    }

    private function getOriginParamListByKey($key) {
        $params = $this->getHandleParameter();
        if (!isset($params[$key])){
            return [];
        }
        return $params[$key];
    }
}