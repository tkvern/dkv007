<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Task\HandleParameter;

class UploadImage extends Model
{
    protected $fillable = ['user_id', 'link', 'download', 'order_no'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}