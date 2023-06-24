<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    /*
    |===============================================================
    | Show the Form For Admin Login Page
    |===============================================================
    */
    public function loginView()
    {
        try {
            return view('auth.login');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    /*
    |===============================================================
    | Login Storak Admin With Provided Credentials
    |===============================================================
    */
    public function login(Request $request)
    {
        $headers  = array('Accept' => 'application/json');
        $body     = $request->all();
        $url      = config('app.url').'api/login';

        $response = \Unirest\Request::post($url, $headers, $body);
//         dd($response);
        $status  = $response->body->status;

        if ($status == 200) {
            $user = $response->body->user;
            // IF AUTH-USER IS NOT STORAK-ADMIN
            if ($user->role_id != 1) {
                return response()->view('admin.pages.403');
            }

            $token         = $response->body->token;
            $notifications = $response->body->notifications;
            $user_role_permissions   =isset($response->body->user_role_permissions[0]) ? $response->body->user_role_permissions[0]->permissions:[];

            Session::put('user', $user);
            Session::put('token', "Bearer".$token);
            Session::put('notifications', $notifications);
            Session::put('user_role_permissions', $user_role_permissions);

            return redirect('admin/dashboard');
        }
        $message = $response->body->message;
        return view('auth.login',['status' => $message]);
    }
    /*
    |===================================================
    | Show the form for registering a new user.
    |===================================================
    */
    public function registerView()
    {
        try {
            return redirect('/');
            return view('auth.register');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    /*
    |===================================================
    | Try to register user with provided credentials.
    |===================================================
    */
    public function register(Request $request)
    {
        try {
            return redirect('/');
            $headers  = array('Accept' => 'application/json');
            $body     = $request->all();
            $url      = config('app.url').'api/register';
            $response = \Unirest\Request::post($url, $headers, $body);
            // dd($response);
            $status = $response->body->status;
            if ($status == 200 ) {
                return redirect('admin/dashboard');
            }
            else{
                $errors = $response->body->errors;
                Session::flash('errors',$errors);
                return back();
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    /*
    |===================================================
    | Logout user from system
    |===================================================
    */
    public function logout()
    {
        try {
            session()->flush();
            return redirect('/');
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
