<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiHelper;

class AdminSocialLinkController extends Controller
{

    use ApiHelper;
    public function __construct()
    {
        $this->middleware('permissions:admin-sociallinks-read', ['only' => ['index','editPassword']]);
        $this->middleware('permissions:admin-sociallinks-edit', ['only' => ['edit','update','updatePassword']]);
        $this->middleware('permissions:admin-sociallinks-write', ['only' => ['store','create']]);
    }
    public function index()
    {

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/social';
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;

        if($status == 200)
        {
            $socialLinks = $response->body->socialLinks;
        }
        return view('admin.socialLogin.index', get_defined_vars());
    }

    public function create()
    {
        return view('admin.socialLogin.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Content-Type' => 'multipart/form-data', 'Authorization' => $token);
        $body['title'] = $request->title;
        $body['status'] = $request->status;
        $body['logo']  =  self::file64($request->logo);
        // dd($body['logo']);
        $url      = config('app.url').'api/admin/social/store';
        $response = \Unirest\Request::post($url ,$headers, $body);
        // dd($response->body);
        $status = $response->body->status;

    if($status == 200)
        {
            return redirect('admin/social');
        }
    }

    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/admin/social/edit/$id";
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;

        if($status == 200)
        {
            $social = $response->body->social;
            return view('admin.socialLogin.edit', get_defined_vars());
        }
    }

    public function update(Request $request, $id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body['title'] = $request->title;
        $body['status'] = $request->status;
        if($request->logo)
        {
            $body['logo']  =  self::file64($request->logo);
        }
        else{
            $body['logo'] = null;
        }
        $url      = config('app.url')."api/admin/social/update/$id";
        $response = \Unirest\Request::post($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;
        if($status == 200)
        {
            return redirect('admin/social');
        }
    }

    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/admin/social/delete/$id";
        $response = \Unirest\Request::delete($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;
        if($status == 200)
        {
            return back();
        }
    }
}
