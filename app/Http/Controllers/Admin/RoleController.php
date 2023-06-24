<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\SubRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
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
        $response = SubRole::getAll();
//        $module_list  = Module::getAll();
//         dd($response);

        return view('admin.roles.roles')->with([
            'subroles' =>   $response->subroles,
            'permissions'  =>   $response->permissions,
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
        $response  = SubRole::create($request->all() , true);
//        $subrole = $response->subrole;
//        $role_permission = [
//            'subrole_id' => $subrole->id,
//            'permissions' => $request->permissions
//        ];
//        $response = SubRole::postBy('/permissions',$role_permission , true);
        $status = $response->status;

        if ($status == 200) {
            Session::flash('response', array(
                "status" => 200,
                "action" => 'add',
                "message" => $response->message
            ));
            return back();
        }
        dd('something went wrong');
//        return response()->json($response);

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

//        $module_list  = Module::getAll();
        $response = SubRole::find($id);
//         dd($response);

        return view('admin.roles.edit')->with([
            'subrole' => $response->subrole,
            'rolePermissions' => $response->rolePermissions,
            'permissions'  =>   $response->permissions,

        ]);
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

        $response  = SubRole::put( $id ,['name' => $request->name  ,'permissions'=>$request->permissions, '_method' => "Patch"] , true);
        $status = $response->status;

        if ($status == 200) {
            Session::flash('response', array(
                "status" => 200,
                "action" => 'update',
                "message" => $response->message
            ));
            return back();
        }
        dd('something went wrong');
        return response()->json($response);
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
