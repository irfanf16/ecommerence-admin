<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Session;

use App\Models\Order;


class AdminOrdersController extends Controller
{
    /*
    |============================================================
    | Get Listing of All Orders From API --
    |============================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:admin-orders-read', ['only' => ['index']]);
    }
    public function index()
    {
        try {
            $response = Order::getAll();
            // dd($response);

            $status = $response->status;
            if ($status == 200) {

                $data         = $response;
                $orders       = $response->orders;
                $order_status = $response->order_status;
                $counters     = $response->counters;

                return view('admin.orders.index', compact(
                    'orders',
                    'order_status',
                    'counters',
                    'data'
                ));
            }
            return "Sorry Something Went Wrong";

        }
        catch (\Throwable $th) {

            // throw $th;
            return view('pages.error-500');
        }

    }


    /*
    |============================================================
    | Order Status Listing On Modal -- AJAX REQUEST API
    |============================================================
    */
    public function orderStatus(Request $request)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = null;
        $url = config('app.url') . "api/admin/order/status/$request->orderStatusId";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $orders = $response->body->orders;

            return response()->json([
                'data' => $orders,
            ]);
        }
        return response()->json([
            'data' => "Sorry Something Went Wrong",
        ]);

    }


    /*
    |============================================================
    | Order Status Listing On Modal -- AJAX REQUEST
    |============================================================
    */
    public function orderStatusListing(Request $request)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = $request->all();
        $url = config('app.url') . "api/admin/order/status/listing";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

        return response()->json([
            'data' => $response->body->order_status,
        ]);
        }
    }


    /*
    |============================================================
    | Update Order Status -- API
    |============================================================
    */
    public function orderStatusUpdate(Request $request, $id)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = $request->all();
        $url = config('app.url') . "api/admin/order/status/$id";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            return redirect('admin/orders');
        }

        return "Sorry, Something Went Wrong";
    }


    /*
    |============================================================
    | Show The Form For Creating a New Order -- API
    |============================================================
    */
    public function create()
    {
        //
    }


    /*
     |============================================================
     | Show The Form For Creating a New Order -- API
     |============================================================
     */
    public function store(Request $request)
    {
        //
    }


    /*
    |============================================================
    | Display The Specified Order Details -- API
    |============================================================
    */
    public function show($id)
    {
        try {
            $response = Order::find($id);
            $status = $response->status;
            if ($status == 200) {

                $order = $response->order;
                return view('admin.orders.show', compact(
                    'order'
                ));
            }

            return view('admin.orders.show');

        }
        catch (\Throwable $th) {

            // throw $th;
            return view('pages.error-500');
        }

    }


    /*
    |============================================================
    | Show The Form For Editing The Specified Order -- API
    |============================================================
    */
    public function edit($id)
    {
        //
    }


    /*
    |============================================================
    | Update The Specified Specified Order -- API
    |============================================================
    */
    public function update(Request $request, $id)
    {
        //
    }


    /*
    |============================================================
    | Genrate Order Invoice -- API
    |============================================================
    */
    public function orderInvoice($id)
    {

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = null;
        $url = config('app.url') . "api/admin/order-invoice/$id";
        $response = \Unirest\Request::get($url, $headers, $body);
//       dd($response);
        // dd($response->body->order->order_detail->billing_address);
        $order = $response->body->order;
        $customer = new Buyer([
            'order' => $order,
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);
        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item)
            ->logo(public_path('admin/invoices/storak-qa.png'));

        return $invoice->stream();


        $pdf = PDF::loadView('email.invoice');
        // download PDF file with download method
        return $pdf->download('order-invoice.pdf');

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = null;
        $url = config('app.url') . "api/admin/orders/$id";
        $response = \Unirest\Request::get($url, $headers, $body);

        dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $order = $response->body->orders;
            $data = [
                'order' => $order
            ];


            $pdf = PDF::loadView('email.invoice', $data);
            // download PDF file with download method
            return $pdf->download('order-invoice.pdf');
        }
        return view('admin.orders.index');
    }


    /*
    |============================================================
    | Remove The Specified Order -- API
    |============================================================
    */
    public function destroy($id)
    {
        //
    }
}
