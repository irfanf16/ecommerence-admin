<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions:admin-customers-read', ['only' => ['allCustomers','customerDetail', 'wishlist','cartItems']]);
        $this->middleware('permissions:admin-customers-edit', ['only' => ['changeStatus']]);
    }

    public function allCustomers(Request $request)
    {

        try {
            if ($request->ajax()) {
                $token = session()->get('token');
                $headers = array('Accept' => 'application/json', 'Authorization' => $token);
                $body = NULL;
                $url = config('app.url') . 'api/admin/customer/profiles?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length . '&search=' . $request->search . '&status=' . $request->status . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
                $response = \Unirest\Request::get($url, $headers, $body);
                // dd($response->body->customers);
                Session::put('customer_page_id', $request->page_id);
                Session::put('customer_datatable_length', $request->datatable_length);
                if ($request->has('status') && $request->filled('status')) {
                    Session::put('customer_status', $request->status == 1 ? 1 : 2);
                } else {
                    Session::put('customer_status', 3);
                }
                Session::put('customer_from_date', $request->from_date);
                Session::put('customer_to_date', $request->to_date);

                $status = $response->body->status;
                if ($status == 200) {
                    $edit=userPermissionCheck::userPermissionCheck('admin-customers-edit');
                    return response()->json([
                        'status' => true,
                        'data' => $response->body->customers,
                        'edit'=>$edit
                    ]);
                }
            }
            return view('admin.customers.index');
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function customerDetail($id)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/customer/detail/$id";

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {
                $customer = $response->body->customer;
                $addresses = $response->body->customer->addresses;
                $cartItems = $response->body->cartItems;
                $wishlistItems = $response->body->wishlistItems;
                $orders = $response->body->customer->orders;
                $productQuestions = $response->body->customer->product_questions;
                $productReviews = $response->body->customer->product_reviews;
                $image_url = config('app.url') . 'storage/product/images/sm/';
                //                $default_image = asset('storage/product/images/sm/default.svg');
                return view('admin.customers.detail', get_defined_vars());
            }

            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/customer/status?user_id=' . $request->user_id . '&status=' . $request->status;
            $response = \Unirest\Request::get($url, $headers, $body);
            $status = $response->body->status;

            if ($status == 200) {
                return response()->json(['status' => $request->status]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function wishlist(Request $request)
    {
        try {
            if ($request->ajax()) {
                $token = session()->get('token');
                $headers = array('Accept' => 'application/json', 'Authorization' => $token);
                $body = NULL;
                $url = config('app.url') . 'api/admin/customer/wishlist?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length  . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
                $response = \Unirest\Request::get($url, $headers, $body);
                Session::put('wishlist_page_id', $request->page_id);
                Session::put('wishlist_datatable_length', $request->datatable_length);
                Session::put('wishlist_from_date', $request->from_date);
                Session::put('wishlist_to_date', $request->to_date);
                // dd($response->body);

                $status = $response->body->status;
                if ($status == 200) {

                    return response()->json([
                        'status' => true,
                        'data' => $response->body->wishlistItems,
                        'imagesUrl' => config('app.url'),
                    ]);
                }
            }
            return view('admin.customers.wishlist');
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function cartItems(Request $request)
    {
        try {
            if ($request->ajax()) {
                $token = session()->get('token');
                $headers = array('Accept' => 'application/json', 'Authorization' => $token);
                $body = NULL;
                $url = config('app.url') . 'api/admin/customer/cartItems?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length  . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
                $response = \Unirest\Request::get($url, $headers, $body);
                Session::put('cartItem_page_id', $request->page_id);
                Session::put('cartItem_datatable_length', $request->datatable_length);
                Session::put('cartItem_from_date', $request->from_date);
                Session::put('cartItem_to_date', $request->to_date);
                // dd($response->body);

                $status = $response->body->status;
                if ($status == 200) {

                    return response()->json([
                        'status' => true,
                        'data' => $response->body->cartItems,
                        'imagesUrl' => config('app.url'),
                    ]);
                }
            }
            return view('admin.customers.cartItem');
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }
}
