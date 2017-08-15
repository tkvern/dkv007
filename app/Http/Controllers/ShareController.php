<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class ShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index(Request $request) {
        $search = $request->query('search');
        $images = UploadImage::query();
        if(!empty($search)) {
            $images = $images->where('title', 'like', "%{$search}%")->orwhere('user_id', '=', "{$search}");
        }
        $images = $images->orderBy('created_at', 'desc')->where('public', '=', '1')->paginate(10);
        return view('share', ['images' => $images, 'search' => $search]);
    }
}
