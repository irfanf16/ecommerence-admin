@extends('admin.layouts.master', ['navItem' => 'questions', 'module' => 'Customers'])
@section('title', 'All Questions List ')
@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2 id="total-questions">12</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ URL::to('/admin/images/icons/product/newproduct.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Total Products "> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Active Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2 id="active-questions">00</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/active-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Active Products "> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- InActive Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2 id="inactive-questions">12</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/inactive-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Inactive Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Featured Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Answered</h5>
                                <h2 id="answered-questions">22</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/featured-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Featured Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Pending</h5>
                                <h2 id="pending-questions">22</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/featured-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Featured Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong> Questions List </strong></h2>
                    </div>

                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        
                            <div class="row mb-5 mt-5 page-block">
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Status</label>
                                    <select id="question_status" name="status" class="form-control questions_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('question_status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (Session::get('question_status') == 2) selected @endif value="0">In-Active
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>From:</label>
                                    <input id="questions_from_date" value="{{ Session::get('questions_from_date') }}" type="date"
                                           class="form-control questions_filters">
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>To:</label>
                                    <input id="questions_to_date" value="{{ Session::get('questions_to_date') }}" type="date"
                                           class="form-control questions_filters">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="questions_datatable_length" name="datatable_length"
                                                    class="form-control form-control-sm questions_filters">
                                                <option
                                                    {{ Session::get('questions_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('questions_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('questions_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('questions_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select>entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="questionSearch" value="{{ old('search') }}" type="search"
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
                                                <th width="2%">Sr.</th>
                                                <th width="20%">Product Detail</th>
                                                <th width="25%">Customer Detail</th>
                                                <th width="20%">Question</th>
                                                <th width="20%">Vendor Reaction</th>
                                                <th width="15%">Status</th>
                                                <th width="15%">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="questionsList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="questionsPaginationList">
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
            @if (Session::has('question_page_id'))
                page_id = '{{ Session::get('question_page_id') }}'
            @endif
            getQuestions(page_id);
        });

      
    </script>

    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('body').on('click', '.archive-btn', function() {
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This Product will be Archived",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Product has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Product is Safe!");
                        }
                    });
            });
        });

    </script>

    @if (session()->has('response'))
        <script>
            AlertSwal(<?php echo json_encode(session()->get('response')); ?>);
        </script>
    @endif

    <script>
        
        
// function getQuestions(page_id) {
//     var datatable_length = $('#questions_datatable_length').val()
//     var search = $('#questionSearch').val()
//     var status = $('#question_status').val()
//     var from_date = $('#questions_from_date').val()
//     var to_date = $('#questions_to_date').val()
//     $('.pre-loader').show()
//     $.ajax({
//         url: window.location.origin + '/admin/questions/?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search + '&status=' + status + '&from_date=' + from_date + '&to_date=' + to_date,
//         type: 'get',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//         },
//         // datatype : 'html',
//     }).done(function (response) {

        
//         $('#total').empty();
//         $('#active').empty();
//         $('#inactive').empty();
//         $('#answered').empty();
//         $('#pending').empty();
//         $('#total').append(response.total_questions);
//         $('#active').append(response.active_questions);
//         $('#inactive').append(response.inactive_questions);
//         $('#answered').append(response.answer_questions);
//         $('#pending').append(response.pending_questions);

//         console.log(response);
//         var id = 1
//         var customer_status;
//         $('#questionsList').empty()
//         $.each(response.data.data, function (index, value) {

//             if (value.status) {
//                 question_status = $('<label/>', { 'class': 'toggle-switch' }).append(
//                     $('<input/>', {
//                         type: 'checkbox',
//                         name: 'status',
//                         id: 'status-' + value.id + '',
//                         'class': 'question_status_change',
//                         'checked': 'checked',
//                         'data-id': value.id
//                     }),
//                     $('<span/>', { 'class': 'toggle-switch-slider' })
//                 )
//                 // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
//             } else {
//                 question_status = $('<label/>', { 'class': 'toggle-switch' }).append(
//                     $('<input/>', {
//                         type: 'checkbox',
//                         name: 'status',
//                         id: 'status-' + value.id + '',
//                         'class': 'question_status_change',
//                         'data-id': value.id
//                     }),
//                     $('<span/>', { 'class': 'toggle-switch-slider' })
//                 )
//                 // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
//             }

