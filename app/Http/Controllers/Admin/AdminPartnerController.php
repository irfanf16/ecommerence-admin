<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminPartnerController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-partners-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-partners-edit', ['only' => ['edit','update','destroy','orderUpdate','restoreCategory']]);
        $this->middleware('permissions:admin-partners-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/partners';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $partners          = $response->body->partners;
            $partners_count    = $response->body->partners_count;
            $active_partners   = $response->body->active_partners;
            $inactive_partners = $response->body->inactive_partners;

            return view('admin.partners.index')->with(['partners'          => $partners])
                                                      ->with(['partners_count'    => $partners_count])
                                                      ->with(['active_partners'   => $active_partners])
                                                      ->with(['inactive_partners' => $inactive_partners]);
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
        return view('admin.partners.create');
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'title'       => 'required|string|max:100',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url').'api/admin/partners';
        $body     = $request->all();

        if ($request->image) {
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
                                              "message" => 'Partner Added Successfully'
                                            ));
            return redirect('/admin/partners');
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
        $url      = config('app.url')."api/admin/partners/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        //dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $partner = $response->body->partner;
            return view('admin.partners.edit')->with(["partner" => $partner]);
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
            'title'       => 'required|string|max:100',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/partners/$id";
        $body     = $request->all();

        if ($request->image) {
            $body['image']  =  \Unirest\Request\Body::file($request->image);
        }

        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Partner Updated Successfully'
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
        $url      = config('app.url')."api/admin/partners/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Partner Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}
