<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Http\Controllers\Controller;
use App\Models\Key;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permissions:admin-keys-read', ['only' => ['index','show']]);
        $this->middleware('permissions:admin-keys-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-keys-write', ['only' => ['store','create']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()){
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
            $body     = NULL;
            $url      = config('app.url').'api/admin/keys?page='.$request->page_id.'&datatable_length='.$request->datatable_length.'&search='.$request->search;
            $response = \Unirest\Request::get($url ,$headers, $body);
            $status = $response->body->status;
            if ($status == 200) {
            $edit=userPermissionCheck::userPermissionCheck('admin-keys-edit');
                return response()->json(['status'=>true,'data'=>$response->body->keys,'edit'=>$edit]);
//                return view('admin.keys.data',)->with(['response'=> $response->body->keys]);
            }
        }
        return view('admin.keys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/keys/create';
        $response = \Unirest\Request::get($url ,$headers, $body);
        $status = $response->body->status;

        // dd($response);

        if ($status == 200) {
            $attributes = $response->body->attributes;
            return view('admin.keys.create', compact('attributes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = \Validator::make( $request->all(), [
            'name'       => 'required|string|max:100',
            'name_ar'       => 'required|string|max:100',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }


        $body     = $request->all();


        $response = Key::create($body , true );

		// dd($response);

        if ($response->status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Key Added Successfully'
                                            ));
            return redirect('/admin/keys');
        }

        else {
            $errors = $response->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/keys'."/$id/".'edit';
        // dd($url);
        $response = \Unirest\Request::get($url ,$headers, $body);
        $status = $response->body->status;

        // $response  = Key::find($id);
        // $attributes = (Attribute::getAll())->attributes;

        // dd($response);
        $status = $response->body->status;
        if ($status == 200) {

            $key = $response->body->key;
            $attributes = $response->body->attributes;
            return view('admin.keys.edit', get_defined_vars());
        }
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

        $validator = \Validator::make( $request->all(), [
            'name'       => 'required|string|max:100',
            'name_ar'       => 'required|string|max:100',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }


        $body = $request->all();


        $response = Key::put($id , $body , true );

		// dd($response);

        if ($response->status == 200) {

            $message = $response->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Key Updated Successfully'
                                            ));
            return redirect()->back();
        }

        else {
            $errors = $response->errors;
            Session::flash('errors', $errors);
            return back();
        }
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
        $response = Key::soft_delete($id);
        // dd($response);

        $status = $response->status;

        if ($status == 200) {

            $success = $response->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Key Deleted Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
    public function statusChanged($id){

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/admin/keys/statusChanged/'.$id;
        $response = \Unirest\Request::get($url ,$headers, $body);
        $status = $response->body->status;
        if ($status == 200) {
            return response()->json(['status'=>true,'messages'=>'Key status changed successfully']);
        }
    }

    public function changeStatus(Request $request)
    {

        try{
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url  = config('app.url').'api/admin/key/change/status?key_id='.$request->key_id.'&status='.$request->status;
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
