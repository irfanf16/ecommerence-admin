<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserStore;


class AdminCustomerStoresController extends Controller
{
    /*
    |=============================================================
    | Get Listing of The All Customer-Stores from API --
    |=============================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-customerstores-read', ['only' => ['index','show']]);
        $this->middleware('permissions:admin-customerstores-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-customerstores-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        try {
            $response = UserStore::getAll();
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

                return view('admin.stores.customer_stores.index')->with([
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
    | Show Form For Creating a New Customer-Store --
    |============================================================
    */
    public function create()
    {
        //
    }



    /*
    |============================================================
    | Send a Newly Created Customer-Store Data To API --
    |============================================================
    */
    public function store(Request $request)
    {

    }



    /*
    |============================================================
    | Display The Specified Customer-Store Details --
    |============================================================
    */
    public function show($id)
    {
        // try {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url      = config('app.url')."api/admin/stores/customer/$id";
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);
            $status = $response->body->status;
          if ($status == 200) {

            $userStore    = $response->body->userStore;
            $collections    =    $response->body->userStore->collections;
            // $stores_count      = $response->body->stores_count;
            return view('admin.stores.customer_stores.collections', get_defined_vars());
        }
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    public function collections($id)
    {
        // try {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url      = config('app.url')."api/admin/customer/collections/$id";
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);
            $status = $response->body->status;
        if ($status == 200) {
            $collections = $response->body->collections;
            $userStore = $response->body->collections->store;
            return view('admin.stores.customer_stores.products', get_defined_vars());
        }
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        if ($request->has('status')){
            $url      = config('app.url').'api/admin/customer/store/status?customer_store_id='.$request->customer_store_id.'&status='.$request->status;
        }else{
            $url      = config('app.url').'api/admin/customer/store/status?customer_store_id='.$request->customer_store_id.'&featured='.$request->featured;
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

    public function collectionVisibility(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url  = config('app.url').'api/admin/collection/visibility?collection_id='.$request->collection_id.'&visibility='.$request->visibility;
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;
        if ($status==200){

           return response()->json(['status' => $request->visibility]);
        }
        }catch(\Exception $e){
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }
}
