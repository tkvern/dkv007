<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\UploadActivityImage;
use App\Traits\JsonResponse;
use Intervention\Image\ImageManagerStatic as Image;
use App\Jobs\MakeVtourMultires;
use Carbon\Carbon;

class UploadActivityImagesController extends Controller
{
    use JsonResponse;
    
    public function index(Request $request)
    {
        $user = $request->user();
        $start = date('Y-m-01 00:00:00');
        $images = UploadActivityImage::where('user_id', $user->id)->where('created_at', '>=', $start)->orderBy('created_at', 'desc')->where('activity_no', '')->paginate(10);
        
        return view('uploadimages.index', ['images' => $images]);
    }

    public function create()
    {
        return view('uploadimages.create');
    }

    public function edit($id)
    {
        return view('uploadactivityimages.edit', ['image' => UploadActivityImage::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $image = UploadActivityImage::find($id);
        $activity_no = $request->input('activity_no');
        $image->update($request->only(['title', 'description', 'public', 'number', 'size_no']));
        if (empty($activity_no)) {
            return redirect()->action('UploadImageController@index');
        } else {
            return redirect("/activity_images/{$activity_no}/edit");
        }
    }

    public function store(Request $request)
    {
        if (isset($_FILES["myfile"])) {
            if (!empty($request->header('Activity-No'))) {
                $activity_no = $request->header('Activity-No');
            } else {
                $activity_no = "";
            }
            $ret = array();
            $key = str_random(10);
            $user = $request->user();
            $path = 'base/file/' . $user->id .'/' . $key;
            $origin = config('app.url');

            $url = $path . "/" . $key . '.jpeg';

            if (!is_array($_FILES["myfile"]["name"])) {
                $fileName = $request->file('myfile')->storeAs($path, $key . '.jpeg', 'oss');
                UploadActivityImage::create(
                    [
                        'user_id' => $user->id,
                        'link' => $url,
                        'key' => $key,
                        'path' => $path,
                        'activity_no' => $activity_no,
                    ]
                );
            } else {
                $allFiles = $request->allFiles();
                foreach ($allFiles as $file) {
                    $key = str_random(10);
                    $fileName = $request->file('myfile')->store($path, $key . '.jepg', 'public');
                    $ret[]= ["fileName" => $fileName, "path" => $path ];
                    UploadActivityImage::create(
                        [
                            'user_id' => $user->id,
                            'link' => $url,
                            'key' => $key,
                            'path' => $path,
                            'activity_no' => $activity_no,
                        ]
                    );
                }
            }

            return $this->successJsonResponse([
                'fileName' => $fileName,
                'url' => $url,
                'key' => $key,
                'path' => $path,
                'activity_no' => $activity_no,
                'ret' => $ret
            ]);
        } else {
            return $this->errorJsonResponse(400, 'An unknown error occurred');
        }
    }
}
