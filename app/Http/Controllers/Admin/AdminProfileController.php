<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permissions:admin-securitysetting-read', ['only' => ['index','editPassword']]);
        $this->middleware('permissions:admin-securitysetting-edit', ['only' => ['edit','update','updatePassword']]);
        $this->middleware('permissions:admin-securitysetting-write', ['only' => ['store','create']]);
    }
    public function index()
    {

        return view('admin.AdminProfile.edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/profile/edit';
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;
        $data = $response->body->profile_info;
        if($status == 200)
        {

            $name = $data->name;
            $email = $data->email;
            $country_code = $data->country_code;
            $mobile = $data->mobile;
            $is_mobile_verified = $data->is_mobile_verified;
            $profile_image = $data->profile_image;
            return view('admin.AdminProfile.edit',get_defined_vars());
        }


    }

    public function editPassword()
    {
        return view('admin.AdminProfile.update_password');
    }

    public function updatePassword(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url').'api/profile/password/update';
        $response = \Unirest\Request::post($url ,$headers, $body);
            // dd($response);
            $status = $response->body->status;

            if ($status == 200) {

                $success = $response->body->message;
                session()->flash('response', array("status"  => 200,
                                                 "action"  => 'success',
                                                 "message" => 'Password changed Successfully'
                                                ));
                return back();
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/logout';
        $response = \Unirest\Request::get($url ,$headers, $body);
//             dd($response);
            $status = $response->body->status;

            if ($status == 200) {

                $success = $response->body->message;
                session()->flash('response', array("status"  => 200,
                                                 "action"  => 'success',
                                                 "message" => 'User logged out Successfully'
                                                ));
                session()->flush();
                return redirect('/');

    }
}
}
