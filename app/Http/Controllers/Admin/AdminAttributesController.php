<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\Key;
use App\SubCategory;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Session;

class AdminAttributesController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-attributes-read', ['only' => ['index','show']]);
        $this->middleware('permissions:admin-attributes-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-attributes-write', ['only' => ['store','create']]);
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        // $url      = config('app.url').'api/admin/attributes';
        $url      = config('app.url').'api/admin/attributes?page='.$request->page_id.'&datatable_length='.$request->datatable_length.'&search='.$request->search;
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
              $edit=userPermissionCheck::userPermissionCheck('admin-attributes-edit');
            return response()->json(['status'=>true,'data'=>$response->body->attributes,'edit'=>$edit]);

        }

        }
        // dd('here');
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/attr/count';
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response->body,$url);


        // dd($response, $url);
        // dd($response->body);
        $status = $response->body->status;
        if ($status == 200) {
        //    $attributes          = $response->body->attribute;
            $attributes_count    = $response->body->attributes_count;
            $active_attributes   = $response->body->active_attributes;
            $inactive_attributes = $response->body->inactive_attributes;

        return view('admin.attributes.index', get_defined_vars());
    }
    }

    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {

        // $response = SubCategory::getAll();
        // $keys = (Key::getAll())->keys;
        // $childcategories = (ChildCategory::getAll())->childcategories;
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/attributes/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;

        if($status = 200)
        {
            $categories = $response->body->categories;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;
            $keys = $response->body->keys;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            $attributes_count = $response->body->attributes_count;

            return view('admin.attributes.create', get_defined_vars());
        }
    }

    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'title'       => 'required|string|max:100',
            'title_ar'       => 'required|string|max:100',
            'title_es'       => 'required|string|max:100',

        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $body['description'] = "..";

        $body     = $request->all();
        // if($request->subcategories){
        //     $body['subcategories'] = implode(  "," ,$request->subcategories);
        // }


        $response = Attribute::create($body , true );

		// dd($response);

        if ($response->status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Attribute Added Successfully'
                                            ));
            return redirect('/admin/attributes');
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
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/attributes'."/$id/".'edit';
        $response = \Unirest\Request::get($url ,$headers, $body);
        // $response = Attribute::find($id);
        // $subcategories = (SubCategory::getAll())->subcategories;
        // $keys = (Key::getAll())->keys;
        // $childcategories = (ChildCategory::getAll())->childcategories;


        $status = $response->body->status;

        if ($status == 200) {
            $attribute = $response->body->attribute;
            $subcategories = $response->body->subcategories;

            $keys = $response->body->keys;
            $childcategories = $response->body->childcategories;
            return view('admin.attributes.edit',get_defined_vars());
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
            'title'       => 'required|string|max:100',
            'title_ar'       => 'required|string|max:100',
            'title_es'       => 'required|string|max:100',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }


        $body = $request->all();


        $response = Attribute::put($id , $body , true);

        // dd($response);

        $status = $response->status;

        if ($status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Attribute Updated Successfully'
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
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/attributes/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Attribute Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }

    // public function statusChanged($id){

    //     $token    = session()->get('token');
    //     $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
    //     $body     = NULL;
    //     $url      = config('app.url').'api/admin/attributes/statusChanged/'.$id;
    //     $response = \Unirest\Request::get($url ,$headers, $body);
    //     dd($response);
    //     $status = $response->body->status;
    //     if ($status == 200) {
    //         return response()->json(['status'=>true,'messages'=>'Attribute status changed successfully']);
    //     }
    // }

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url  = config('app.url').'api/admin/attribute/change/status?attribute_id='.$request->attribute_id.'&status='.$request->status;
        $response = \Unirest\Request::get($url ,$headers, $body);
        // dd($response);
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
