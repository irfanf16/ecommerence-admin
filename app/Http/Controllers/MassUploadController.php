<?php

namespace App\Http\Controllers;

use App\Models\MassuploadProduct;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;

class MassUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     use ApiHelper;
    public function index()
    {
        //

        return view('admin.mass-upload.products.index');

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

        // $csv = str_getcsv(file_get_contents($request->file('product_csv')));
        // $csv = array();
        // $file = fopen($request->file('product_csv'), 'r');

        // while (($result = fgetcsv($file)) !== false)
        // {
        //     $csv[] = $result;
        // }

        // fclose($file);
        // dd($csv) ;

        $dataurl = $this->file64($request->file('product_csv'));
        // dd($dataurl);
        $response = MassuploadProduct::create([
            'product_csv' => $dataurl
        ] , true);

        dd($response);
        // // dd($dataurl);
        // $file = $this->base64_to_file($dataurl);
        // dd($file);

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
        //
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