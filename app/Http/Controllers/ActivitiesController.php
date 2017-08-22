<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\Activity;
use App\Models\UploadImage;
use Validator;

class ActivitiesController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $activities = Activity::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('activities.index', ['activities' => $activities]);
    }

    public function create() {
        return view('activities.create');
    }
        
    public function edit(Request $request, $activity_no) {
        $user = $request->user();
        $activity = Activity::where('activity_no', $activity_no)->first();
        $images = UploadImage::where('user_id', $user->id)
                    ->where('activity_no', $activity_no)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('number')
                    ->paginate(10);
        
        return view('activities.edit', ['activity' => $activity,'images' => $images]);
    }

    public function update(Request $request, $activity_no)
    {
        $activity = Activity::where('activity_no', $activity_no)->first();
        $activity->where('activity_no', $activity_no)->update($request->only(['title', 'description', 'public']));
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validator($request)->validate();
        Activity::create([
                'title' => $request->input('title'),
                'user_id' => $request->user()->id,
                'description' => $request->input('description'),
                'activity_no' => $this->getActivityNo()
            ]
        );
        return redirect()->action('ActivitiesController@index');
    }

    protected static function getActivityNo() {
        $strOne = str_random(2);
        $strTwo = str_random(2);
        return $strOne.date('ymdHis').$strTwo;
    }

    protected  function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
    }
}
