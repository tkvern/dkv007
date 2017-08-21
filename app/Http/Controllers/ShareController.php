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
        return view('share.index', ['images' => $images, 'search' => $search, 'title' => $search]);
    }

    public function show($key) {
        $image = UploadImage::where('key', $key)->first();
        return view('share.show', ['image' => $image, 'title' => $image->title]);
    }

    public function xml($key) {
        $image = UploadImage::where('key', $key)->first();
        return response()->view('share.tour', ['image' => $image])->header('Content-Type', 'text/xml');;
    }
}
