<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminVendorsController extends Controller
{
    // private function vendorsCount()
    // {
    //     $token    = session()->get('token');
    //     $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
    //     $body     = NULL;
    //     $url      = config('app.url') . 'api/admin/vendor/profiles';
    //     $response = \Unirest\Request::get($url, $headers, $body);
    //     // dd($response);
    //     $vendors = [
    //         'total_vendors_count' => $response->body->vendors->total_vendors_count,
    //         'incomplete_vendors_count' => $response->body->vendors->incomplete_vendors_count,
    //         'under_review_vendors_count' => $response->body->vendors->under_review_vendors_count,
    //         'approved_vendors_count' => $response->body->vendors->approved_vendors_count,
    //         'rejected_vendors_count' => $response->body->vendors->rejected_vendors_count,
    //     ];
    //     return $vendors;
    // }
    public function __construct()
    {
        $this->middleware('permissions:admin-vendors-read', ['only' => ['allVendors','incompleteVendors',
            'underReviewVendors','approvedVendors','rejectedVendors','incompleteVendorDetail']]);
//        $this->middleware('permissions:admin-customerstores-edit', ['only' => ['edit','update','destroy','changeStatus']]);
//        $this->middleware('permissions:admin-customerstores-write', ['only' => ['store','create']]);
    }

    public function allVendors(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . 'api/admin/vendor/profiles?page=' . $request->page_id . '&datatable_length=' . $request->datatable_length . '&search=' . $request->search . '&status=' . $request->status . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date . '&profile_status=' . $request->profile_status;

        try {
            if ($request->ajax()) {
                $response = \Unirest\Request::get($url, $headers, $body);
                // dd($response);
                Session::put('vendor_page_id', $request->page_id);
                Session::put('vendor_datatable_length', $request->datatable_length);
                if ($request->has('status') && $request->filled('status')) {
                    Session::put('vendor_status', $request->status == 1 ? 1 : 2);
                } else {
                    Session::put('vendor_status', 3);
                }
                //profile status
                if ($request->has('profile_status') && $request->filled('profile_status')) {
                    Session::put('profile_status', $request->profile_status);
                } else {
                    Session::put('profile_status', 4);
                }
                Session::put('vendor_from_date', $request->from_date);
                Session::put('vendor_to_date', $request->to_date);
                $status = $response->body->status;
                if ($status == 200) {
                    $allVendors = $response->body->vendors;
                    $vendor_counts = $response->body->vendor_counts;
                    $edit=userPermissionCheck::userPermissionCheck('admin-vendors-edit');
                    return response()->json([
                        'status' => true,
                        'data' => $allVendors,
                        'vendor_counts' => $vendor_counts,
                        'edit' => $edit,
                        'imagesUrl' => config('app.url'),
                    ]);
                }
            }
            return view('admin.vendors.index');
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    /*
    |====================================================================
    | Get Listing Of Incomplete Vendor-Profiles
    |====================================================================
    */
    public function incompleteVendors()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . 'api/admin/vendor/profiles/incomplete';

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $incomplete_vendors = $response->body->incomplete_vendors;
                // dd($incomplete_vendors);
                $vendors = $this->vendorsCount();
                return view('admin.vendors.incomplete', get_defined_vars());
            }

            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |====================================================================
    | Get Listing of Under-Review Vendor-Profiles
    |====================================================================
    */
    public function underReviewVendors()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . 'api/admin/vendor/profiles/under-review';

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);


            if ($response->body->status == 200) {

                $under_review_vendors = $response->body->under_review_vendors;
                $vendors = $this->vendorsCount();
                return view('admin.vendors.under_review', get_defined_vars());
            }
            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }
    /*
    |====================================================================
    | Get Listing of Approved Vendor-Profiles
    |====================================================================
    */
    public function approvedVendors()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . 'api/admin/vendor/profiles/approved';

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $approved_vendors = $response->body->approved_vendors;
                $vendors = $this->vendorsCount();
                return view('admin.vendors.approved', get_defined_vars());
            }

            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }




    /*
    |====================================================================
    | Get Listing of Rejected Vendor-Profiles
    |====================================================================
    */
    public function rejectedVendors()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . 'api/admin/vendor/profiles/rejected';

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $rejected_vendors = $response->body->rejected_vendors;
                $vendors = $this->vendorsCount();
                return view('admin.vendors.rejected', get_defined_vars());
            }
            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |====================================================================
    | Display Incomplete Vendor Profile Information
    |====================================================================
    */
    public function incompleteVendorDetail($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . "api/admin/vendor/profile/incomplete/$id";

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $profile_detail = $response->body->profile_detail;
                return view('admin.vendors.incomplete_profile_detail')->with(["profile_detail" => $profile_detail]);
            }

            return "Sorry, Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |====================================================================
    | Display Vendor Profile Detail
    |====================================================================
    */
    public function vendorProfileDetail($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url') . "api/admin/vendor/profile/detail/" . $id;

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $profile_details = $response->body->profile_details;
                $vendor_request  = $response->body->vendor_request;
                $profile_status  = $response->body->profile_details->vendor_profile_status;
                $documents       = $response->body->documents;
                $cities          = $response->body->cities;
                $categories      = $response->body->categories;

                return view('admin.vendors.vendor_profile_detail')->with(['profile_details' => $profile_details])
                    ->with(['vendor_request' => $vendor_request])
                    ->with(['cities'         => $cities])
                    ->with(['profile_status' => $profile_status])
                    ->with(['categories'     => $categories])
                    ->with(['documents'      => $documents]);
            }

            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }
    /*
    |====================================================================
    | Update Vendor Profile Status -- Accepted/Rejected
    |====================================================================
    */
    public function updateVendorStatus(Request $request, $id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url') . "api/admin/vendor/profile/update-status/$id";

        try {
            $response = \Unirest\Request::post($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {
                return redirect('admin/vendor/profiles/approved');
            }
            return "Something Went Wrong";
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }
}
