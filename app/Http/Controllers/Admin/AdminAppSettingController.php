<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAppSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions:admin-appsetting-read', ['only' => ['index']]);
        $this->middleware('permissions:admin-appsetting-edit', ['only' => ['edit','update']]);
        $this->middleware('permissions:admin-appsetting-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/app/settings";
        $response = \Unirest\Request::get($url, $headers, $body);
        // dd($response,);
        $status = $response->body->status;

        if($status == 200)
        {
            $appsettings = $response->body->appsettings;
            return view('admin.app_settings.index', get_defined_vars());
        }
    }

    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/app/settings/edit/$id";
        $response = \Unirest\Request::get($url, $headers, $body);

        $status = $response->body->status;

        if($status == 200)
        {
            $setting = $response->body->appsetting;
            return view('admin.app_settings.edit', get_defined_vars());
        }
        else{
            return "Sorry, Something Went Wrong";
        }
    }

    public function update(Request $request, $id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' ,'Content-Type' => 'application/json', 'Authorization' => $token );
        $body = $request->all();
        $body = \Unirest\Request\Body::json($body);
        $url      = config('app.url')."api/admin/app/settings/update/$id";
        $response = \Unirest\Request::put($url, $headers, $body);
        // dd($response);

        $status = $response->body->status;

        if($status == 200)
        {

            Session::flash('response', array( "status"  => 200,
            "action"  => 'edit',
            "message" => 'App Setting Updated Successfully'
          ));
           return redirect(route('app.setting'));
        }
        else{
            return "Sorry, Something Went Wrong";
        }
    }

    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' ,'Content-Type' => 'application/json', 'Authorization' => $token );
        $body = null;
        $url      = config('app.url')."api/admin/app/settings/delete/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);
        // dd($response);
        $status = $response->body->status;
        if($status == 200)
        {

            Session::flash('response', array( "status"  => 200,
            "action"  => 'delete',
            "message" => 'App Setting Deleted Successfully'
          ));
           return redirect(route('app.setting'));
        }
        else{
            return "Sorry, Something Went Wrong";
        }

    }

    public function changeStatus(Request $request, $id)
    {
        // dd($request->all());
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Content-Type' => 'application/json', 'Authorization' => $token );
        $body =  $request->all();
        $body = \Unirest\Request\Body::json($body);
        $url      = config('app.url')."api/admin/app/settings/status/$id";
        $response = \Unirest\Request::post($url, $headers, $body);
        // dd($response);
        $status = $response->body->status;
        if ($status==200){

           return response()->json(['status' => $request->value2]);
        }
    }
}
