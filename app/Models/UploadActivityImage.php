<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadActivityImage extends Model
{
    public $table = "upload_activity_images";
    protected $fillable = [
        'user_id',
        'link',
        'public',
        'key',
        'title',
        'description',
        'activity_no',
        'number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/upload_activity_image/' . $this->id;
    }
}
