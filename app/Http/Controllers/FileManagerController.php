<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use \Gumlet\ImageResize;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;

class FileManagerController extends Controller
{
    
    public function upload(Request $request)
    {
        try {
            $equipmentId = "";
            $downloadUrl = "";
            $fileName = "";
            if ($request->hasFile('file')) {
                if(isset($request['equipmentId'])){
                    $equipmentId = $request['equipmentId'];
                }

                //upload file
                $file = $request->File('file');

                $original_filename = $file->getClientOriginalName();
                $fileType = explode('.', $original_filename);

                //check exits path and file
                while (true) {
                    //check exist directory
                    $directory = base_path()."/upload/".$equipmentId."/".date('Y-m-d');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $fileExtension = end($fileType);
                    $fileName = $this->randomFileName().".".$fileExtension;
                    $pathFile =  $directory."/". $fileName;
                    $downloadUrl = $equipmentId."/".date('Y-m-d')."/".$fileName;

                    //check exist file
                    if(!file_exists($pathFile)){
                        break;
                    }
                }

                move_uploaded_file($file,$pathFile);
            }else {
                throw new CustomException('File Not Exists.', 404, 'not_found');
            }

            $imagePath = 'training/files/'.$equipmentId.'/'.date('Y-m-d').'/'.$fileName;
            Storage::disk('s3')->put($imagePath, file_get_contents($pathFile));
            // $hostname = env("APP_HOSTNAME_S3", "https://comvisitor-dev-bucket.s3-ap-southeast-1.amazonaws.com");
            $hostname = "https://comvisitor-dev-bucket.s3-ap-southeast-1.amazonaws.com";
            $downloadUrl = $hostname.'/'.$imagePath;
            
            $equipment = Equipment::find($equipmentId);
            $equipment->url_file = $downloadUrl; 
            $equipment->save();

            $response = [
                'code' => 'success',
                'data' => null
            ];

            // delete file
            unlink($pathFile);

            return response()->json($response, 200);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), 500);
        }
    }

    public function randomFileName(){
    	$alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $fileName = date('Y-m-d_His').substr(str_shuffle($alphabet), 0, 15);
    	return $fileName;
    }

}