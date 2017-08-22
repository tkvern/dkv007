<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\UploadImage;
use App\Traits\JsonResponse;

class UploadImageController extends Controller
{

    use JsonResponse;
    
    public function index(Request $request) {
        $user = $request->user();
        $start = date('Y-m-01 00:00:00');
        $images = UploadImage::where('user_id', $user->id)->where('created_at', '>=', $start)->orderBy('created_at', 'desc')->where('activity_no', '')->paginate(10);
        
        return view('uploadimages.index', ['images' => $images]);
    }

    public function create() {
        return view('uploadimages.create');
    }

    public function edit($id) {
        return view('uploadimages.edit', ['image' => UploadImage::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $image = UploadImage::find($id);
        $activity_no = $request->input('activity_no');
        $image->update($request->only(['title', 'description', 'public', 'number']));
        if (empty($activity_no)) {
            return redirect()->action('UploadImageController@index');
        } else {
            return redirect("/activities/{$activity_no}/edit");
        }
    }

    public function store(Request $request)
    {
        if(isset($_FILES["myfile"]))
        {
            if (!empty($request->header('Activity-No'))) {
                $activity_no = $request->header('Activity-No');
            } else {
                $activity_no = "";
            }
            $ret = array();
            $key = str_random(10);
            $user = $request->user();
            $path = 'vr/file/' . $user->id .'/' . $key;
            $origin = config('app.url');

            $url = $origin . "/storage/" . $path . "/vtour/";
            $download = $origin . "/storage/" . $path . "/" . $key . ".jpeg";

            if(!is_array($_FILES["myfile"]["name"]))
            {
                $fileName = $request->file('myfile')->storeAs($path, $key . '.jpeg','public');
            }
            else
            {
            //   $allFiles = $request->allFiles();
            //   foreach($allFiles as $file) {
            //     $fileName = $request->file('myfile')->store($path, 'public');
            //     $ret[]= ["fileName" => $fileName, "path" => $path ];
            //   }
                return $this->errorJsonResponse(400, 'dos not support Multiple files');
            }

            $preFix = "/mnt/vdb1/www/dkv007/storage/app/public/";
            $inputPath = $preFix . $path;
            
            $cmd = "echo 0 | /mnt/vdb1/mkpano/krpano-1.19-pr10/krpanotools makepano -config=templates/vtour-multires.config {$inputPath}/*.jpeg";
            info("exec: $cmd");
            exec($cmd, $output, $result);

            if($result !=0) {
                return $this->errorJsonResponse(400, 'An unknown error occurred');
            } else {
                UploadImage::create([
                        'user_id' => $user->id,
                        'link' => $url,
                        'download' => $download,
                        'key' => $key,
                        'path' => $path,
                        'activity_no' => $activity_no
                    ]
                );
                return $this->successJsonResponse([
                    'fileName' => $fileName,
                    'url' => $url,
                    'download' => $download,
                    'key' => $key,
                    'path' => $path,
                    'activity_no' => $activity_no
                ]);
            }
        } else {
            return $this->errorJsonResponse(400, 'An unknown error occurred');
        }
    }
}
