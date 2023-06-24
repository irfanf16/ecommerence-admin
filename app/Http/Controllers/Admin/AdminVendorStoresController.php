<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\VendorStore;


class AdminVendorStoresController extends Controller
{
    /*
    |=============================================================
    | Get Listing of The All Vendor Stores from API --
    |=============================================================
    */

    public function __construct()
    {
        $this->middleware('permissions:admin-vendorstores-read', ['only' => ['index','show']]);
        $this->middleware('permissions:admin-vendorstores-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-vendorstores-write', ['only' => ['store','create']]);
    }

    public function index()
    {
        try {
            $response = VendorStore::getAll();
            // dd($response);

            $status = $response->status;
            if ($status == 200) {

                $stores            = $response->stores;
                $stores_count      = $response->stores_count;
                $active_stores     = $response->active_stores;
                $inactive_stores   = $response->inactive_stores;
                $verified_stores   = $response->verified_stores;
                $unverified_stores = $response->unverified_stores;
                $featured_stores   = $response->featured_stores;

                return view('admin.stores.vendor_stores.index')->with([
                    'stores'            => $stores,
                    'stores_count'      => $stores_count,
                    'active_stores'     => $active_stores,
                    'inactive_stores'   => $inactive_stores,
                    'verified_stores'   => $verified_stores,
                    'unverified_stores' => $unverified_stores,
                    'featured_stores'   => $featured_stores
                ]);
            }

            return "Something Went Wrong";

        }
        catch (\Throwable $th) {
            //throw $th;
            return view('pages.error-500');
        }

    }



    /*
    |============================================================
    | Show Form For Creating a New Vendor-Store --
    |============================================================
    */
    public function create()
    {
        //
    }



    /*
    |============================================================
    | Send a Newly Created Vendor-Store Data To API --
    |============================================================
    */
    public function store(Request $request)
    {

    }



    /*
    |============================================================
    | Display The Specified Vendor-Store Details --
    |============================================================
    */
    public function show($id)
    {
        try {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
            $body     = NULL;
            $url      = config('app.url')."api/admin/stores/vendor/$id";
            $response = \Unirest\Request::get($url, $headers, $body);

            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {
            $store = $response->body->store;
            $products = $response->body->products;
             return view('admin.stores.vendor_stores.detail', get_defined_vars());
            }

            else{
                return "Sorry, Something Went Wrong";
            }

        }
        catch (\Throwable $th) {

            //throw $th;
        }
    }



    /*
    |===========================================================
    | Show the form for editing the specified Vendor.
    |===========================================================
    */
    public function edit($id)
    {
        try {
            $response = VendorStore::find($id);
            // dd($response);

            $status = $response->status;
            if ($status == 200) {

                $store   = $response->store;

                return view('admin.stores.vendor_stores.edit')->with([
                    "store"   => $store,
                ]);
            }

            return "Sorry, Something Went Wrong";

        }
        catch (\Throwable $th) {
            throw $th;
            return view('pages.error-500');
        }
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
        try {
            $response = VendorStore::soft_delete($id);
            // dd($response);

            $status = $response->status;
            if ($status == 200) {

                $success = $response->message;

                Session::flash('response', [
                    "status"  => 200,
                    "action"  => 'delete',
                    "message" => 'Vendor Store de-activated successfully'
                ]);

                return back();
            }

            else{
                return "Sorry, Something Went Wrong";
            }
        }
        catch (\Throwable $th) {
            // throw $th;
            return view('pages.error-500');
        }
    }

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        if ($request->has('status')){
            $url      = config('app.url').'api/admin/vendor/store/status?vendor_store_id='.$request->vendor_store_id.'&status='.$request->status;
        }else{
            $url      = config('app.url').'api/admin/vendor/store/status?vendor_store_id='.$request->vendor_store_id.'&featured='.$request->featured;
        }
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;

        if ($status==200){

            if ($request->has('status')) {
                return response()->json(['status' => $request->status]);
            }else{
                return response()->json(['status' => $request->featured]);

            }
        }

        }catch(\Exception $e){
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }



}
