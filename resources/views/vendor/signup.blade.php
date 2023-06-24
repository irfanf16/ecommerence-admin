@extends('admin.layouts.master')
@section('content')



    //-------------------files are including just for designing of the status switch-----------------
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    //-------------------------------CSS of status Swith------------------------------------------
    <style>
        * {
            padding: 0;
            margin: 0;
            outline: 0;
            font-family: 'IBM Plex Sans', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        .switch-toggle {
            display: flex;
            height: 100%;
            align-items: center;
        }

        .switch-btn, .layer {
            position: absolute;
            top: 0px;
            right: 0;
            bottom: 0;
            left: 0;
            padding-top: 0px;
        }

        .button-check {
            position: relative;
            width: 60px;
            height: 26px;
            overflow: hidden;
            border-radius: 50px;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            -ms-border-radius: 50px;
            -o-border-radius: 50px;
        }

        .checkbox {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .switch-btn {
            z-index: 2;
        }

        .layer {
            width: 100%;
            background-color: #8cf7a0;
            transition: 0.3s ease all;
            z-index: 1;
        }

        #button-check .switch-btn:before, #button-check .switch-btn:after {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 30px;
            height: 20px;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            padding: 9px 4px;
            background-color: #00921c;
            border-radius: 50%;
            transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #button-check .switch-btn:before {
            content: 'ON';
        }

        #button-check .switch-btn:after {
            content: 'OFF';
        }

        #button-check .switch-btn:after {
            right: -50px;
            left: auto;
            background-color: #F44336;
        }

        #button-check .checkbox:checked + .switch-btn:before {
            left: -50px;
        }

        #button-check .checkbox:checked + .switch-btn:after {
            right: 4px;
        }

        #button-check .checkbox:checked ~ .layer {
            background-color: #fdd1d1;
        }
    </style>
    //-------------------------------End of CSS of status Switch---------------------------------
    <!-- Start Page content start -->
    <div id="page-content">
        <!-- Table Styles Header -->
        <div class="content-header" style="padding-top: 80px">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>{{$header}}</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Admin</li>
                            <li>Categories</li>
                            <li><a href="">Index</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->


        <!-- Add Category Form Validation Content -->
        <div class="container" style="width: 100% ;margin-top: 0px" id="form_container">
            <div class="row">
                <div class=" col-sm-10  col-md-12  col-lg-12 " style="width: 100%">
                    <!-- Form Validation Block -->
                    <div class="block">
                        <!-- Form Validation Title -->
                        <div class="block-title">
                            <h2>Child Category Form</h2>
                        </div>
                        <!-- END Form Validation Title -->

                        <!-- Form Validation Form -->
                        <form id="form-validation" action="page_forms_validation.html" method="post"
                              class="form-horizontal form-bordered">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val-username"> Vendor Sign Up Form: <span
                                            class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <input required type="text" id="name" name="name" class="form-control"
                                           placeholder="Child Category name..">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">Description: <span
                                            class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <textarea required id="description" name="description" rows="1" class="form-control"
                                              placeholder="Share some details.."></textarea>
                                </div>
                            </div>
                            <!-- Dropdown for category -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="category">Select Category: <span
                                            class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <select required name="category" id="category" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Dropdown for sub category -->

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">Select Sub Category: <span
                                            class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <select required name="subcategory" id="subcategory" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                            </div>


                            <!-- Rounded switch for status -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val-skill">Status:<span
                                            class="text-danger"></span></label>
                                <div class="col-md-6">
                                    <div class="switch-toggle form-control" style="border: none"><br>
                                        <div class="button-check " id="button-check" name="status">
                                            <input type="checkbox" name="status" class="checkbox" style="">
                                            <span class="switch-btn"></span>
                                            <span class="layer" style="align-content: center"></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- Rounded switch for featured -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-skill">Featured:<span
                                                class="text-danger"></span></label>
                                    <div class="col-md-6">
                                        <div class="switch-toggle form-control" style="border: none"><br>
                                            <div class="button-check " id="button-check" name="featured">
                                                <input type="checkbox" class="checkbox" style="" name="featured">
                                                <span class="switch-btn"></span>
                                                <span class="layer" style="align-content: center"></span>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="val-website">Child Category Image:<span
                                                    class="text-danger"></span></label>
                                        <div class="col-md-6">
                                            <input type="file" required id="image" name="image" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group form-actions" >
                                        <div class="col-md-8 col-md-offset-3">
                                            <button type="submit"  class="btn btn-effect-ripple btn-info ">Add</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END Form Validation Form -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Page content -->

@endsection

@section('customScripts')
    <!-- Load and execute javascript code used only in this page -->

    <script>
        $(document).ready(function(){

            $("input,textarea,select").css("box-shadow","rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset")
            $("input,textarea,select").focus(function(){
                $(this).css("box-shadow", "rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px");
            });
            $("input,textarea,select").blur(function(){
                $(this).css("box-shadow", "rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset");
            });

            $("#description").focus(function () {
                var desc=$("textarea");
                desc.animate({"rows":6},0);
            });
            $("#description").blur(function () {
                var desc=$("textarea");
                desc.animate({"rows":1},0);
            });
        });
    </script>
@endsection

