@extends('admin.layouts.master', ['navItem' => 'banners'])
@section('title', 'List of all mobile homescreen covers ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>TOTAL</h6>
                        <h2>{{ $covers_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>ACTIVE</h6>
                        <h2>{{ $active_covers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>IN-ACTIVE</h6>
                        <h2>{{ $inactive_covers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Mobile Homepage Covers</strong></h2>
                        @can('admin-covers-write')
                        <a href="{{ URL::to('/admin/mobile/covers/create') }}" title="Go to Add New Mobile Cover Page"
                            class="btn btn-primary">Add Cover</a>
                        @endcan
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cover</th>
                                        <th>Status</th>
                                        @can('admin-covers-edit')
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($covers as $cover)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td width="15%">
                                                @if ($cover->image)
                                                    <img src='{{ config('app.url') . "storage/banners/mobile/sm/$cover->image" }}'
                                                        alt="" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/default/banner.svg') }}"
                                                        alt="Cover Default image" class="w-100 rounded">
                                                @endif

                                            </td>
                                            <td>
                                                @if ($cover->status)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            @can('admin-covers-edit')

                                            <td width="18%">
                                                <a href="{{ URL::to("admin/mobile/covers/$cover->id/edit") }}"
                                                    title="Edit This Cover" class="btn btn-primary">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action="{{ URL::to('admin/mobile/covers/' . $cover->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Delete This Cover">
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
            $(document).ready(function() {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
