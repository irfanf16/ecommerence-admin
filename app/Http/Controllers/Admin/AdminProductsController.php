<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminProductsController extends Controller
{
    /*
    |===================================================================
    | Get Listing of The All Products From API -- All Vendors Products
    |===================================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-products-read', ['only' => ['index','show']]);
        $this->middleware('permissions:admin-products-edit', ['only' => ['edit','update','destroy','changeStatus','editTranslation','updateTranslation']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/product?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length . '&search=' . $request->search . '&category_id=' . $request->category_id . '&subcategory_id=' . $request->subcategory_id . '&childcategory_id=' . $request->childcategory_id . '&store_id=' . $request->store_id . '&brand_id=' . $request->brand_id . '&status=' . $request->status . '&featured=' . $request->featured . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date . '&translation=' . $request->translation;
            $response = \Unirest\Request::get($url, $headers, $body);
            Session::put('product_page_id', $request->page_id);
            Session::put('product_datatable_length', $request->datatable_length);
            Session::put('category_id', $request->category_id);
            Session::put('subcategory_id', $request->subcategory_id);
            Session::put('childcategory_id', $request->childcategory_id);
            Session::put('store_id', $request->store_id);
            Session::put('brand_id', $request->brand_id);
            if ($request->has('status') && $request->filled('status')) {
                Session::put('status', $request->status == 1 ? 1 : 2);
            }else{
                Session::put('status', 3);
            }
            if ($request->has('featured') && $request->filled('featured')) {
                Session::put('featured', $request->featured == 1 ? 1 : 2);
            }else{
                Session::put('featured',3);
            }
            if ($request->has('translation') && $request->filled('translation')) {
                Session::put('translation', $request->translation == 1 ? 1 : 2);
            }else{

                Session::put('translation',3);
            }
            Session::put('from_date', $request->from_date);
            Session::put('to_date', $request->to_date);
            // dd($response->body);

            $status = $response->body->status;
            if ($status == 200) {
                $image_url = config('app.url') . 'storage/product/images/sm/';
                $default_url = asset('storage/product/images/sm/default.svg');
                $edit=userPermissionCheck::userPermissionCheck('admin-products-edit');
                return response()->json([
                    'status' => true,
                    'data' => $response->body->products,
                    'image_url' => $image_url,
                    'default_url' => $default_url,
                    'edit'=>$edit
                ]);
            }
        }


        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/admin/products/count';
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {
            $products_count = $response->body->products_count;
            $active_products = $response->body->active_products;
            $inactive_products = $response->body->inactive_products;
            $featured_products = $response->body->featured_products;
            $categories = $response->body->categories;
            $sub_categories = $response->body->sub_categories;
            $child_categories = $response->body->child_categories;
            $stores = $response->body->stores;
            $brands = $response->body->brands;

            return view('admin.products.index', get_defined_vars());
        }
        return "Something Went Wrong";
    }


    /*
    |===================================================================
    | Display The Specific Product Details --
    |===================================================================
    */
    public function show($id)
    {

        try {
            $response = Product::find($id);
            // dd($response);

            $status = $response->status;
            if ($status == 200) {

                $product = $response->product;
                $stores = $response->stores;
                $brands = $response->brands;
                $categories = $response->categories;
                $subcategories = $response->subcategories;
                $childcategories = $response->childcategories;

                return view('admin.products.show')->with([
                    'product' => $product,
                    'stores' => $stores,
                    'brands' => $brands,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'childcategories' => $childcategories
                ]);
            }

            return "Sorry, Something Went Wrong";

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /*
    |==================================================================
    | Show The Form For Editing The Specified Product Detail.
    |==================================================================
    */
    public function edit($id)
    {

    }


    /*
    |===============================================================
    | Update The Specified Product Detail in Storage --
    |===============================================================
    */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'category_id'       => 'required|integer',
            // 'subcategory_id'    => 'required|integer',
            'brand_id' => 'required|integer',
            'short_description' => 'required',
            'warranty_type' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_width' => 'required',
            'package_height' => 'required',
            'good_type' => 'integer'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        // STORE PRODUCT-DETAIL IMAGES IN STORAGE-FOLDER
        $content = $request->detailed_description;


        $body = $request->except(['images', 'primary_image']);


        // STORE PRODUCT PRIMARY-IMAGE
        if ($request->primary_image_data) {
            // $body["primary_image"] = ApiHelper::file64($request->primary_image);
            $body["primary_image"] = $request->primary_image_data;

        }

        // STORE PRODUCT DETAIL-IMAGES
        if ($request->images) {
            $files = [];

            foreach ($request->images as $image) {

                array_push($files, self::file64($image));

            }


            //  dd($files);


            $body['files'] = $files;

        }

        // dd($body);

        try {
            $response = Product::put($id, $body, true);
            // dd($response);

            $status = $response->status;
            if ($status == 200) {
                Session::flash('response', array(
                    "status" => 200,
                    "action" => 'add',
                    "message" => 'Product variant is updated successfully'
                ));
                return back();
            }
            $errors = $response->errors;
            Session::flash('errors', $errors);
            return back();

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |===============================================================
    | Remove The Specified Product From Storage --
    |===============================================================
    */
    public function destroy($id)
    {
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . "api/admin/product/$id";
            $response = \Unirest\Request::delete($url, $headers, $body);

            // dd($response, $url);

            $status = $response->body->status;
            if ($status == 200) {

                $success = $response->body->message;
                Session::flash('response', [
                    "status" => 200,
                    "action" => 'success',
                    "message" => 'Product Moved to Trash Successfully'
                ]);

                return back();
            } else {
                return "Sorry, Something Went Wrong";
            }

        } catch (\Throwable $th) {

            //throw $th;
        }
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            if ($request->has('status')) {
                $url = config('app.url') . 'api/admin/product/change/status?product_id=' . $request->product_id . '&status=' . $request->status;
            } elseif($request->has('featured')) {
                $url = config('app.url') . 'api/admin/product/change/status?product_id=' . $request->product_id . '&featured=' . $request->featured;
            } else {
                $url = config('app.url') . 'api/admin/product/change/status?product_id=' . $request->product_id . '&translation=' . $request->translation;
            }
            $response = \Unirest\Request::get($url, $headers, $body);
            $status = $response->body->status;

            if ($status == 200) {

                if ($request->has('status')) {
                    return response()->json(['status' => $request->status]);
                } elseif($request->has('featured')) {
                    return response()->json(['status' => $request->featured]);

                } else {
                    return response()->json(['status' => $request->translation]);
                }
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function editTranslation($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/admin/product/$id/editTranslation";
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response->body);
       $description_detail = $response->body->product->detailed_description;



        if($response->body->status == 200)
        {
            $product = $response->body->product;
            return view('admin.products.editTranslation', get_defined_vars());
        }
    }

    public function updateTranslation(Request $request, $id)
    {
        // dd($request->all());
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body['name']     = $request->name;
        $body['name_ar']     = $request->name_ar;
        $body['short_description']     = $request->short_description;
        $body['short_description_ar']     = $request->short_description_ar;
        $body['detailed_description']     = $request->detailed_description;
        $body['detailed_description_ar']     = $request->detailed_description_ar;
        $body['translation_verified'] = $request->translation_verified;
        $body['status'] = $request->status;
        $url      = config('app.url')."api/admin/product/$id/updateTranslation";
        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response->body);
        if($response->body->status == 200)
        {
            return back();
        }
    }

}