//             $('#questionsList').append(
//                 $('<tr/>').append(
//                     $('<td/>', { style: 'width:5%' }).append(id),
//                     $('<td/>', { style: 'width:5%' }).append( $('<a/>', {
//                         href: 'https://storak.qa/product-detail/' + value.product_detail.slug,
//                         target: '_blank'
//                     }).append('Name: ' + value.product_detail.name)),
//                     $('<td/>', { style: 'width:30%' }).append('<b>Name: </b>'+ value.user_detail.name + '<br>' + '<b> Email: </b>' + value.user_detail.email + '<br>' + '<b> Phone: </b>' + value.user_detail.country_code + ' ' + value.user_detail.mobile ),
//                     $('<td/>', { style: 'width:5%' }).append(value.customer_question),
//                     $('<td/>', { style: 'width:5%' }).append(value.vendor_reply),
//                     $('<td/>', { style: 'width:10%' }).append(question_status),
//                     $('<td/>', { style: 'width:5%' }).append(new Date(value.created_at).toLocaleString()),
//                 )
//             )
//             id++
//         })
//         $('#questionsPaginationList').empty()
//         var links = [];
//         var link
//         $.each(response.data.links, function (index, value) {
//             if (value.url == null && value.label == '&laquo; Previous') {
//                 link = $('<li/>', { 'class': 'questions-pagination page-item disabled' }).append(
//                     $('<a/>', { href: '', 'class': 'page-link' }).append('Previous')
//                 )
//             }
//             if (value.url != null && value.label == '&laquo; Previous') {
//                 var previous = response.data.current_page - 1
//                 link = $('<li/>', { 'class': 'questions-pagination page-item ' }).append(
//                     $('<a/>', { href: '' + previous + '', 'class': 'page-link' }).append('Previous')
//                 )
//             }
//             if (value.url == null && value.label == 'Next &raquo;') {
//                 link = $('<li/>', { 'class': 'questions-pagination page-item disabled' }).append(
//                     $('<a/>', { href: '', 'class': 'page-link' }).append('Next')
//                 )
//             }
//             if (value.url != null && value.label == 'Next &raquo;') {
//                 var next = response.data.current_page + 1;
//                 link = $('<li/>', { 'class': 'questions-pagination page-item ' }).append(
//                     $('<a/>', { href: '' + next + '', 'class': 'page-link' }).append('Next')
//                 )
//             }
//             if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
//                 if (value.active) {
//                     link = $('<li/>', { 'class': 'questions-pagination page-item active' }).append(
//                         $('<a/>', { href: '' + value.label + '', 'class': 'page-link' }).append('' + value.label + '')
//                     )
//                 } else {
//                     link = $('<li/>', { 'class': 'questions-pagination page-item ' }).append(
//                         $('<a/>', { href: '' + value.label + '', 'class': 'page-link' }).append('' + value.label + '')
//                     )
//                 }
//             }
//             links.push(link);
//         })

//         var from = 0;
//         var to = 0;
//         if (response.data.from) {
//             from = response.data.from;
//         }
//         if (response.data.to) {
//             to = response.data.to
//         }

//         $('#questionsPaginationList').append(
//             $('<div/>', { 'class': 'col-sm-12 col-md-5' }).append(
//                 $('<div/>', { 'class': 'dataTables_info' }).append(
//                     'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
//                 )
//             ),
//             $('<div/>', { 'class': 'col-sm-12 col-md-7' }).append(
//                 $('<div/>', { 'class': 'dataTables_paginate paging_simple_numbers' }).append(
//                     $('<ul/>', { 'class': 'pagination', id: 'questionPagination' }).append(
//                         links
//                     )
//                 )
//             ),
//         )
//         $('.pre-loader').hide()

//     }).fail(function (jqXHR, ajaxOptions, thrownError) {
//         $('.pre-loader').hide()
//         console.log(thrownError, ajaxOptions, jqXHR)
//     });
// }

  
        </script>
@endsection
