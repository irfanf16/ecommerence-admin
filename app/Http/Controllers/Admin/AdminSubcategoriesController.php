<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Traits\ApiHelper;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Session;

class AdminSubcategoriesController extends Controller
{
    use ApiHelper;

    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-subcategories-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-subcategories-edit', ['only' => ['edit','update','destroy','restoreCategory','orderUpdate','changeStatus']]);
        $this->middleware('permissions:admin-subcategories-write', ['only' => ['store','create']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            // $url      = config('app.url').'api/admin/attributes';
            $url = config('app.url') . 'api/admin/subcategories?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length . '&search=' . $request->search;
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);
            // dd($url);

            $status = $response->body->status;
            if ($status == 200) {
                $image_url = config('app.url') . 'storage/subcategories/image/lg/';
                $default_url = asset('admin/images/default/subcategory-white.svg');
               $edit=userPermissionCheck::userPermissionCheck('admin-subcategories-edit');
                return response()->json([
                    'status' => true,
                    'data' => $response->body->subcategories,
                    'image_url' => $image_url,
                    'default_url' => $default_url,
                    'edit'=>$edit
                ]);
            }
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/admin/subcategories/count';
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response, $url);

        $status = $response->body->status;

        if ($status == 200) {

            $subcategories_count = $response->body->subcategories_count;
            $active_subcategories = $response->body->active_subcategories;
            $inactive_subcategories = $response->body->inactive_subcategories;
            $featured_subcategories = $response->body->featured_subcategories;

            return view('admin.subcategories.index', get_defined_vars());
        }
        if ($status == 500) {
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
        // $response = Category::getAll();
        // $attributes = (Attribute::getAll())->attributes;
        // dd($attributes);
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/admin/subcategories/create';
        $response = \Unirest\Request::get($url, $headers, $body);


        $status = $response->body->status;
        // $brands = (Brand::getAll())->brands;


        if ($status == 200) {

            $categories = $response->body->categories;
            $subcategories = $response->body->subcategories;
            $childcategories = $response->body->childcategories;
            $brands = $response->body->brands;
            $attributes = $response->body->attributes;
            $keys = $response->body->keys;
            return view('admin.subcategories.create', get_defined_vars());
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
        $validator = \Validator::make($request->all(), [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'title_ar' => ['required', 'string', 'max:100'],
            'description' => ['max:500'],
        ]);


        $body = $request->except('image');

        if ($request->attributes) {
            $body['attributes'] = json_encode($request->input('attributes'));
        }
        if ($request->brands) {
            $body['brands'] = json_encode($request->input('brands'));
        }

        if ($request->image) {

            $validator = \Validator::make($request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg'],
            ]);

            $body['image'] = self::file64($request->image);


            // $body['image']  =  \Unirest\Request\Body::file($request->image);
        } else {
            $body['image'] = null;

        }


        $response = SubCategory::create(SubCategory::multipart($body,));

        // dd($response);
        $status = $response->status;
        if ($status == 200) {

            $message = $response->message;

            Session::flash('response', array("status" => 200,
                "action" => 'add',
                "message" => 'Subcategory Added Successfully'
            ));
            return back();
        } else {
            // dd($response);
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

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/subcategories/$id/edit";
        // dd($url);
        $response = \Unirest\Request::get($url, $headers, $body);


        // $response = (SubCategory::find($id));
        // dd($response);

        // $categories = (Category::getAll())->categories;
        // $attributes = (Attribute::getAll())->attributes;
        // $brands = (Brand::getAll())->brands;

        // dd($response);
        $status = $response->body->status;

        if ($status == 200) {
            $subcategory = $response->body->subcategory;
            $categories = $response->body->categories;
            $attributes = $response->body->attributes;
            $brands = $response->body->brands;
            // dd($brands);
            return view('admin.subcategories.edit', get_defined_vars());
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
        $validator = \Validator::make($request->all(), [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:100'],
            'title_ar' => ['required', 'string', 'max:100'],
            'description' => ['max:500'],
        ]);


        $body = $request->all();
        if ($request->attributes) {
            $body['attributes'] = json_encode($request->input('attributes'));
        }
        if ($request->brands) {
            $body['brands'] = json_encode($request->input('brands'));
        }

        if ($request->image) {

            $validator = \Validator::make($request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $body['image'] = self::file64($request->image);
        }

        $response = SubCategory::put($id, $body);

        // dd($response);
        // $code   = $response->code;
        $status = $response->status;

        if ($status == 200) {

            $message = $response->message;
            Session::flash('response', array("status" => 200,
                "action" => 'update',
                "message" => 'Subcategory Updated Successfully'
            ));
            return back();
        } else {
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
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/subcategories/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $code = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status" => 200,
                "action" => 'delete',
                "message" => 'Subcategory Deleted Successfully'
            ));
            return back();
        } else {
            Session::flash('response', array("status" => 200,
                "action" => 'delete',
                "message" => $response->body->message
            ));
            return back();
        }
    }


    public function showArchive()
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/admin/subcategories/archive';


        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;

            if ($status == 200) {

                $subcategories = $response->body->subcategories;


                return view('admin.subcategories.archive')->with(['subcategories' => $subcategories]);
            }


        } catch (\Throwable $th) {
            // throw $th;
            // return $th;
            return view('pages.error-500');
        }


    }


    public function restoreCategory(Request $request)
    {

        // return $request->id;

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = ["id" => $request->id];
        $url = config('app.url') . 'api/admin/subcategories/restore';


        try {
            $response = \Unirest\Request::post($url, $headers, $body);

            // dd($response->body);

            $status = $response->body->status;

            if ($status == 200) {
                return redirect()->back();
            } else {
                return view("pages.error-$status");
            }


        } catch (\Throwable $th) {
            // throw $th;
            // return $th;
            return view('pages.error-500');
        }


    }


    public function orderUpdate(Request $request)
    {

        $response = SubCategory::postBy('/order/update', $request->data, true);

        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {

        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            if ($request->has('status')) {
                $url = config('app.url') . 'api/admin/subcategories/change/status?subcategory_id=' . $request->subcategory_id . '&status=' . $request->status;
            } elseif ($request->has('featured')) {
                $url = config('app.url') . 'api/admin/subcategories/change/status?subcategory_id=' . $request->subcategory_id . '&featured=' . $request->featured;
            } else {
                $url = config('app.url') . 'api/admin/subcategories/change/status?subcategory_id=' . $request->subcategory_id . '&popular=' . $request->popular;
            }
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);
            $status = $response->body->status;

            if ($status == 200) {

                if ($request->has('status')) {
                    return response()->json(['status' => $request->status]);
                } elseif ($request->has('featured')) {
                    return response()->json(['status' => $request->featured]);
                } else {
                    return response()->json(['status' => $request->popular]);
                }
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }


}
