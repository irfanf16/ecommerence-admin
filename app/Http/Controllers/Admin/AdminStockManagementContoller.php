<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminStockManagementContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions:admin-stockmanagement-read', ['only' => ['index']]);
        $this->middleware('permissions:admin-stockmanagement-edit', ['only' => ['changeStatus']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/product/stocks/list?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length . '&search=' . $request->search . '&category_id=' . $request->category_id . '&subcategory_id=' . $request->subcategory_id . '&childcategory_id=' . $request->childcategory_id . '&store_id=' . $request->store_id . '&brand_id=' . $request->brand_id . '&status=' . $request->status . '&featured=' . $request->featured . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date . '&translation=' . $request->translation;
            $response = \Unirest\Request::get($url, $headers, $body);

//            dd($response);

            Session::put('product_stock_page_id', $request->page_id);
            Session::put('product_stock_datatable_length', $request->datatable_length);
            if ($request->has('status') && $request->filled('status')) {
                Session::put('status_stock', $request->status == 1 ? 1 : 2);
            } else {
                Session::put('status_stock', 3);
            }
            Session::put('from_date_stocks', $request->from_date);
            Session::put('to_date_stocks', $request->to_date);

            $status = $response->body->status;
            if ($status == 200) {
                $image_url = config('app.url') . 'storage/product/images/sm/';
                $default_url = asset('storage/product/images/sm/default.svg');
                $edit=userPermissionCheck::userPermissionCheck('admin-stockmanagement-edit');
                return response()->json([
                    'status' => true,
                    'data' => $response->body->productVariants,
                    'total_stock' => $response->body->total_stock,
                    'sold_stock' => $response->body->sold_stock,
                    'in_stock' => $response->body->in_stock,
                    'out_stock' => $response->body->out_stock,
                    'image_url' => $image_url,
                    'default_url' => $default_url,
                    'edit'=>$edit
                ]);
            }
        }
        return view('admin.stocks.index');
    }
    public function changeStatus(Request $request)
    {

        try{
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url  = config('app.url').'api/admin/product/stocks/availability?status='.$request->status.'&id='.$request->id;
            $response = \Unirest\Request::get($url ,$headers, $body);
//             dd($response);
            $status = $response->body->status;
            if ($status==200){
                return response()->json(['status' => $request->status]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }
}
