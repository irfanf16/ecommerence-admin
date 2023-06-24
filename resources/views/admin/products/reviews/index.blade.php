@extends('admin.layouts.master', ['navItem' => 'products', 'module' => 'Reviews'])
@section('title', 'Product All Reviews ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="page-block">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Reviews</h5>
                                <h2>{{ $reviews_count }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/reviews/review.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Reviews Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_reviews }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/reviews/active.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Active Reviews Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_reviews }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/reviews/inactive.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Inactive Reviews Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="header">
                        <h2><strong>Reviews</strong></h2>
                        <a
                            href='{{ URL::to("/admin/products") }}'
                            title="Add new variant for this product" class="btn btn-primary text-white">Back</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="10%">Review</th>
                                        <th width="10%">Rating</th>
                                        <th width="10%">Vendor Reaction</th>
                                        <th width="10%">Status</th>
{{--                                        <th width="18%">Actions</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($reviews as $rev)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td><strong>{{ $rev->customer_review }}</strong></td>
                                            <td><strong>{{ $rev->customer_rating }}</strong></td>
                                            <td>
                                                @if ($rev->vendor_reply)
                                                    <strong>{{ $rev->vendor_reply }}</strong>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-capitalize">Not Reacted
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rev->status)
                                                    <span class="badge badge-lg badge-success text-capitalize">Active
                                                    </span>
                                                @else
                                                    <span class="badge badge-lg badge-danger text-capitalize">Inactive
                                                    </span>
                                                @endif
                                            </td>
{{--                                            <td>--}}
{{--                                                <a href="{{ URL::to("admin/products/$rev->product_id/reviews/$rev->id/edit") }}"--}}
{{--                                                    title="Edit This Review" class="btn btn-primary">--}}
{{--                                                    <span class="btn-inner--icon">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </span>--}}
{{--                                                </a>--}}
{{--                                                <form--}}
{{--                                                    action='{{ URL::to("admin/products/$rev->product_id/reviews/$rev->id") }}'--}}
{{--                                                    method="POST" class="d-inline">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}

{{--                                                    <button type="submit" class="btn btn-danger" title="Delete This Review">--}}
{{--                                                        <span class="btn-inner-icon">--}}
{{--                                                            <i class="fa fa-trash-o"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
                                            @php $count++; @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Session::has('response'))
    @section('customScripts')
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
