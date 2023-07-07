<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\SubCategory;
use App\Traits\ApiHelper;
// use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{


    use ApiHelper;

    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-categories-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-categories-edit', ['only' => ['edit','update','destroy','restoreCategory','orderUpdate','changeStatus']]);
        $this->middleware('permissions:admin-categories-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/categories';

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

            $categories          = $response->body->categories;
            $categories_count    = $response->body->categories_count;
            $active_categories   = $response->body->active_categories;
            $inactive_categories = $response->body->inactive_categories;
            $featured_categories = $response->body->featured_categories;


            return view('admin.categories.index', get_defined_vars());
        }

    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/categories/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        $status = $response->body->status;
        if($status = 200)
        {
            $categories = $response->body->categories;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            return view('admin.categories.create', get_defined_vars());
        }
        // $response = Brand::getAll();
        // dd($response);


    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'title'       => ['required', 'string', 'max:100'],
            'title_ar'    => ['required', 'string', 'max:100'],
            'title_es'    => ['required', 'string', 'max:100'],
            'description' => ['max:500'],
        ]);

        $body     = $request->all();
        if($request->brands){
            $body['brands'] = implode("," , $request->brands);
        }

        if ($request->logo_image) {
            $validator = \Validator::make( $request->all(), [
                'logo_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            // $body['logo_image']  =  \Unirest\Request\Body::file($request->logo_image);
            $body['logo_image']  =  self::file64($request->logo_image) ;
        }
        else {
            $body['logo_image'] = null;
        }

        if ($request->mobile_image) {
            $validator = \Validator::make( $request->all(), [
                'mobile_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            // $body['mobile_image']  =  \Unirest\Request\Body::file($request->mobile_image);
            $body['mobile_image']  =  self::file64($request->mobile_image);
        }
        else {
            $body['mobile_image'] = null;
        }

        if ($request->banner_image) {
            $validator = \Validator::make( $request->all(), [
                'banner_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            $body['banner_image']  =  self::file64($request->banner_image);
        }
        else {
            $body['banner_image'] = null;
        }


        $response = Category::create( Category::multipart($body)  );
		// dd($response );

        $status = $response->status;
        if ($status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Category Added Successfully'
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

        dd(Category::find($id));

    }



    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/admin/categories/$id/edit";
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response->body, $url);

        $status = $response->body->status;

        if ($status == 200) {

            $category = $response->body->category;
            $brands = $response->body->brands;
            return view('admin.categories.edit', get_defined_vars());
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
        $validator = \Validator::make( $request->all(), [
            'title'       => ['required', 'string', 'max:100'],
            'title_ar'       => ['required', 'string', 'max:100'],
            'title_es'       => ['required', 'string', 'max:100'],
            'description' => ['max:500'],
        ]);


        $body     = $request->all();

        if($request->brands){

            $body['brands'] = implode("," , $request->brands);
        }

        if ($request->logo_image) {
            $validator = \Validator::make( $request->all(), [
                'logo_image' => ['bail', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);
            $body['logo_image']  =  self::file64($request->logo_image) ;

        }

        if ($request->mobile_image) {
            $validator = \Validator::make( $request->all(), [
                'mobile_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            $body['mobile_image']  =  self::file64($request->mobile_image);

        }

        if ($request->banner_image) {
            $validator = \Validator::make( $request->all(), [
                'banner_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            $body['banner_image']  =  self::file64($request->banner_image);

        }




        $response = Category::put($id , $body);

        // dd($response);


        $status = $response->status;

        if ( $status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Category Updated Successfully'
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
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($id)
    {

        $response = Category::soft_delete($id);

        // dd($response);
        // $code   = $response->code;

        if(isset($response->status)){
            if ($response->status == 200) {

                $success = $response->message;
                Session::flash('response', array("status"  => 200,
                                                 "action"  => 'update',
                                                 "message" => 'Category Deleted Successfully'
                                                ));
                return back();
            }

            else{
                Session::flash('response', array("status"  => 200,
                                                 "action"  => 'delete',
                                                 "message" => $response->message
                                                ));
                return back();
            }
        }
        else{
            Session::flash('response', array("status"  => 200,
                                                 "action"  => 'delete',
                                                 "message" => "somthing Went Wrong"
                                                ));
            return back();
        }



    }

    public function showArchive(){

        try {

            $response = Category::archived();

            // dd($response);

            $status = $response->status;

            if ($status == 200) {

                $categories = $response->categories;


                return view('admin.categories.archive')->with(['categories'          => $categories]);
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
            $response = Category::restore($request->id);

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

    public function test(){
        // return 'testing';
        dd(Category::find(1) , Category::getAll());
    }

    public function orderUpdate(Request $request){
        // dd($request->all());

        $response  = Category::postBy('/order/update' , $request->data , true);

        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        if ($request->has('status')){
            $url      = config('app.url').'api/admin/categories/change/status?category_id='.$request->category_id.'&status='.$request->status;
        }elseif($request->has('featured')){
            $url      = config('app.url').'api/admin/categories/change/status?category_id='.$request->category_id.'&featured='.$request->featured;
        }else{
            $url      = config('app.url').'api/admin/categories/change/status?category_id='.$request->category_id.'&popular='.$request->popular;
        }
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
        $status = $response->body->status;

        if ($status==200){

            if ($request->has('status')) {
                return response()->json(['status' => $request->status]);
            }elseif($request->has('featured')){
                return response()->json(['status' => $request->featured]);
            }else{
                return response()->json(['status' => $request->popular]);
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
