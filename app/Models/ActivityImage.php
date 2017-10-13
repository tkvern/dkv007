<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    public $table = "activity_images";
    protected $fillable = ['activity_no', 'user_id', 'title', 'description', 'public', 'click', 'link'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/activity_images/' . $this->activity_no;
    }
}
