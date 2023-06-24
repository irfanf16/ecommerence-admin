@extends('admin.layouts.master', ['navItem' => 'partners', 'module' => 'Partners'])
@section('title', 'List of all Partners ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $partners_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/partners/partner.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Partner Default Image">
                            </div>
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
                                <h2>{{ $active_partners }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/partners/active.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Active Partner Default Image">
                            </div>
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
                                <h2>{{ $inactive_partners }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/partners/inactive.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Inactive Partner Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Featured</h5>
                                <h2>{{ $featured_partners }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/featured.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Partners Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Partners</strong></h2>
                        @can('admin-partners-write')
                            <a href="{{ URL::to('/admin/partners/create') }}" title="Go to Add New Partner"
                               class="btn btn-primary">Add Partner</a>
                        @endcan
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Image</th>
                                    <th>Partner</th>
                                    <th>Status</th>
                                    @can('admin-partners-edit')
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @php $count = 1; @endphp
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td width="5%">{{ $count }}</td>
                                        <td width="15%">
                                            @if ($partner->image)
                                                <img
                                                    src='{{ config('app.url') . "admin/images/partners/org/$partner->image" }}'
                                                    alt="{{ $partner->title . ' image' }}" class="w-100 rounded">
                                            @else
                                                <img src="{{ URL::to('/admin/images/icons/partners/default.svg') }}"
                                                     alt="partner Default image" class="w-100 rounded">
                                            @endif

                                        </td>
                                        <td><b>Title: </b> {{ $partner->title }}

                                        </td>
                                        <td>
                                            @if ($partner->status)
                                                <span
                                                    class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                            @else
                                                <span
                                                    class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                            @endif
                                        </td>
                                        @can('admin-partners-edit')

                                            <td width="18%">
                                                <a href='{{ URL::to("admin/partners/$partner->id/edit") }}'
                                                   title="Edit This partner" class="btn btn-primary">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action='{{ URL::to("admin/partners/$partner->id") }}'
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                            title="Delete This Partner">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
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
            $(document).ready(function () {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
