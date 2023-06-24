<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $invoice->name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            /* padding: 0.75rem; */
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #dee2e6
        }

        .table tbody+tbody {
            /* border-top: 2px solid #dee2e6; */
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }

    </style>
</head>

<body>
{{-- Header --}}
@if ($invoice->logo)
    <div style="text-align: left" style="max-height: 150px; max-width: 150px">
        <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
    </div>
@endif

<h1 class="text-uppercase" style="text-align: center; background-color: #0c2a47 ; color: #fff">
    {{-- <strong>{{ $invoice->name }}</strong> --}}
    Storak.qa
</h1>

<table class="table">
    <tbody>

    <tr>
        <td style=" width: 50%">
            <p>Order No.<strong>{{ $invoice->buyer->order->order_no  ?? 'N/A'}}</strong></p>
        </td>
        <td style="width: 50%">
            <p>Order Date:
                <strong>{{ \Carbon\Carbon::parse($invoice->buyer->order->created_at)->format('d-m-Y')  ?? 'N/A'}}</strong>
            </p>
        </td>
{{--        <td style="width: 50%">--}}
{{--            <p>Fulfillment Type: <strong--}}
{{--                    style="text-transform: capitalize">{{ $invoice->buyer->order->fulfillment_detail->name }}</strong>--}}
{{--            </p>--}}
{{--        </td>--}}
{{--        <td style="width: 50%">--}}
{{--            <p>Store Name : <strong--}}
{{--                    style="text-transform: capitalize">{{ $invoice->buyer->order->store_detail->store_name }}</strong>--}}
{{--            </p>--}}
{{--        </td>--}}
    </tr>

    </tbody>
</table>

