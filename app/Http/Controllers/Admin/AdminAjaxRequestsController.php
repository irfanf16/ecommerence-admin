<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminAjaxRequestsController extends Controller
{
    /*
    |===================================================
    | Get Specific Categories Using Ajax
    |===================================================
    */
    public function categoriesList(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/subcategories"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        $code   = $response->code; 
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $categories =  $response->body->categories;
            return response()->json([
                "status"     => 200,
                'categories' => $categories,
            ]);
        }
    }


    /*
    |===================================================
    | Get Specific Sub-Categories Using Ajax
    |===================================================
    */
    public function subcategoriesList(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/subcategories"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $subcategories = $response->body->subcategories;
            return response()->json([
                "status"        => 200,
                'subcategories' => $subcategories,
            ]);
        }
    }



    /*
    |===================================================
    | Get Specific Child-Categories Using Ajax
    |===================================================
    */
    public function childcategoriesList(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/childcategories"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $childcategories = $response->body->childcategories;
            return response()->json([
                "status"          => 200,
                'childcategories' => $childcategories,
            ]);
        }
    }


    /*
    |===================================================
    | Get Specific Variants Using Ajax
    |===================================================
    */
    public function variantsList(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/variants"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $variants = $response->body->variants;
            return response()->json([
                "status"  => 200,
                'variants'=> $variants,
            ]);
        }
    }

    public function multipleSubCategories(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/multiple-subcategories"; 
        $response = \Unirest\Request::get($url, $headers, $body);
        // dd($response);
        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $subcategories = $response->body->subcategories;
            return response()->json([
                "status"        => 200,
                'subcategories' => $subcategories,
            ]);
        }
    }

    public function multipleChildCategories(Request $request)
    {  
        $token = session()->get('token');
        
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/multiple-childcategories"; 
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $code   = $response->code;
        $status = $response->body->status;

        if ($code == 200 && $status == 200) {

            $childcategories = $response->body->childcategories;
            return response()->json([
                "status"          => 200,
                'childcategories' => $childcategories,
            ]);
        }
    }
}
