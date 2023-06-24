<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/admin/dashboard';
        $response = \Unirest\Request::get($url, $headers, $body);


        $status = $response->body->status;
        if ($status == 200) {

            $categories_count = $response->body->categories_count;
            $subcategories_count = $response->body->subcategories_count;
            $childcategories_count = $response->body->childcategories_count;
            $products_count = $response->body->products_count;
            $brands_count = $response->body->brands_count;
            $attributes_count = $response->body->attributes_count;
            $stores_count = $response->body->stores_count;
            $vendors_count = $response->body->vendors_count;
            $buyers_count = $response->body->buyers_count;
            $partners_count = $response->body->partners_count;
            $recent_orders = $response->body->recent_orders;
            $orders_count = $response->body->orders_count;
            $recent_products = $response->body->recent_products;
            $recent_stores = $response->body->recent_stores;
            $recent_user_stores = $response->body->recent_user_stores;
            $recent_buyers = $response->body->recent_buyers;
            $variants_count = $response->body->variants_count;

            return view('admin.dashboard.index')

                ->with(['categories_count' => $categories_count])
                ->with(['subcategories_count' => $subcategories_count])
                ->with(['childcategories_count' => $childcategories_count])
                ->with(['products_count' => $products_count])
                ->with(['brands_count' => $brands_count])
                ->with(['attributes_count' => $attributes_count])
                ->with(['stores_count' => $stores_count])
                ->with(['vendors_count' => $vendors_count])
                ->with(['buyers_count' => $buyers_count])
                ->with(['partners_count' => $partners_count])
                ->with(['recent_orders' => $recent_orders])
                ->with(['orders_count' => $orders_count])
                ->with(['recent_products' => $recent_products])
                ->with(['recent_stores' => $recent_stores])
                ->with(['recent_buyers' => $recent_buyers])
                ->with(['variants_count' => $variants_count])
                ->with(['recent_user_stores' => $recent_user_stores]);

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
        //
    }


    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
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
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        //
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
        //
    }
}
