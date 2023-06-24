<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSubscribersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions:admin-subscribers-read', ['only' => ['index']]);
    }

    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/subscribers';

        try {
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response->body);
            $status = $response->body->status;
        }
        catch (\Throwable $th) {
            // throw $th;
            // return $th;
            return view('pages.error-500');
        }

        if ($status == 200) {

            $subscribers = $response->body->subscribers;

            return view('admin.subscribers.index', get_defined_vars());
        }

    }

}
