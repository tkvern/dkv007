<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['activity_no', 'user_id', 'title', 'description', 'public', 'click'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/activities/' . $this->activity_no;
    }

}
