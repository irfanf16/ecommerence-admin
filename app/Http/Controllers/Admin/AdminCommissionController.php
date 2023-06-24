<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions:admin-commission-read', ['only' => ['index','appliedCommissionSection']]);
        $this->middleware('permissions:admin-commission-edit', ['only' => ['updateCommissions']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()){
//            $request->category_id=3;
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url      = config('app.url').'api/admin/commissions?category_id=' . $request->category_id .'&subcategory_id=' .$request->subcategory_id .'&from_date=' . $request->from_date.'&to_date=' .$request->to_date;
            $response = \Unirest\Request::get($url ,$headers, $body);
            $status = $response->body->status;

            if ($status == 200) {
                return response()->json(['status'=>true,'data'=>$response->body->commissions,'mediaUrl'=>config('app.url') . "storage/childcategories/image/lg"]);

            }
        }

        return view('admin.commission.index');
    }

    public function appliedCommissionSection()
    {

        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/commissions/applied';

            $response = \Unirest\Request::get($url, $headers, $body);
            $body = $response->body;
            if ($body->status == 200) {
                $categories = $body->categories;
                return view('admin.commission.appliedCommissionSection', get_defined_vars());
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateCommissions(Request $request)
    {
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = $request->all();
            $url = config('app.url') . 'api/admin/commissions/update';

            $response = \Unirest\Request::get($url, $headers, $body);
            $body = $response->body;
            if ($body->status == 200) {
                return response()->json($body);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
