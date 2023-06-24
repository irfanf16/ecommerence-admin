<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Traits\ApiModel;
use App\Traits\ApiHelper;

use App\Models\WebsiteBanner;
class AdminWebsiteBannersController extends Controller
{
    use ApiHelper;
    use ApiModel;

    /*
    |====================================================================
    | Display a Listing of All Website Banners
    |====================================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-covers-read', ['only' => ['index','show','showArchive']]);
        $this->middleware('permissions:admin-covers-edit', ['only' => ['edit','update','destroy','orderUpdate','restoreCategory']]);
        $this->middleware('permissions:admin-covers-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/website/banners';

        try {
            $response = \Unirest\Request::get($url ,$headers, $body);
            // dd($response);

            if ($response->body->status == 200) {

                $banners          = $response->body->banners;
                $banners_count    = $response->body->banners_count;
                $active_banners   = $response->body->active_banners;
                $inactive_banners = $response->body->inactive_banners;

                return view('admin.banners.website.index')->with(['banners'         => $banners])
                                                          ->with(['banners_count'   => $banners_count])
                                                          ->with(['active_banners'  => $active_banners])
                                                          ->with(['inactive_banners'=> $inactive_banners]);
            }
            else{
                // $errors = $response->body->errors;
                return "something went wrong";
            }
        }
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }

    }



    /*
    |====================================================================
    | Show The Form For Creating a New Website Banner.
    |====================================================================
    */
    public function create()
    {
        return view('admin.banners.website.create');
    }



    /*
    |====================================================================
    | Store a Newly Created Website Banner
    |====================================================================
    */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            // 'title'       => $request->title == null ? '' : 'string|max:100',
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link'        => 'required|url|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url').'api/admin/website/banners';
        $body     = $request->all();

        // BANNER IMAGE
        if ($request->image) {
            $body['image']  = self::file64($request->image) ;
        }
        else {
            $body['image'] = null;
        }

        try {
            $response = \Unirest\Request::post($url ,$headers, $body);
            // dd($response);

            if ($response->body->status == 200) {
                Session::flash('response', array( "status"  => 200,
                                                  "action"  => 'add',
                                                  "message" => 'Website homepage banner is added successfully'
                                                ));
                return redirect('/admin/website/banners');
            }
            else {
                $errors = $response->body->errors;
                Session::flash('errors', $errors);
                return back();
            }
        }
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }

    }



    /*
    |====================================================================
    | Display the specified resource.
    |====================================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |====================================================================
    | Show the form for editing the specified resource.
    |====================================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/website/banners/$id/edit";

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $banner = $response->body->banner;
                return view('admin.banners.website.edit')->with(["banner" => $banner]);
            }

            return "Sorry, Something Went Wrong";

        }
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }

    }



    /*
    |====================================================================
    | Update the specified resource in storage.
    |====================================================================
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'image'       => 'image|mimes:jpeg,png,jpg|max:2048',
            'link'        => 'required|url|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/admin/website/banners/$id";
        $body     = $request->all();

        // BANNER IMAGE
        if ($request->image) {
            $body['image']  = self::file64($request->image) ;
        }

        try {
            $response = \Unirest\Request::post($url ,$headers, $body);
            // dd($response);

            if ($response->body->status == 200) {
                Session::flash('response', array( "status"  => 200,
                                                  "action"  => 'update',
                                                  "message" => 'Website homepage banner is updated successfully'
                                                ));
                return back();
            }
            else {
                $errors = $response->body->errors;
                Session::flash('errors', $errors);
                return back();
            }
        }
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }

    }



    /*
    |====================================================================
    | Remove The Specified Banner From Storage
    |====================================================================
    */
    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/admin/website/banners/$id";

        try {
            $response = \Unirest\Request::delete($url, $headers, $body);
            // dd($response);

            if ($response->body->status == 200) {
                Session::flash('response', array("status"  => 200,
                                                "action"  => 'delete',
                                                "message" => 'Website Homepage Banner Deleted Successfully'
                                                ));
                return back();
            }

            else{
                $errors = $response->body->errors;
                Session::flash('errors', $errors);
                return back();
            }
        }
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }
    }



    /*
    |====================================================================
    | Show Listing of Archieved (Soft-Deleted) Website Banners
    |====================================================================
    */
    public function showArchive()
    {
        try {
            $response = WebsiteBanner::archived();
            // dd($response);

            if ($response->status == 200) {

                $banners = $response->banners;
                return view('admin.banners.website.archive')->with(['banners' => $banners]);
            }
            else{
                return view('pages.error-500');
            }
        }
        catch (\Throwable $th) {

            // throw $th;
            // return $th;
            return view('pages.error-500');
        }

    }



    /*
    |====================================================================
    | Restore Archieved (Soft-Deleted) Website Banner -- Single
    |====================================================================
    */
    public function restoreCategory(Request $request)
    {
        try {
            $response = WebsiteBanner::restore($request->id);
            // dd($response);

            $status = $response->status;

            if($status == 200){
                return redirect()->back();
            }
            else{
                return view("pages.error-$status");
            }
        }
        catch (\Throwable $th) {

            // throw $th;
            // return $th;
            return view('pages.error-500');
        }

    }



    /*
    |====================================================================
    | Update Priority of Website Banner -- Single
    |====================================================================
    */
    public function orderUpdate(Request $request)
    {
        $response  = WebsiteBanner::postBy('/order/update' , $request->data , true);
        return response()->json($response);
    }

}
