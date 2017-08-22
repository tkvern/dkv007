<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Models\Activity;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ShareController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index(Request $request) {
        $search = $request->query('search');
        $activities = Activity::query();
        if(!empty($search)) {
            $activities = $activities->where('public', 1)->where('title', 'like', "%{$search}%")->orwhere('user_id', '=', "{$search}");
        }
        $activities = $activities->where('public', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('share.index', ['activities' => $activities, 'search' => $search]);
    }

    public function show($key) {
        $image = UploadImage::where('key', $key)->first();
        return view('share.show', ['image' => $image, 'title' => $image->title]);
    }

    public function xml($key) {
        $image = UploadImage::where('key', $key)->first();
        return response()->view('share.tour', ['image' => $image])->header('Content-Type', 'text/xml');
    }


    public function activity($activity_no) {
        $activity = Activity::where('activity_no', $activity_no)->first();
        $activity->where('activity_no', $activity_no)->increment('click');
        return view('share.activity', ['activity' => $activity, 'title' => $activity->title]);
    }

    public function activity_xml($activity_no) {
        // $images = UploadImage::orderBy('number');
        $images = DB::table('upload_images')->where('activity_no', $activity_no)->where('public', 1)->orderby('number')->get();
        return response()->view('share.actxml', compact('images'))->header('Content-Type', 'text/xml')->header('Cache-Control','no-cache, public');
    }
}
