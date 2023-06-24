@extends('admin.layouts.master', ['navItem' => 'users'])
@section('title', 'Role Edit')


@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close > span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25rem;
            width: 1.25rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close > span:hover {
            background-color: transparent !important;
        }

    </style>
    <div class="container-fluid">

        {{-- warning message row --}}
        {{-- @if (!$store_info)
            <div class="custom-notification danger card">
                <a href="{{ URL::to('/vendor/profile/edit') }}" title="Go To Profile Edit Page">
                    <div class="notification-content">
                        <h2>Store Information Missing!</h2>
                        <p>To add a product please fill your store information first!</p>
                    </div>
                </a>
            </div>
        @endif --}}



        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Edit Role</h3>
                    </div>

                    <div class="card-header border-0">
                        <h6>


                            {{-- <a href="{{ URL::to('/vendor/products/create') }}" title="Go to Add New User "
                                    class="btn btn-primary ">Add User</a> --}}


                            {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}


                            <a href="{{ url('/') }}/admin/roles" title="Go to  User Roles"
                               class="btn btn-primary float-right text-white">Manage Roles</a>


                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">


                            <form id="rolesForm" action="{{ url('/') }}/admin/roles/{{$subrole->id}}" method="POST">
                                @csrf
                                @method('Patch')
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" name="name" value="{{$subrole->name}}" id="name"
                                               class="form-control"
                                               placeholder="Role Name" aria-describedby="helpId">
                                    </div>

                                    <hr>


                                    <div style="max-height: 350px;overflow-y: scroll">
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Dashboard
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Dashboard')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Categories
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Categories')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Sub Categories
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Sub Categories')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Child Categories
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Child Categories')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Brands
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Brands')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Attributes
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Attributes')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Keys
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Keys')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Vendor Stores
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Vendor Stores')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Customers Stores
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Customer Stores')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Vendors
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Vendors')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Customers
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Customers')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Subscribers
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Subscribers')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Contacts
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Contacts')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Products
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Products')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Stock Management
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Stock Management')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Orders
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Orders')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Reviews
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Reviews')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Questions
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Questions')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Locations
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Locations')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Covers
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Covers')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Partners
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Partners')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        User Management
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'User Management')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Manage Roles
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Manage Roles')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Site Setting
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Site Setting')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        App Setting
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'App Setting')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Security Setting
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Security Setting')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Social Links
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Social Links')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="permissions">
                                            <div style="padding-right: 20px; display: flex">
                                                <div class="col-12 pr-10">
                                                    <div class="title text-bold mb-1">
                                                        Commission
                                                    </div>
                                                    <div class=""
                                                         style="padding-right: 20px; display: flex">

                                                        @foreach ($permissions as $permission)
                                                            @if ($permission->name == 'Commission')
                                                                <div class="col-4">
                                                                    <input type="checkbox"
                                                                           value="{{ $permission->id }}"
                                                                           @if(in_array($permission->id, $rolePermissions)) checked
                                                                           @endif
                                                                           name="permissions[]"
                                                                           class="permission-checkbox">
                                                                    <label
                                                                        for="">{{ $permission->display_name }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <button type="submit" id="AddRole" class="btn btn-primary">
                                    Update Role
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function () {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
                $('#clickyes').click(function (e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>

    @endif
@endsection
