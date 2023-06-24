<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Session;

class AdminMobileCoversController extends Controller
{

    use ApiHelper;
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-covers-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-covers-edit', ['only' => ['edit','update','destroy','orderUpdate','restoreCategory']]);
        $this->middleware('permissions:admin-covers-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/mobile/covers';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $covers          = $response->body->covers;
            $covers_count    = $response->body->covers_count;
            $active_covers   = $response->body->active_covers;
            $inactive_covers = $response->body->inactive_covers;

            return view('admin.banners.mobile.index')->with(['covers'          => $covers])
                                                      ->with(['covers_count'    => $covers_count])
                                                      ->with(['active_covers'   => $active_covers])
                                                      ->with(['inactive_covers' => $inactive_covers]);
        }

        return "Something Went Wrong";
    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
        return view('admin.banners.mobile.create');
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url').'api/admin/mobile/covers';
        $body     = $request->all();

        if ($request->image) {

            $validator = \Validator::make( $request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if($validator->fails()){
                $errors = $validator->messages()->all();
                Session::flash('errors', $errors);
                return back();
            }

            $body['image']  =  self::file64($request->image);
        }
        else {
            $body['image'] = null;
        }

        $response = \Unirest\Request::post($url ,$headers, $body);

		// dd($response);
        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Moblie Homescreen Cover Added Successfully'
                                            ));
            return redirect('/admin/mobile/covers');
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }



    /*
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/mobile/covers/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        $status = $response->body->status;

        if ($status == 200) {

            $cover = $response->body->cover;
            return view('admin.banners.mobile.edit')->with(["cover" => $cover]);
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/mobile/covers/$id";
        $body     = $request->all();

        if ($request->image) {

            $validator = \Validator::make( $request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if($validator->fails()){
                $errors = $validator->messages()->all();
                Session::flash('errors', $errors);
                return back();
            }

            $body['image']  =  self::file64($request->image);
        }

        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Mobile Homescreen Cover Updated Successfully'
                                            ));
            return back();
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }



    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/mobile/covers/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Cover Image Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}
