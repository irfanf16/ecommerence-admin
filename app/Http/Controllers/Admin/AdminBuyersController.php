<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminBuyersController extends Controller
{
    /*
    |=============================================================
    | Get Listing of All Buyers
    |=============================================================
    */
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/buyers';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $users                  = $response->body->users;
            $users_count            = $response->body->users_count;
            $active_users_count     = $response->body->active_users_count;
            $inactive_users_count   = $response->body->inactive_users_count;
            $verified_users_count   = $response->body->verified_users_count;
            $unverified_users_count = $response->body->unverified_users_count;


            return view('admin.buyers.index')->with(['users'                 => $users])
                                             ->with(['users_count'           => $users_count])
                                             ->with(['active_users_count'    => $active_users_count])
                                             ->with(['inactive_users_count'  => $inactive_users_count])
                                             ->with(['verified_users_count'  => $verified_users_count])
                                             ->with(['unverified_users_count'=> $unverified_users_count]);
        }

            return "Something Went Wrong";
    }



    /*
    |====================================================================
    | Create New User
    |====================================================================
    */
    public function create()
    {
        //
    }



    /*
    |============================================================
    | Post a newly created Vendor in API (api/admin/vendors)
    |============================================================
    */
    public function store(Request $request)
    {   
        //
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
    | Show the form for editing the specified Vendor.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/buyers/$id/edit"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $user = $response->body->user;
            $cities = $response->body->cities;

            return view('admin.buyers.edit')->with(["user"   => $user])
                                            ->with(["cities" => $cities]);
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
        //
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
        $url      = config('app.url')."api/admin/buyers/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Buyer Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}
