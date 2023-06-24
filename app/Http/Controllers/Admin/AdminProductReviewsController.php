<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminProductReviewsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-reviews-read', ['only' => ['index','show','reviewsList']]);
        $this->middleware('permissions:admin-reviews-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-reviews-write', ['only' => ['store','create']]);
    }
    public function index($pid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/reviews";
        $response = \Unirest\Request::get($url, $headers, $body);

        //         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $reviews = $response->body->reviews;
            $reviews_count = $response->body->reviews_count;
            $active_reviews = $response->body->active_reviews;
            $inactive_reviews = $response->body->inactive_reviews;

            return view('admin.products.reviews.index')->with(['reviews' => $reviews])
                ->with(['reviews_count' => $reviews_count])
                ->with(['active_reviews' => $active_reviews])
                ->with(['inactive_reviews' => $inactive_reviews]);
        }

        return "Something Went Wrong";
    }

    public function reviewsList(Request $request)
    {
        if ($request->ajax()) {
             dd($request->all());
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/reviews?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search .  '&status=' . $request->status . '&is_reported=' . $request->is_reported . '&reviews=' . $request->reviews . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
            $response = \Unirest\Request::get($url, $headers, $body);
             dd($response);
            $status = $response->body->status;
            if ($status == 200) {
                $reviews = $response->body->reviews;
                \Illuminate\Support\Facades\Session::put('review_page_id', $request->page_id);
                Session::put('reviews_from_date', $request->from_date);
                Session::put('reviews_to_date', $request->to_date);
                Session::put('reviews_datatable_length', $request->datatable_length);
                if ($request->has('is_reported') && $request->filled('is_reported')) {
                    Session::put('is_reported', $request->is_reported == 1 ? 1 : 2);
                } else {
                    Session::put('is_reported', 3);
                }
                if ($request->has('status') && $request->filled('status')) {
                    Session::put('review_status', $request->status == 1 ? 1 : 2);
                } else {
                    Session::put('review_status', 3);
                }
                if ($request->has('reviews') && $request->filled('reviews')) {
                    Session::put('reviews', $request->reviews == 1 ? 1 : 2);
                } else {
                    Session::put('reviews', 3);
                }

            $active_reviews = $response->body->active_reviews;
            $inactive_reviews = $response->body->inactive_reviews;
            $total_reviews = $response->body->total_reviews;
            $answer_reviews = $response->body->answer_reviews;
            $pending_reviews = $response->body->pending_reviews;
            $edit=userPermissionCheck::userPermissionCheck('admin-reviews-edit');
                return response()->json([
                    'data' => $reviews,
                    'active_reviews' => $active_reviews,
                    'inactive_reviews' => $inactive_reviews,
                    'total_reviews' => $total_reviews,
                    'answer_reviews' => $answer_reviews,
                    'pending_reviews' => $pending_reviews,
                    'imagesUrl' => config('app.url'),
                    'edit'=>$edit
                ]);
            }
        }

        return view('admin.reviews.index');
    }

    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
        //
    }


    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {
    }


    /*
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        //
    }


    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($pid, $rid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/reviews/$rid/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $review = $response->body->review;
            return view('admin.products.reviews.edit')->with(["review" => $review]);
        }

        return "Sorry, Something Went Wrong";
    }


    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $pid, $rid)
    {
        $validator = \Validator::make($request->all(), [
            'review' => 'required|string',
            'rating' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $url = config('app.url') . "api/admin/products/$pid/reviews/$rid";
        $body = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array(
                "status" => 200,
                "action" => 'update',
                "message" => 'Product Review is Updated Successfully'
            ));
            return back();
        } else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }


    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($pid, $rid)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/admin/products/$pid/reviews/$rid";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $success = $response->body->message;
            Session::flash('response', array(
                "status" => 200,
                "action" => 'delete',
                "message" => 'Product Review is Deleted Successfully'
            ));
            return back();
        } else {
            return "Sorry, Something Went Wrong";
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/review/status?review_id=' . $request->review_id . '&status=' . $request->status;
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
}