{{-- Seller - Buyer --}}
<table class="table" style="border: 0px !important; padding-top: -1%;">
    <tbody>
    <tr>
        <td colspan="2" style="font-size: 12px; line-height: 18px ; font-weight: bold">Buyer details</td>
    </tr>
    <tr>
        <td>Name: {{ $invoice->buyer->order->user->name ?? 'N/A' }}</td>
        <td>Payment Method: <span
                style="text-transform: capitalize">{{ $invoice->buyer->order->payment_method ?? 'N/A' }}
                    </span></td>
    </tr>
    <tr>
        <td>Phone: {{ $invoice->buyer->order->user->mobile ?? 'N/A' }}</td>
        <td>Email: {{ $invoice->buyer->order->user->email ?? 'N/A'}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Billing Address</td>
        <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Shipping Address</td>
    </tr>
    <tr>
        <td>
            <p class="buyer-address">
               Address: {{ $invoice->buyer->order->billing_address->user_address ?? 'N/A'}} <br> City: {{ $invoice->buyer->order->billing_address->city_detail->name ?? 'N/A'}} <br> Country:  {{ $invoice->buyer->order->billing_address->country_detail->name  ?? 'N/A'}}
            </p>
        </td>
        <td>
            <p class="buyer-address">
                Address: {{ $invoice->buyer->order->shipping_address->user_address ?? 'N/A'}} <br> City: {{ $invoice->buyer->order->shipping_address->city_detail->name  ?? 'N/A'}} <br> Country:  {{ $invoice->buyer->order->shipping_address->country_detail->name  ?? 'N/A'}}
            </p>
        </td>
    </tr>
    </tbody>
</table>

@foreach($invoice->buyer->order->order_packages as $package)
<h3 class="text-uppercase p-1" style="text-align: center; background-color: #0c2a47 ; color: #fff;padding: 2px">
    Package No {{$package->package_no}}
</h3>

{{-- Seller - Billing info --}}
<table class="table" style="border: 0px !important; padding-top: -1%;">
    <tbody>
    <tr>
        <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Seller Information</td>
        <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Package Billing Information</td>
    </tr>
    <tr>
        <td>
            <p class="buyer-address">
                Store Name:   {{$package->store_detail->store_name ?? 'N/A'}} <br> Seller Name: {{$package->store_detail->vendor_details->name ?? 'N/A'}} <br> Contact Number:  {{$package->store_detail->vendor_details->country_code  ?? 'N/A'.$package->store_detail->vendor_details->mobile ?? 'N/A'}} <br> Email: {{ $package->store_detail->vendor_details->email  ?? 'N/A'}}
            </p>
        </td>
        <td>
            <p class="buyer-address">
                Package Bill: {{ $package->package_bill ?? 'N/A' }} <br> Fulfillment Chargers: {{ $package->fulfillment_charges ?? 'N/A' }} <br> Subtotal: {{$package->package_bill +  $package->fulfillment_charges }}
            </p>
        </td>
    </tr>
    </tbody>
</table>



{{-- Table --}}
<table class="table">
    <thead>
    <tr >
        <th scope="col" class="text-left border-0 pl-0" style="padding: 5px 0px">Seller SKU</th>
        <th scope="col" class="text-left border-0 pl-0" style="padding: 5px 0px">Product Name</th>
        <th scope="col" class="text-left border-0 pl-0" style="padding: 5px 0px">Variant Detail</th>
        <th scope="col" class="text-center border-0" style="padding: 5px 0px">Quantity</th>
        <th scope="col" class="text-center border-0" style="padding: 5px 0px">Unit Price</th>
        <th scope="col" class="text-center border-0" style="padding: 5px 0px">Item Total</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($package->package_items as $item)
        <tr>
            <td style="padding: 5px 0px">{{ $item->product_detail->first_variant->seller_sku ?? 'N/A' }}</td>
            <td style="text-align: left; padding: 5px 0px">{{ $item->product_detail->name  ?? 'N/A'}}</td>
            <td class="text-center" style="padding: 5px 0px" >
                @foreach ($item->product_detail->first_variant->variant_attributes as $variant)
                    <div class="variant-detail-list">
                        <ul>
                            <li>
                                <span>{{ $variant->attribute_detail->title ?? 'N/A' }}</span>
                                <span
                                    style='background-color:  {{ $variant->attribute_detail->title == 'Color' ? $variant->key_detail->name : '' }}'
                                    class='{{ $variant->attribute_detail->title == 'Color' ? 'color-height' : '' }}'>
                                                                    {{ $variant->attribute_detail->title != 'Color' ? $variant->key_detail->name : '' }}
                                                                </span>
                            </li>
                        </ul>
                    </div>

                @endforeach
            </td>
            <td class="text-center" style="padding: 5px 0px" >{{ $item->quantity ?? 'N/A' }}</td>
            <td class="text-center" style="padding: 5px 0px">{{ $item->price ?? 'N/A'}}</td>
            <td class="text-center" style="padding: 5px 0px">{{ $item->price * $item->quantity}}</td>
        </tr>
    @endforeach

    </tbody>
</table>

@endforeach
<table class="table" style="width: 100%">
<tbody>

<tr style="padding: 10px 0px; width: 100%">
    <td style="text-align: right;  border-top: 2px solid rgb(147, 147, 148); padding: 10px 0px 0px 0px; width: 90%" ><b>Subtotal
            :</b>
    </td>

    <td style="padding: 10px 0px 0px 0px; border-top: 2px solid rgb(147, 147, 148);"> &nbsp; &nbsp; {{ $invoice->buyer->order->packages_bill ?? 'N/A' }}</td>
</tr>
    <tr>
        <td style="text-align: right" ><b> Discount :</b>
        </td>
        <td> &nbsp; &nbsp;  {{ $invoice->buyer->order->discount ?? 'N/A' }}</td>
    </tr>
<tr>
    <td style="text-align: right ;" ><b> Grand Total = </b>
    </td>
    <td>
        &nbsp; &nbsp;   {{ $invoice->buyer->order->packages_bill + $invoice->buyer->order->discount }}
    </td>
</tr>
</tbody>
</table>

<br>
<br>
<p>
    * Total charges for this shipment includes prepaid custom duties and other taxes as applicable for the
    merchandise to be delivered to the address in the country specified by the customer .
</p>
<p>For return policy and return form , please visit at <a href="#"> https://www.storak.qa/contact-us/</a></p>
<p>NEED HELP?Contact us at <a href="#"> https://www.storak.qa/contact-us/</a></p>
<p>LIKE US on FACEBOOK:<a href="#">https:facebook.com/storak.qa/</a></p>
<p>FOLLOW US on TWITTER: <a href="#">https:twitter.com/storak.qa/</a></p>
<p>Have a great day! Thank you for shopping on <a href="#">https://storak.qa/</a></p>

<script type="text/php">
        if (isset($pdf) && $PAGE_COUNT > 1) {$text = "Page {PAGE_NUM} / {PAGE_COUNT}";$size = 10; $font = $fontMetrics->getFont("Verdana");$width = $fontMetrics->get_text_width($text, $font, $size) / 2; $x = ($pdf->get_width() - $width);$y = $pdf->get_height() - 35;$pdf->page_text($x, $y, $text, $font, $size);}








                        </script>
</body>

</html>
