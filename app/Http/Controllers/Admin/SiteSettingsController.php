<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permissions:admin-sitesetting-read', ['only' => ['index']]);
        $this->middleware('permissions:admin-sitesetting-edit', ['only' => ['edit','update']]);
        $this->middleware('permissions:admin-sitesetting-write', ['only' => ['store','create']]);
    }
    public function index()
    {
        return view('admin.SiteSettings.index');
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
        $validator = \Validator::make( $request->all(), [
            'title'                 =>      'required|string|max:150',
            'slogan'                =>      'required|string|max:255',
            'favicon' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'preloader' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
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
        //
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
