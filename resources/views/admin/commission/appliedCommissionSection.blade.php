@extends('admin.layouts.master',['navItem' => 'commissions', 'module' => 'commissions-current'])
@section('title', 'Commission')

@section('content')
    <style>
        /*html, body {*/
        /*    background: #f2f2f2;*/
        /*}*/
        /** {*/
        /*    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;*/
        /*    font-size: 20px;*/
        /*}*/


        .my-accordian ul.parent {
            background: #fafafa;
            padding: 10px;
            margin: 2em;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.15), 0 10px 10px rgba(0, 0, 0, 0.06);
            border-radius: 4px;
            border-left: 0;
        }

        .my-accordian ul {
            padding-left: 0.5em;
            margin-left: 0.3em;
            border-left: 3px solid #c0d1d1;
            margin-bottom: 1em;
            color: #212b2b;
        }

        .my-accordian li {
            list-style-type: none;
            margin-bottom: 0.75em;
            margin-top: 0.75em;
        }

        .my-accordian details summary {
            cursor: pointer;
        }

        .my-accordian details summary {
            color: #4C74B9;
        }

        .my-accordian details summary::-webkit-details-marker {
            color: #4C74B9;
            font-size: 18px;
        }

        .my-accordian details[open] > summary::-webkit-details-marker {
            color: #2b4b82;
        }

        .my-accordian details[open] > summary {
            color: #2b4b82;
        }

    </style>
    <div class="container-fluid ">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mx-auto">
                    <form id="form" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="my-accordian">
                                <ul class="parent w-100 ">
                                    @foreach($categories as $category)
{{--                                        @dd($category)--}}
                                    <li>
                                        <details>
                                            <summary><strong> {{$category->title}}</strong></summary>
                                            <ul>
                                                @foreach($category->subcategories as $subcategories)
{{--                                                    @dd($subcategories)--}}
                                                <li>
                                                    <details>
                                                        <summary> <strong>{{$subcategories->title}}</strong></summary>
                                                        <ul>
                                                           @foreach($subcategories->childcategories as $childcategories)
{{--                                                               @dd($childcategories)--}}
                                                            <li>
                                                                <div class="row mb-3 align-items-end">
                                                                    <div class=" col-sm-12 col-md-3">
                                                                        <label for="title" class="col-form-label">
                                                                          <strong>{{$childcategories->title}}</strong>
                                                                        </label>
                                                                    </div>

                                                                    <div class=" col-sm-12 col-md-3" >
                                                                        <label for="title" class="col-form-label">
                                                                            Storak Commission
                                                                        </label>

                                                                            <input type="number" min="0" class="form-control @if( !isset($childcategories->applied_commission->storak_commission)) border-danger @endif"
                                                                                   value="{{$childcategories->applied_commission->storak_commission ?? ''}}"  id="storak_commission" name="storak_commission[]" required>

                                                                    </div>
                                                                    <input type="hidden" name="child_categories_id[]" value="{{$childcategories->id}}">
                                                                    <input type="hidden" name="commission_id[]" id="commission_id" value="@if(isset($childcategories->applied_commission)) {{$childcategories->applied_commission->id}} @endif">

                                                                    <div class="col-sm-12 col-md-3 ">
                                                                        <label for="title" class="col-form-label">
                                                                            My Store Commission
                                                                        </label>

                                                                            <input type="number" min="0" class="form-control @if( !isset($childcategories->applied_commission->user_stores_commission)) border-danger @endif"
                                                                                   value="{{$childcategories->applied_commission->user_stores_commission ?? ''}}"    id="user_stores_commission" name="user_stores_commission[]" required>

                                                                    </div>

                                                                </div>

                                                            </li>
                                                            @endforeach
                                                            @can('admin-commission-edit')
                                                               <a  class="btn btn-primary float-right commission_update">Set</a>
                                                               @endif
                                                        </ul>
                                                    </details>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
{{--                            <button type="submit" class="btn btn-primary float-right">Add</button>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('customScripts')
    {{--    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>--}}

    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            $("#form").validate();--}}
    {{--            $('.brands').select2();--}}
    {{--            $('.attributes').select2();--}}

    {{--            // GET SPECIFIC SUB-CATEGORIES--}}
    {{--            $('#category').change(function(e) {--}}
    {{--                let categoryId = $(this).val();--}}
    {{--                getSubCats(categoryId);--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

@endsection
