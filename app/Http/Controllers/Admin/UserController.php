<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\AuthApi;
use App\Models\SubRole;
use App\Models\SubUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permissions:admin-usermanagement-read', ['only' => ['index']]);
        $this->middleware('permissions:admin-usermanagement-edit', ['only' => ['edit','update']]);
        $this->middleware('permissions:admin-usermanagement-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        //
        // dd(AuthApi::hasStore());
        $response = SubUser::getAll();
        $subrole_list = SubRole::getAll();
        // dd($response);
        return view('admin.users.users')->with([
            'users' => $response->users,
            'subroles' => $subrole_list->subroles
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
//         dd($request->all());
        $response = SubUser::create($request->all() , true);
//         dd($response);
        if($response->status==100 ){
            Session::flash('response', array(
                "status" => 200,
                "action" => 'error',
                "message" => $response->errors[0]
            ));
            return back();
        }
        Session::flash('response', array(
            "status" => 200,
            "action" => 'add',
            "message" => 'User created Successfully'
        ));

        return back();

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
        //

        $response =  SubUser::find($id);
        $subrole_list = SubRole::getAll();

        // dd($user);
        if($response->status == 200){
            return view('vendor.users.edit')->with([
                'user' => $response->user,
                'subroles' => $subrole_list->subroles
            ]);
        }
        else{
            return view('errors.404');
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
        //
        // dd($request->all());
        if($request->password){
            $body=[
                '_method' => 'PATCH',
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $request->password,
            ];
        }
        else{
            $body=[
                '_method' => 'PATCH',

                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,

            ];
        }

        $response = SubUser::put($id , $body , true);
        // dd($response);
        if(!isset($response->status) ){
            dd($response);
        }

        $user  = $response->user;
        $response_assign = SubRole::postBy('/assign' ,['user_id'=> $user->id , 'subrole_id' => $request->subrole_id] , true);
        // dd($response_assign);
        if($response_assign->status == 200){
            return redirect()->back();
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
    }
}
