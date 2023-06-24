<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class AuthApi extends Controller
{
    //


    public static function user(){
        if(session()->has('user')){
            return session()->get('user');
        }
        else{
            return null;
        }
    }

    public static function setuser($user){

            session()->put('user' , $user);
            return session()->get('user');


    }


    public static function token(){
        if(session()->has('token')){
            return session()->get('token');
        }
        else{
            return null;
        }
    }


    public static function store(){
        if(session()->has('store')){
            return session()->get('store');
        }
        else{
            self::getStore();
            return self::store();
        }
    }



    public static function hasStore(){
        $store = self::store();
        $user  = self::user();
        if(isset($store->user_id)){
            if($store->user_id == $user->id){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

    }

    public static function getStore(){
        $user = self::user();
        $store = Store::getBy("/getowner/$user->id");
        // dd($store);
        session()->put('store', $store );
    }




}