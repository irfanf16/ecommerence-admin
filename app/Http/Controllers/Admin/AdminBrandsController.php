<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\SubCategory;
use App\Traits\ApiHelper;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminBrandsController extends Controller
{

    use ApiHelper;
    /*
    |=============================================================
    | Get listing of the all Brands from API (api/admin/Brands)
    |=============================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-brands-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-brands-edit', ['only' => ['edit','update','destroy','restoreCategory','orderUpdate','changeStatus']]);
        $this->middleware('permissions:admin-brands-write', ['only' => ['store','create']]);
    }
    public function index(Request $request)
    {
        // dd('here');
        if($request->ajax())
        {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
            $body     = NULL;
            // $url      = config('app.url').'api/admin/attributes';
            $url      = config('app.url').'api/admin/brands?page='.$request->page_id.'&datatable_length='.$request->datatable_length.'&search='.$request->search;
            $response = \Unirest\Request::get($url ,$headers, $body);

            // dd($response);

            $status = $response->body->status;
            if ($status == 200)
            {
                $image_url = config('app.url') . 'storage/brands/logo/sm/';
                $default_url = asset('admin/images/default/subcategory-white.svg');
                $edit=userPermissionCheck::userPermissionCheck('admin-brands-edit');
                return response()->json([
                    'status'=>true,
                    'data'=>$response->body->brands,
                    'image_url' => $image_url,
                    'default_url' => $default_url,
                    'edit'=>$edit
                ]);
            }
    }
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/brands/count';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {
            $brands_count    = $response->body->brands_count;
            $active_brands   = $response->body->active_brands;
            $inactive_brands = $response->body->inactive_brands;

            return view('admin.brands.index', get_defined_vars());
        }
        return "Something Went Wrong";
    }

    /*
    |====================================================================
    | Get Listing of Active Cities from API (api/admin/brands/create)
    |====================================================================
    */
    public function create()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/brands/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // $response = Category::getAll();

        // dd($response, $url);
        // $subcategories = (SubCategory::getAll())->subcategories;

        // $childcategories = (ChildCategory::getAll())->childcategories;
        $status = $response->body->status;

        if ($status == 200) {
            $categories = $response->body->categories;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            return view('admin.brands.create', get_defined_vars());
        }

        return "Something Went Wrong";
    }



    /*
    |============================================================
    | Post a newly created Vendor in API (api/admin/brands)
    |============================================================
    */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            // 'category_id' => ['required','integer'],
            'name'        => ['required','string','max:100'],
            'name_ar'        => ['required','string','max:100'],
            'description' => ['string','max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url').'api/admin/brands';
        $body     = $request->all();

        if($request->categories){

            // $body['categories'] = implode("," , $request->categories);
        }

        // PROFILE IMAGE
        if ($request->logo_image) {

            $validator = Validator::make( $request->all(), [
                'logo_image' => ['mimes:jpeg,png,jpg,gif','max:2048'],
            ]);
            // $body['logo_image']  =  \Unirest\Request\Body::file($request->logo_image);
            $body['logo_image']  = self::file64($request->logo_image) ;
        }
        else {
            $body['logo_image'] = null;
        }

        // COVER IMAGE
        if ($request->cover_image) {

            $validator = Validator::make( $request->all(), [
                'cover_image' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
            ]);
            // $body['cover_image']  =  \Unirest\Request\Body::file($request->cover_image);
            $body['cover_image']  =  self::file64($request->cover_image);
        }
        else {
            $body['cover_image'] = null;
        }




        // $response = \Unirest\Request::post($url ,$headers, Brand::multipart($body));
        $response = Brand::create( Brand::multipart($body) ,  true);

		// dd($response);

        $status = $response->status;
        if ($status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Brand Added Successfully'
                                            ));
            return back();
        }

        else {
            $errors = $response->errors;
            Session::flash('errors', $errors);
            return back();
        }
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
    | Show the form for editing the specified Vendor.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/brands'."/$id/".'edit';
        $response = \Unirest\Request::get($url ,$headers, $body);
        // $response = Brand::edit($id);

        // dd($response);
        $status = $response->body->status;

        // $subcategories = (SubCategory::getAll())->subcategories;

        // $childcategories = (ChildCategory::getAll())->childcategories;
        // dd($subcategories);



        if ($status == 200) {

            $brand      = $response->body->brand;
            $categories = $response->body->categories;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;

            return view('admin.brands.edit', get_defined_vars());
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {

        $validator = Validator::make( $request->all(), [
            // 'category_id' => ['required','integer'],
            'name'        => ['required','string','max:100'],
            'name_ar'        => ['required','string','max:100'],
            'description' => ['string','max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/admin/brands/$id";
        $body     = $request->all();

        if($request->categories){
            // $body['categories'] = implode("," , $request->categories);
        }

        // PROFILE IMAGE
        if ($request->logo_image) {

            $validator = Validator::make( $request->all(), [
                'logo_image' => ['mimes:jpeg,png,jpg,gif','max:2048'],
            ]);
            // $body['logo_image']  =  \Unirest\Request\Body::file($request->logo_image);
            $body['logo_image']  =  self::file64($request->logo_image);
        }

        // COVER IMAGE
        if ($request->cover_image) {

            $validator = Validator::make( $request->all(), [
                'cover_image' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
            ]);
            // $body['cover_image']  =  \Unirest\Request\Body::file($request->cover_image);
            $body['cover_image']  =  self::file64($request->cover_image);
        }


        try {
            //code...
            // $response = \Unirest\Request::post($url ,$headers, $body);
            $response  = Brand::put($id , $body , true);

            // dd($response);
            $status = $response->status;

            if ($status == 200) {

                $message = $response->message;
                Session::flash('response', array( "status"  => 200,
                                                  "action"  => 'update',
                                                  "message" => 'Brand Updated Successfully'
                                                ));
                return back();
            }

            else {
                $errors = $response->errors;
                Session::flash('errors', $errors);
                return back();
            }
        } catch (\Throwable $th) {
            throw $th;
        }




    }



    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($id)
    {
        $response = Brand::soft_delete($id);

        // dd($response);
        $status = $response->status;

        if ($status == 200) {

            $success = $response->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'success',
                                             "message" => 'Brand Archived Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }


    public function showArchive(){


        try {

            $response = Brand::archived();

            // dd($response);

            $status = $response->status;

            if ($status == 200) {

                $brands = $response->brands;


                return view('admin.brands.archive')->with(['brands' => $brands]);
            }
            else{

            }


        } catch (\Throwable $th) {
            // throw $th;
            // return $th;
            return view('pages.error-500');
        }





    }


    public function restoreCategory(Request $request){


        try {
            $response = Brand::restore($request->id);
            // dd($response);

            $status = $response->status;

            if($status == 200){
                return redirect()->back();
            }
            else{
                return view("pages.error-$status");
            }


        } catch (\Throwable $th) {
            // throw $th;
            // return $th;
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
            $url      = config('app.url').'api/admin/brand/change/status?brand_id='.$request->brand_id.'&status='.$request->status;
        }else{
            $url      = config('app.url').'api/admin/brand/change/status?brand_id='.$request->brand_id.'&featured='.$request->featured;
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
