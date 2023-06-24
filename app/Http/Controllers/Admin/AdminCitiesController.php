<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class AdminCitiesController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    {
        $token = session()->get('token');

        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/cities';
        $response = \Unirest\Request::get($url ,$headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $cities          = $response->body->cities;
            $cities_count    = $response->body->cities_count;
            $active_cities   = $response->body->active_cities;
            $inactive_cities = $response->body->inactive_cities;

            return view('admin.locations.cities.index', get_defined_vars());
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
        return view('admin.locations.cities.create');
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'name'       => ['required', 'string', 'max:100'],
            'description'=> ['max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url').'api/admin/cities';
        $body     = $request->all();

        if ($request->image) {
            $validator = Validator::make( $request->all(), [
                'image'       => ['mimes:jpeg,png,jpg,gif'],
            ]);

            $body['image']  =  \Unirest\Request\Body::file($request->image);
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
                                              "message" => 'City Added Successfully'
                                            ));
            return redirect('/admin/cities');
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
        $url      = config('app.url')."api/admin/cities/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $city = $response->body->city;
            return view('admin.locations.cities.edit')->with(["city" => $city]);
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
        $validator = Validator::make( $request->all(), [
            'name'       => ['required', 'string', 'max:100'],
            'description'=> ['max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/cities/$id";
        $body     = $request->all();

        if ($request->image) {
            $validator = Validator::make( $request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $body['image']  =  \Unirest\Request\Body::file($request->image);
        }

        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'City Updated Successfully'
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
        $url      = config('app.url')."api/admin/cities/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'City Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}
