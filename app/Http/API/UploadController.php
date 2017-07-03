<?php

namespace App\Http\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use League\Flysystem\Exception;

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
            $ret = array();
            $string = str_random(10);
            $user = $request->user();
            $path = 'vr/file/' . $user->id .'/' . $string;
            $origin = config('app.url');

            $url = $origin . "/storage/" . $path . "/vtour/";

            if(!is_array($_FILES["myfile"]["name"])) //single file
            {
                $fileName = $request->file('myfile')->storeAs($path, $string . '.jpeg','public');
                $ret[]= ["err_code" => "0", "err_msg" => "SUCCESS" , "fileName" => $fileName, "url" => $url ];
            }
            else  //Multiple files, file[]
            {
            //   $allFiles = $request->allFiles();
            //   foreach($allFiles as $file) {
            //     $fileName = $request->file('myfile')->store($path, 'public');
            //     $ret[]= ["fileName" => $fileName, "path" => $path ];
            //   }
                // $ret[] = ["err_code" => "400", "err_msg" => "dos not support Multiple files"];
                return json_encode(["err_code" => "400", "err_msg" => "dos not support Multiple files"]);
            }

            $preFix = "/mnt/vdb1/www/dkv007/storage/app/public/";
            $inputPath = $preFix . $path;
            
            $cmd = "sudo -Hu ansible echo y | /mnt/vdb1/mkpano/krpano-1.19-pr10/krpanotools makepano -config=templates/vtour-multires.config {$inputPath}/*.jpeg";
            info("exec: $cmd");
            exec($cmd, $output, $result);

            if($result !=0) {
                return json_encode(["err_code" => "400", "err_msg" => "An unknown error occurred"]);
            } else {
                return json_encode($ret);
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
