<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Traits\ApiHelper;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AdminChildcategoriesController extends Controller
{
    use ApiHelper;
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-childcategories-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-childcategories-edit', ['only' => ['edit','update','destroy','restoreCategory','orderUpdate','changeStatus']]);
        $this->middleware('permissions:admin-childcategories-write', ['only' => ['store','create']]);
    }
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
            $body     = NULL;
            // $url      = config('app.url').'api/admin/attributes';
            $url      = config('app.url').'api/admin/childcategories?page='.$request->page_id.'&datatable_length='.$request->datatable_length.'&search='.$request->search;
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);
            // dd($url);

            $status = $response->body->status;
            if ($status == 200)
            {
                $image_url = config('app.url') . 'storage/childcategories/image/lg/';
                $default_url = asset('admin/images/default/subcategory-white.svg');
                $edit=userPermissionCheck::userPermissionCheck('admin-childcategories-edit');
                return response()->json([
                    'status'=>true,
                    'data'=>$response->body->childcategories,
                    'image_url' => $image_url,
                    'default_url' => $default_url,
                    'edit'=>$edit
                ]);
            }
    }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/child/count';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response, $url);

        $status = $response->body->status;

        if ($status == 200) {

            $childcategories_count    = $response->body->childcategories_count;
            $active_childcategories   = $response->body->active_childcategories;
            $inactive_childcategories = $response->body->inactive_childcategories;
            $featured_childcategories = $response->body->featured_childcategories;

            return view('admin.childcategories.index', get_defined_vars());
        }
        if($status == 500){
            return view("pages.error-500");
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
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/childcategories/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $categories = $response->body->categories;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;
            return view('admin.childcategories.create', get_defined_vars());
        }

        return "Something Went Wrong";
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make( $request->all(),
        [
            'category_id'    => ['required', 'integer'],
            'subcategory_id' => ['required', 'integer'],
            'title'          => ['required', 'string', 'max:100'],
            'title_ar'          => ['required', 'string', 'max:100'],
            'description'    => ['max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url').'api/admin/childcategories';
        $body     = $request->all();

        if ($request->image) {
            $validator = \Validator::make( $request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $body['image']  = self::file64($request->image)  ;
        }
        else {
            $body['image'] = null;
        }

        if($request->brands){
            $body['brands'] = json_encode($request->input('brands'));
        }

        if($request->attributes){
            $body['attributes'] = json_encode($request->input('attributes'));
        }


        if($request->sku_attributes){
            $body['sku_attributes'] = json_encode($request->input('sku_attributes'));
        }



        $response = \Unirest\Request::post($url ,$headers, $body);

		// dd($response);
        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Childcategory Added Successfully'
                                            ));
            return back();
        }
        elseif($status == 500){
            return view("pages.error-500");
        }

        else {
            $errors = $response->body->errors;
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
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/childcategories/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);
        $status = $response->body->status;
        // $brands = (Brand::getAll())->brands;
        // $attributes = (Attribute::getAll())->attributes;



        if ($status == 200) {

            $childcategory = $response->body->childcategory;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            $categories    = $response->body->categories;
            $subcategories = $response->body->subcategories;

            return view('admin.childcategories.edit',get_defined_vars());
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
        // dd($request->all());
        $validator = \Validator::make( $request->all(),
        [
            'category_id'    => ['required', 'integer'],
            'subcategory_id' => ['required', 'integer'],
            'title'          => ['required', 'string', 'max:100'],
            'title_ar'          => ['required', 'string', 'max:100'],
            'description'    => ['max:500'],
        ]);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/admin/childcategories/$id";
        $body     = $request->all();

        if ($request->image) {

            $validator = \Validator::make( $request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $body['image']  =  self::file64($request->image) ;
        }

        if($request->brands){
            $body['brands'] = json_encode($request->input('brands'));
        }
        if($request->attributes){
            $body['attributes'] = json_encode($request->input('attributes'));
        }

        if($request->sku_attributes){
            $body['sku_attributes'] = json_encode($request->input('sku_attributes'));
        }

        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);
        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Childcategory Updated Successfully'
                                            ));
            return back();
        }

        else {
            $errors = $response->body->errors;
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
        //dd('yes');
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/childcategories/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Childcategory Deleted Successfully'
                                            ));
            return back();
        }

        else{
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => $response->body->message
                                            ));
            return back();
        }
    }



    public function showArchive(){
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/childcategories/archive';



        try {
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);

            $status = $response->body->status;

            if ($status == 200) {

                $childcategories = $response->body->childcategories;


                return view('admin.childcategories.archive')->with(['childcategories' => $childcategories]);
            }


        } catch (\Throwable $th) {
            // throw $th;
            // return $th;
            return view('pages.error-500');
        }





    }


    public function restoreCategory(Request $request){

        // return $request->id;

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = ["id" => $request->id];
        $url      = config('app.url').'api/admin/childcategories/restore';



        try {
            $response = \Unirest\Request::post($url ,$headers, $body);

            // dd($response->body);

            $status = $response->body->status;

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

    public function orderUpdate(Request $request){

        $response  = ChildCategory::postBy('/order/update' , $request->data , true);

        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        if ($request->has('status')){
            $url      = config('app.url').'api/admin/child/change/status?child_id='.$request->child_id.'&status='.$request->status;
        }elseif($request->has('featured')){
            $url      = config('app.url').'api/admin/child/change/status?child_id='.$request->child_id.'&featured='.$request->featured;
        }else{
            $url      = config('app.url').'api/admin/child/change/status?child_id='.$request->child_id.'&popular='.$request->popular;
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
