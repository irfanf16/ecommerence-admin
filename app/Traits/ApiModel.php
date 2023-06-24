<?php
namespace App\Traits;
trait ApiModel
{
    // protected $api_path;

    /*
    |============================================================
    |  Get API Base Path
    |============================================================
    */
    public static function api_path()
    {
        if(isset(self::$api_path)){
            return config('app.url')."".self::$api_path;
        }
        else{
            return response()->json([
                "status"  => 400,
                "message" => "Missing variable  < api_path > in Class "
            ]);
        }
    }

    /*
    |============================================================
    |  Get Listing of All Records -- index()
    |============================================================
    */
    public static function getAll()
    {
        try {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url      = self::api_path();
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);

            $body = $response->body;
            return $body;

        }
        catch (\Throwable $th) {
            throw $th;
        }
    }



    /*
    |============================================================
    |  Get An Existing Record By Id -- show()
    |============================================================
    */
    public static function find($id)
    {
        try {
            if($id){

                $token    = session()->get('token');
                $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
                $body     = NULL;
                $url      = self::api_path()."/$id";

                $response = \Unirest\Request::get($url ,$headers, $body);
                // dd($response);

                $body = $response->body;
                return $body;
            }
            else{
                return response()->json([
                    "status"  => 400,
                    "message" => "Missing Parameter < id >"
                ]);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }

    }



    /*
    |============================================================
    |  Store A New Record -- store()
    |============================================================
    */
    public static function create($body ,  $json = false )
    {
        if($body){
            $token    = session()->get('token');

            if($json){
                $headers  = array('Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $token
                );
                $body     =   \Unirest\Request\Body::json($body);
            }
            else{
                $headers  = array('Accept' => 'application/json','Content-Type' => 'multipart/form-data','Authorization' => $token);

            }
            $url      = self::api_path();
            $response = \Unirest\Request::post($url ,$headers, $body);

            return $response->body;

            if(isset($response->body->status)){
                return $response->body;
            }
            else{
                return response()->json([
                    "status" => 500,
                    "message" => $response->body
                ]);
            }

        }
        else{
            return response()->json([
                "status" => 400,
                "message" => "Missing Parameter < body >"
            ]);
        }

    }
    
    public static function to_json($body){
        return  \Unirest\Request\Body::json($body);
    }


    /*
    |============================================================
    |  Create A Multipart And Attach Files With It  -- store()
    |============================================================
    */
    public static function multipart($body , $files = null){
        if($files){
            $body     = \Unirest\Request\Body::multipart($body , $files);
        }
        else{
            $body     = \Unirest\Request\Body::multipart($body);
        }
        return $body;
    }



    /*
    |============================================================
    |  Create A New File By Path
    |============================================================
    */
    public static function make_file($file){
        return \Unirest\Request\Body::file($file);
    }



    /*
    |============================================================
    |  Edit An Existing Record -- edit()
    |============================================================
    */
    public static function edit($id)
    {
        if($id){
            $token   = session()->get('token');
            $headers = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body    = NULL;
            $url     = self::api_path()."/$id/edit";

            try {
                $response = \Unirest\Request::get($url ,$headers, $body);
                //dd($response);

                $body = $response->body;
                return $body;
            }
            catch (\Throwable $th) {
                throw $th;
            }
        }
        else{
            return response()->json([
                "status"  => 400,
                "message" => "Missing Parameter < id >"
            ]);
        }

    }



    /*
    |============================================================
    |  Update An Exsiting Record -- update()
    |============================================================
    */
    public static function put($id, $body,  $json = false)
    {
        if($id && $body) {
            $token    = session()->get('token');
            if($json){
                $headers  = array(
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization'=> $token
                );
                $body     =   \Unirest\Request\Body::json($body); ;
            }
            else{
                $headers  = array(
                    'Accept' => 'application/json',
                    'Content-Type' => 'multipart/form-data',
                    'Authorization' => $token
                );
            }

            $url      = self::api_path()."/$id";
            $response = \Unirest\Request::post($url, $headers, $body);

            if(isset($response->body->status)){
                return $response->body;
            }
            else{
                return response()->json([
                    "status" => 500,
                    "message" => " Somthing Went Wrong  ",
                    "log" => $response
                ]);
            }
        }
        else{
            return response()->json([
                "status" => 400,
                "message" => "Missing Parameter "
            ]);
        }
    }



    /*
    |============================================================
    |  Soft-Delete An Existing Record -- destroy()
    |============================================================
    */
    public static function soft_delete($id)
    {
        if($id){
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
            $body     = NULL;
            $url      = self::api_path()."/$id";

            $response = \Unirest\Request::delete($url, $headers, $body);
            //dd($response);

            if (isset($response->body->status)) {
                return $response->body;
            }
            else{
                return response()->json([
                    "status" => 500,
                    $response,
                ]);
            }
        }
        else{
            return response()->json([
                "status" => 400,
                "message" => "Missing Parameter < id >"
            ]);
        }
    }



    /*
    |============================================================
    |  Get Listing of Archived Records -- archived()
    |============================================================
    */
    public static function archived()
    {
        $token   = session()->get('token');
        $headers = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body    = NULL;
        $url     = self::api_path()."/archive";


        $response = \Unirest\Request::get($url ,$headers, $body);
        //dd($response);

        if(isset($response->body->status)){
            return $response->body;
        }
        else{
            return response()->json([
                "status" => 500,
                "message" => $response->body
            ]);
        }

    }



    /*
    |============================================================
    |  Restore An Archived Record -- restore()
    |============================================================
    */
    public static function restore($id)
    {
        if($id){
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = ["id" => $id];
            $url      = self::api_path()."/restore";

            $response = \Unirest\Request::post($url ,$headers, $body);
            //dd($response);

            if(isset($response->body->status)){
                return $response->body;
            }
            else{
                return response()->json([
                    "status"  => 500,
                    "message" => $response->body
                ]);
            }
        }
        else{
            return response()->json([
                "status"  => 400,
                "message" => "Missing Parameter < id >"
            ]);
        }
    }



    /*
    |============================================================
    |  Get Reqest With Custom URL --
    |============================================================
    */
    public static function getBy($next_url)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = self::api_path()."".$next_url;

        try {
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);

            $body = $response->body;

            return $body;

        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /*
    |============================================================
    |  Post Request With Custom URL --
    |============================================================
    */
    public static function postBy($next_url ,  $body , $json = false)
    {
        if($body){
            $token    = session()->get('token');

            if($json){
                $headers  = array('Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $token
                );
                $body     =   \Unirest\Request\Body::json($body);
            }
            else{
                $headers  = array('Accept' => 'application/json','Content-Type' => 'multipart/form-data','Authorization' => $token);

            }
            $url      = self::api_path()."".$next_url;
            $response = \Unirest\Request::post($url ,$headers, $body);

            return $response->body;

            if(isset($response->body->status)){
                return $response->body;
            }
            else{
                return response()->json([
                    "status" => 500,
                    "message" => $response->body
                ]);
            }

        }
        else{
            return response()->json([
                "status" => 400,
                "message" => "Missing Parameter < body >"
            ]);
        }
    }


}
