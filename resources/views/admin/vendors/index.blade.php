@extends('admin.layouts.master', ['navItem' => 'vendors', 'module' => 'Vendors'])
@section('title', 'All Vendors Profiles ')

@section('content')
    <div class="container-fluid">
        {{-- @include('admin.layouts.vendorpartial') --}}


        <div class="row clearfix">
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                   <a href="{{ URL::to('/admin/vendor/profiles') }}">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                @if(Session::has('vendors'))
                                <h2>{{ $vendors->toal_vendors_count }}</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                   </a>
                </div>
            </div> --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
              <a href="{{ URL::to('/admin/vendor/profiles/incomplete') }}">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Incomplete</h5>
                                 <h2 id="incomplete"></h2>
                            </div>
                            {{-- <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Active Store Default Image">
                            </div> --}}
                        </div>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
             <a href="{{ URL::to('/admin/vendor/profiles/under-review') }}">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Under Review</h5>
                                <h2 id="under-review"></h2>
                            </div>
                            {{-- <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Verified Store Default Image">
                            </div> --}}
                        </div>
                    </div>
                </div>
             </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                   <a href="{{ URL::to('/admin/vendor/profiles/approved') }}">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Approved</h5>
                                <h2 id="approved"></h2>
                            </div>
                            {{-- <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/stores/store.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Store Default Image">
                            </div> --}}
                        </div>
                    </div>
                   </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <a href="{{ URL::to('/admin/vendor/profiles/rejected') }}">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Rejected</h5>
                                <h2 id="rejected"></h2>
                            </div>
                            {{-- <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/stores/featured.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Featured Store Default Image">
                            </div> --}}
                        </div>
                    </div>
                </div>
              </a>
            </div>
        </div>
        

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2 id="all-vendors"><strong>Total Vendors - </strong></h2>
                    </div>
                    <div class="body">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5 mt-5 page-block">
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Profile Status</label>
                                    <select id="profile_status" name="profile_status" class="form-control vendor_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('profile_status') == 0) selected @endif value="0">Incomplete
                                        </option>
                                        <option @if (Session::get('profile_status') == 1) selected @endif value="1">Under Review
                                        </option>
                                        <option @if (Session::get('profile_status') == 2) selected @endif value="2">Approved
                                        </option>
                                        <option @if (Session::get('profile_status') == 3) selected @endif value="3">Rejected
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control vendor_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (Session::get('status') == 2) selected @endif value="0">In-Active
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Form:</label>
                                    <input id="vendor_from_date" value="{{ Session::get('fvendor_rom_date') }}" type="date"
                                           class="form-control vendor_filters">
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>To:</label>
                                    <input id="vendor_to_date" value="{{ Session::get('vendor_from_to') }}" type="date"
                                           class="form-control vendor_filters">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="vendor_datatable_length" name="datatable_length"
                                                    class="form-control form-control-sm vendor_filters">
                                                <option
                                                    {{ Session::get('vendor_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('vendor_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('vendor_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('vendor_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select> entries</label></div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="vendorSearch" value="{{ old('search') }}" type="search"
                                                          name="search" class="form-control form-control-sm"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="" style="position: relative;">
                                        <div class="pre-loader" style="display: none">
                                            <div class="loader-for-datatable" style=""></div>
                                        </div>
                                        <table id="DataTables_Table_0" class="table table-hover  no-footer"
                                               role="grid" aria-describedby="DataTables_Table_0_info">
                                            <thead>
                                            <tr role="row">
                                                <th width="5%">Sr.</th>
                                                <th width="10%">Profile Image</th>
                                                <th>Vendor Details</th>
                                                <th>Registered On</th>
                                                <th>Profile Updated On</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody id="vendorList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="vendorPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')


<script>
    $(document).ready(function() {

        var page_id = 1;
        @if (Session::has('vendor_page_id'))
            page_id = '{{ Session::get('vendor_page_id') }}'
        @endif
        getVendors(page_id);
    });
</script>

@endsection
