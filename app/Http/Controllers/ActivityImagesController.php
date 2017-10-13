<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\ActivityImage;
use App\Models\UploadActivityImage;
use Validator;

class ActivityImagesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $activities = ActivityImage::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('activityimages.index', ['activities' => $activities]);
    }

    public function create()
    {
        return view('activityimages.create');
    }
        
    public function edit(Request $request, $activity_no)
    {
        $user = $request->user();
        $activity = ActivityImage::where('activity_no', $activity_no)->first();
        $images = UploadActivityImage::where('user_id', $user->id)
                    ->where('activity_no', $activity_no)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('number')
                    ->paginate(10);
        
        return view('activityimages.edit', ['activity' => $activity,'images' => $images]);
    }

    public function update(Request $request, $activity_no)
    {
        $activity = ActivityImage::where('activity_no', $activity_no)->first();
        $activity->where('activity_no', $activity_no)->update($request->only(['title', 'description', 'public', 'link']));
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validator($request)->validate();
        ActivityImage::create(
            [
                'title' => $request->input('title'),
                'user_id' => $request->user()->id,
                'description' => $request->input('description'),
                'link' => $request->input('link'),
                'activity_no' => $this->getActivityNo()
            ]
        );
        return redirect()->action('ActivityImagesController@index');
    }

    protected static function getActivityNo()
    {
        $strOne = str_random(2);
        $strTwo = str_random(2);
        return $strOne.date('ymdHis').$strTwo;
    }

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
    }
}
