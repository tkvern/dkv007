<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use Illuminate\Routing\Controller as BaseController;

class ShareController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index(Request $request) {
        $search = $request->query('search');
        $images = UploadImage::query();
        if(!empty($search)) {
            $images = $images->where('public', 1)->where('title', 'like', "%{$search}%")->orwhere('user_id', '=', "{$search}");
        }
        $images = $images->where('public', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('share', ['images' => $images, 'search' => $search, 'title' => $search]);
    }
}
