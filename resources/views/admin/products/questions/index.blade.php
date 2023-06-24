@extends('admin.layouts.master', ['navItem' => 'products', 'module' => 'Questions'])
@section('title', 'Product All Questions ')

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
                                <h5>Questions</h5>
                                <h2>{{ $questions_count }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/questions/question.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Questions Default Image">--}}
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
                                <h5>Unreplied</h5>
                                <h2>{{ $unreplied_questions}}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/questions/unreplied.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Unreplied Questions Default Image">--}}
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
                                <h2>{{ $active_questions}}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/questions/active.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Active Questions Default Image">--}}
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
                                <h2>{{ $inactive_questions }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/questions/inactive.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Inactive Questions Default Image">--}}
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
                        <h2><strong>Questions</strong></h2>
                        <a
                            href='{{ URL::to("/admin/products") }}'
                            title="Add new variant for this product" class="btn btn-primary text-white">Back</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th  width="5%">Sr.</th>
                                        <th width="10%">Question</th>
                                        <th width="10%">Answer</th>
                                        <th width="10%">Status</th>
{{--                                        <th width="18%">Actions</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($questions as $quest)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td><strong>{{ $quest->customer_question }}</strong></td>
                                            <td>
                                                @if ($quest->vendor_reply)
                                                    <strong>{{ $quest->vendor_reply }}</strong>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-capitalize">Unreplied
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($quest->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-capitalize">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-capitalize">Inactive
                                                    </span>
                                                @endif
                                            </td>

{{--                                            <td>--}}
{{--                                                <a href="{{ URL::to("admin/products/$quest->product_id/questions/$quest->id/edit") }}"--}}
{{--                                                    title="Edit This Question" class="btn btn-primary">--}}
{{--                                                    <span class="btn-inner--icon">--}}
{{--                                                        <i class="fa fa-edit"></i>--}}
{{--                                                    </span>--}}
{{--                                                </a>--}}
{{--                                                <form action='{{ URL::to("admin/products/$quest->product_id/questions/$quest->id") }}'--}}
{{--                                                    method="POST" class="d-inline">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}

{{--                                                    <button type="submit" class="btn btn-danger"--}}
{{--                                                        title="Delete This Question">--}}
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
