<?php

namespace App\Http\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use League\Flysystem\Exception;
use App\Models\UploadImage;

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

        if(isset($_FILES["myfile"]))
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

            if(!is_array($_FILES["myfile"]["name"])) //single file
            {
                $fileName = $request->file('myfile')->storeAs($path, $string . '.jpeg','public');
            }
            else  //Multiple files, file[]
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
                        'user_id' => $user_id,
                        'link' => $url,
                        'download' => $download,
                        'order_no' => $order_no,
                        'key' => $string,
                        'path' => $path
                    ]
                );
                return $this->successJsonResponse([
                    'fileName' => $fileName,
                    'url' => $url,
                    'download' => $download,
                    'order_no' => $order_no,
                    'key' => $string,
                    'path' => $path
                ]);
            }
         }
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
