<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
trait ApiHelper
{
    /*
    |======================================================================
    | This Function Converts File (png,jpg,pdf,etc) to Base64
    |======================================================================
    */
    public static function file64($image)
    {
        $path = $image->getRealPath();

        $mimeType = $image->getMimeType();
        $path = $path;
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = "data:$mimeType". ';base64,' . base64_encode($data);
        return $base64;
    }



    /*
    |======================================================================
    | This Function Converts Base64 String to File
    |======================================================================
    | 1-Here in this function we are taking a base64 string and convert into a file.
    | 2-This function takes a base64 object and returns us an array consisting of
    | file and file-name; 
    */ 
    public static function base64_to_file($image_64){
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10).'.'.$extension;

        return json_decode(json_encode([
            "name" => $imageName,
            "file" => $image,
        ]) );
    }


    public static function uploadFile( $image , $disk , $subfolder ,  $scaling = false ){

        $primary_image = self::base64_to_file($image);


        $primary_image_file =base64_decode($primary_image->file);
        $primary_image_make = Image::make($primary_image_file);


        Storage::disk("$disk")->put("$subfolder/lg/".$primary_image->name, $primary_image_file ) ;

        if($scaling ){


            $primary_image_make->resize(500 , 500);
            $toimg = (string) $primary_image_make->stream('png');

            Storage::disk("$disk")->put("$subfolder/md/".$primary_image->name, $toimg  ) ;

            $primary_image_make->resize(150 , 150);
            $toimg = (string) $primary_image_make->stream('png');

            Storage::disk("$disk")->put("$subfolder/sm/".$primary_image->name, $toimg  ) ;

            return $primary_image->name;
        }

        return $primary_image->name;


    }
}