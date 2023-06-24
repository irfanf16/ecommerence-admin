<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
trait userPermissionCheck
{
//

    public static function userPermissionCheck($module){

//        $module  = explode("." , $module);
//        $user = session()->get('user');
//
//        if(isset($user->subrole->permissions)){
//            $permissions  = json_decode($user->subrole->permissions);
//
//        }
//        else{
//            $permissions = [];
//        }
//
//        // dd($permissions);
//
//        // $permission =
//        $counter = 0;
//        foreach($module as $m){
//            if($counter == 0){
//                if(isset($permissions->{$m})){
//
//                    $permissions = $permissions->{$m};
//                    // dd($permissions);
//                }
//                else{
//                    // dd( "Module ($m) does not exist");
//                    return false;
//                }
//            }
//            else{
//                if(isset($permissions->childs->{$m})){
//
//                    $permissions = $permissions->childs->{$m};
//                }
//                else{
//                    // dd( "Module ($m) does not exist");
//                    return false;
//
//                }
//            }
//
//            $counter = $counter +1;
//
//        }
//
//        $module = $permissions;
//
//        if(isset($module)){
//
//            if(in_array($operation , $module->operations)){
//                return true;
//            }
//            else{
//
//                return false;
//            }
//        }else{
//            dd( "Module does not exit");
//        }
return true;
        $user_role_permissions = session()->get('user_role_permissions');
        if(isset($module)){
            foreach ($user_role_permissions as $permission){
                if ($permission->slug==$module){
                    return true;
                }
            }
            return false;
        }else{
            return false;
        }

    }

}
