<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminVariantsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/variants';
        $response = \Unirest\Request::get($url ,$headers, $body);

        dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $variants          = $response->body->variants;
            $variants_count    = $response->body->variants_count;
            $active_variants   = $response->body->active_variants;
            $inactive_variants = $response->body->inactive_variants;

            return view('admin.variants.index')->with(['variants'          => $variants])
                                               ->with(['variants_count'    => $variants_count])
                                               ->with(['active_variants'   => $active_variants])
                                               ->with(['inactive_variants' => $inactive_variants]);
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
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/variants/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $attributes = $response->body->attributes;
            return view('admin.variants.create')->with(['attributes'=> $attributes]);
        }

        return "Something Went Wrong";
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'attribute_id' => 'required|integer',
            'title'        => 'required|string|max:255',
            'description'  => 'max:500',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url').'api/admin/variants';
        $body     = $request->all();
        $response = \Unirest\Request::post($url ,$headers, $body);

		// dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Variant Added Successfully'
                                            ));
            return redirect('/admin/variants');
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
        $url      = config('app.url')."api/admin/variants/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $variant    = $response->body->variant;
            $attributes = $response->body->attributes;

            return view('admin.variants.edit')->with(["variant"    => $variant])
                                              ->with(["attributes" => $attributes]);
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
        $validator = \Validator::make( $request->all(), [
            'attribute_id' => 'required|integer',
            'title'        => 'required|string|max:255',
            'description'  => 'max:500',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/variants/$id";
        $body     = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Variant Updated Successfully'
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
        $url      = config('app.url')."api/admin/variants/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Variant Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}