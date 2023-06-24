<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminProductQuestionsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-questions-read', ['only' => ['index','show','reviewsList']]);
        $this->middleware('permissions:admin-questions-edit', ['only' => ['edit','update','destroy','changeStatus']]);
        $this->middleware('permissions:admin-questions-write', ['only' => ['store','create']]);
    }
    public function index($pid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions";
        $response = \Unirest\Request::get($url ,$headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $questions          = $response->body->questions;
            $questions_count    = $response->body->questions_count;
            $unreplied_questions= $response->body->unreplied_questions;
            $active_questions   = $response->body->active_questions;
            $inactive_questions = $response->body->inactive_questions;

            return view('admin.products.questions.index')->with(['questions'          => $questions])
                                                         ->with(['questions_count'    => $questions_count])
                                                         ->with(['unreplied_questions'=> $unreplied_questions])
                                                         ->with(['active_questions'   => $active_questions])
                                                         ->with(['inactive_questions' => $inactive_questions]);
        }

        return "Something Went Wrong";
    }

    public function questionsList(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->all());
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/questions?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search .  '&status=' . $request->status . '&is_reported=' . $request->is_reported . '&questions=' . $request->questions . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);
            $status = $response->body->status;
            if ($status == 200) {
                $questions = $response->body->questions;
                \Illuminate\Support\Facades\Session::put('question_page_id', $request->page_id);
                Session::put('questions_from_date', $request->from_date);
                Session::put('questions_to_date', $request->to_date);
                Session::put('questions_datatable_length', $request->datatable_length);
                if ($request->has('is_reported') && $request->filled('is_reported')) {
                    Session::put('is_reported', $request->is_reported == 1 ? 1 : 2);
                } else {
                    Session::put('is_reported', 3);
                }
                if ($request->has('status') && $request->filled('status')) {
                    Session::put('question_status', $request->status == 1 ? 1 : 2);
                } else {
                    Session::put('question_status', 3);
                }
                if ($request->has('questions') && $request->filled('questions')) {
                    Session::put('questions', $request->questions == 1 ? 1 : 2);
                } else {
                    Session::put('questions', 3);
                }

            $active_questions = $response->body->active_questions;
            $inactive_questions = $response->body->inactive_questions;
            $total_questions = $response->body->total_questions;
            $answer_questions = $response->body->answer_questions;
            $pending_questions = $response->body->pending_questions;
            $edit=userPermissionCheck::userPermissionCheck('admin-questions-edit');
                return response()->json([
                    'data' => $questions,
                    'active_questions' => $active_questions,
                    'inactive_questions' => $inactive_questions,
                    'total_questions' => $total_questions,
                    'answer_questions' => $answer_questions,
                    'pending_questions' => $pending_questions,
                    'imagesUrl' => config('app.url'),
                    'edit'=>$edit
                ]);
            }
        }

        return view('admin.questions.index');
    }

    public function changeStatus(Request $request)
    {
        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/admin/question/status?question_id=' . $request->question_id . '&status=' . $request->status;
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
    public function edit($pid, $qid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $question    = $response->body->question;
            return view('admin.products.questions.edit')->with(["question" => $question]);
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $pid, $qid)
    {
        $validator = \Validator::make( $request->all(), [
            'question' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid";
        $body     = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Product Question is Updated Successfully'
                                            ));
            return back();
        }

        else {
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
    public function destroy($pid, $qid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Product Question is Deleted Successfully'
                                            ));
            return back();
        }
        else{
            return "Sorry, Something Went Wrong";
        }
    }

}
