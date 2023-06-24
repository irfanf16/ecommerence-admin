<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Session;


class AdminProductVariantsController extends Controller
{
    /*
    |==================================================
    | Display a Listing of Product-Variants
    |==================================================
    */
    public function index($pid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/variants";
        $response = \Unirest\Request::get($url, $headers, $body);

        //  dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $product = $response->body->product;
            $variants = $response->body->variants;
            $variants_count = $response->body->variants_count;
            $sold_stock = $response->body->sold_stock;
            $total_stock = $response->body->total_stock;
            // $remaining_stock = $response->body->remaining_stock;
            return view('admin.products.variants.index', get_defined_vars());
        }
        return "Something Went Wrong";
    }


    /*
    |==================================================
    | Show The Form For Creating A New Product-Variant
    |==================================================
    */
    public function create($pid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/variants/create";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $product = $response->body->product;
            $attributes = $response->body->attributes;

            return view('admin.products.variants.create', get_defined_vars());
        }
        return "Something Went Wrong";

    }


    /*
    |==================================================
    | Store The Newly Created Product-Variant
    |==================================================
    */
    public function store(Request $request, $pid)
    {
        $validator = \Validator::make($request->all(), [
            'attribute_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'retail_price' => 'required|integer|not_in:0',
            'sale_price' => 'required|integer|not_in:0',
            'sku' => 'required|alpha_num',
            'total_stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $url = config('app.url') . "api/admin/products/$pid/variants";
        $body = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array("status" => 200,
                "action" => 'add',
                "message" => 'Product New Variant Added Successfully'
            ));
            return redirect("/admin/products/$pid/variants");
        } else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }

    }


    /*
    |==================================================
    | Show The Specified Product-Variant
    |==================================================
    */
    public function show($id)
    {
        //
    }


    /*
    |==================================================
    | Edit The Specified Product-Variant
    |==================================================
    */
    public function edit($pid, $vid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/variants/$vid/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $variant = $response->body->variant;
            $attributes = $response->body->attributes;

            return view('admin.products.variants.edit')->with(['variant' => $variant])
                ->with(['attributes' => $attributes]);
        }

        return "Sorry, Something Went Wrong";
    }


    /*
    |==================================================
    | Update The Specified Product-Variant
    |==================================================
    */
    public function update(Request $request, $pid, $vid)
    {
        $validator = \Validator::make($request->all(), [
            'attribute_id' => 'required|integer',
            'variant_id' => 'required|integer',
            'retail_price' => 'required|integer|not_in:0',
            'sale_price' => 'required|integer|not_in:0',
            'sku' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $url = config('app.url') . "api/admin/products/$pid/variants/$vid";
        $body = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array("status" => 200,
                "action" => 'update',
                "message" => 'Product Variant Updated Successfully'
            ));
            return back();
        } else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }


    /*
    |==================================================
    | Delete The Specified Product-Variant
    |==================================================
    */
    public function destroy($pid, $vid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/variants/$vid";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status" => 200,
                "action" => 'success',
                "message" => 'Product Variant is Deactived Successfully'
            ));
            return back();
        } else {
            return "Sorry, Something Went Wrong";
        }
    }


    /*
    |==================================================
    | Add New Stock of Specific Product-Variant
    |==================================================
    */
    public function addStock(Request $request, $pid, $vid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = $request->all();
        $url = config('app.url') . "api/admin/products/$pid/variants/$vid/addstock";
        $response = \Unirest\Request::post($url, $headers, $body);



        $status = $response->body->status;
        if ($status == 200) {
            if ($request->has('price')) {
                Session::flash('response', array("status" => 200,
                    "action" => 'update',
                    "message" => 'Product Variant is Update Successfully'
                ));
                return back();
            }
            return redirect("/admin/products/$pid/variants");
        }

        return "Sorry, Something Went Wrong";
    }

}
