<?php

namespace App\Http\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use League\Flysystem\Exception;
use App\Models\UploadImage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Jobs\MakeVtourMultires;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    // public function storeImage(Request $request)
    // {
    //     $path = $request->file('file')->store('', 'public/vr/image');

    //     return '/storage/' . $path;
    // }

    public function storeFile(Request $request)
    {
        // $output_dir = storage_path()."/app/public/vr/file/";

        if (isset($_FILES["myfile"])) {
            info("request: {$request->header('User-Id')}");
            info("request: {$request->header('Order-No')}");
            info("request: {$request->header('File-Key')}");

            if (!empty($request->header('File-Key'))) {
                $string = $request->header('File-Key');
            } else {
                $string = str_random(10);
            }

            if (!empty($request->header('User-Id'))) {
                $user_id = $request->header('User-Id');
            } else {
                $user_id = $request->user()->id;
            }

            if (!empty($request->header('Order-No'))) {
                $order_no = $request->header('Order-No');
            } else {
                $order_no = "";
            }
            $path = 'vr/file/' . $user_id .'/' . $string;
            $origin = config('app.url');
            $size_no = 8;

            info("user_id: $user_id");
            info("order_no: $order_no");

            $url = $origin . "/storage/" . $path . "/vtour/";
            $download = $origin . "/storage/" . $path . "/" . $string . ".jpeg";

            if (!is_array($_FILES["myfile"]["name"])) { //single file
                $fileName = $request->file('myfile')->storeAs($path, $string . '.jpeg', 'public');
                $arr = Image::make($request->file('myfile'));
                $width = $arr->width();
                $height = $arr->height();
                if ($width == 2048 && $height == 1024) {
                    $size_no = 2;
                } elseif ($width == 4096 && $height == 2048) {
                    $size_no = 4;
                } elseif ($width == 6144 && $height == 3072) {
                    $size_no = 6;
                } elseif ($width == 8192 && $height == 4096) {
                    $size_no = 8;
                } elseif ($width == 10240 && $height == 5120) {
                    $size_no = 10;
                } elseif ($width == 12288 && $height == 6144) {
                    $size_no = 12;
                } elseif ($width == 14336 && $height == 7168) {
                    $size_no = 14;
                } elseif ($width == 16384 && $height == 8192) {
                    $size_no = 16;
                } elseif ($width == 18432 && $height == 9216) {
                    $size_no = 18;
                } elseif ($width == 20480 && $height == 10240) {
                    $size_no = 20;
                } else {
                    $size_no = 8;
                }
            } else {  //Multiple files, file[]
                //   $allFiles = $request->allFiles();
                //   foreach($allFiles as $file) {
                //     $fileName = $request->file('myfile')->store($path, 'public');
                //     $ret[]= ["fileName" => $fileName, "path" => $path ];
                //   }
                return $this->errorJsonResponse(400, 'dos not support Multiple files');
            }

            $preFix = "/mnt/vdb1/www/dkv007/storage/app/public/";
            $inputPath = $preFix . $path . "/*.jpeg";
            
            // $cmd = "echo 0 | /mnt/vdb1/mkpano/krpano-1.19-pr10/krpanotools makepano -config=templates/vtour-multires.config {$inputPath}/*.jpeg";
            dispatch(new MakeVtourMultires($inputPath));
            UploadImage::create(
                [
                    'user_id' => $user_id,
                    'link' => $url,
                    'download' => $download,
                    'order_no' => $order_no,
                    'key' => $string,
                    'path' => $path,
                    'size_no' => $size_no
                ]
            );
            return $this->successJsonResponse([
                'fileName' => $fileName,
                'url' => $url,
                'download' => $download,
                'order_no' => $order_no,
                'key' => $string,
                'path' => $path,
                'size_no' => $size_no
            ]);
        } else {
            return $this->errorJsonResponse(400, 'An unknown error occurred， You must check your requrest!');
        }
    }

    public function getFileId(Request $request)
    {
        info("request: {$request->header('User-Id')}");
        info("request: {$request->header('Order-No')}");
        $string = str_random(10);
        if (!empty($request->header('User-Id'))) {
            $user_id = $request->header('User-Id');
        } else {
            $user_id = $request->user()->id;
        }

        if (!empty($request->header('Order-No'))) {
            $order_no = $request->header('Order-No');
        } else {
            $order_no = "";
        }
        $path = 'vr/file/' . $user_id .'/' . $string;
        $origin = config('app.url');

        info("user_id: $user_id");
        info("order_no: $order_no");

        $url = $origin . "/storage/" . $path . "/vtour/";
        $download = $origin . "/storage/" . $path . "/" . $string . ".jpeg";

        Storage::disk('public')->put($path . '/vtour/index.html', '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>量子视觉云</title>
        </head>
        <body>
            <h2></h2>
            <p>资源正在处理中...</p>
            <p>请稍后访问</p>
        </body>
        </html>');

        return $this->successJsonResponse([
            'url' => $url,
            'download' => $download,
            'order_no' => $order_no,
            'key' => $string,
            'path' => $path,
        ]);
    }

    // public function deleteFile(Request $request)
    // {
    //     $output_dir = storage_path()."/app/public/vr/file/";
    //     if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
    //     {
    //         $fileName =$_POST['name'];
    //         $fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files
    //         $filePath = $output_dir. $fileName;
    //         if (file_exists($filePath))
    //         {
    //             unlink($filePath);
    //         }
    //         return "Deleted File ".$fileName." success";
    //     }

    // }
}
