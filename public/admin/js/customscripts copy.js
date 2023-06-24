/*
|===============================================
|  Cookies Functions
|===============================================
*/
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    let user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

/*
|===============================================
|  GET SPECIFIC SUB-CATEGORIES USING AJAX
|===============================================
*/
function getSubCats(id) {
    let categoryId = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/admin/ajax/subcategories", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/subcategories", // Live Link
        data: {
            categoryId: categoryId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.subcategories.length;

            if (records > 0) {
                $("#subcategory").empty();
                $("#childCategory").empty();

                subcategories = response.subcategories;
                $.each(subcategories, function (key, subcategory) {
                    $("#subcategory").append(
                        '<option  value="' +
                        subcategory.id +
                        '">' +
                        subcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#subcategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

/*
|===============================================
|  GET SPECIFIC CHILD-CATEGORIES USING AJAX
|===============================================
*/
function getChildCats(id) {
    let subcategoryId = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/admin/ajax/childcategories", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/childcategories", // Live Link
        data: {
            subcategoryId: subcategoryId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.childcategories.length;

            if (records > 0) {
                $("#childCategory").empty();
                childcategories = response.childcategories;
                $.each(childcategories, function (key, childcategory) {
                    $("#childCategory").append(
                        '<option  value="' +
                        childcategory.id +
                        '">' +
                        childcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#childCategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

//multiple sub categories
function getMultipleSubCats(id) {
    let categoryId = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/admin/ajax/multiple-subcategories", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/subcategories", // Live Link
        data: {
            categoryId: categoryId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.subcategories.length;

            if (records > 0) {
                $("#subcategory").empty();
                $("#childCategory").empty();

                subcategories = response.subcategories;
                $.each(subcategories, function (key, subcategory) {
                    $("#subcategory").append(
                        '<option  value="' +
                        subcategory.id +
                        '">' +
                        '<strong>' + subcategory.category.title + '</strong> -> ' + subcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#subcategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

// multiple child categories

function getMultipleChildCats(id) {
    let subcategoryId = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/admin/ajax/multiple-childcategories", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/childcategories", // Live Link
        data: {
            subcategoryId: subcategoryId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.childcategories.length;

            if (records > 0) {
                $("#childCategory").empty();
                childcategories = response.childcategories;
                $.each(childcategories, function (key, childcategory) {
                    $("#childCategory").append(
                        '<option  value="' +
                        childcategory.id +
                        '">' +
                        childcategory.category.title + ' -> ' + childcategory.subcategory.title + ' -> ' + childcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#childCategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}


/*
|===============================================
|  GET SPECIFIC VARIANTS USING AJAX
|===============================================
*/
function getVariants(id) {
    let attributeId = id;
    //console.log(attributeId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/admin/ajax/variants", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/variants", // Live Link
        data: {
            attributeId: attributeId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.variants.length;

            if (records > 0) {
                $("#variant").empty();
                variants = response.variants;
                $.each(variants, function (key, variant) {
                    $("#variant").append(
                        '<option  value="' +
                        variant.id +
                        '">' +
                        variant.title +
                        "</option>"
                    );
                });
            } else {
                $("#variant").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

//  keys
$(document).ready(function () {
    $(document).on('click', '.Key-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getKeys(page);
    });
    $('#key_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getKeys(page)
    });
    // $('#keySearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#keyPagination').find('li.active a').attr('href');
    //     getKeys(page)
    //
    // });
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example
    var $input = $('#keySearch');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getKeys(page)
    }

    // $(document).on('click', '.key_status_change', function(event) {
    //     // event.preventDefault();
    //     console.log($(this))
    //     var key_id = $(this).attr('id');
    //     console.log('key id is ' + key_id)
    //     $.ajax({
    //         url: 'keys/status/changed/' + key_id,
    //         type: 'get',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //         },
    //         // datatype : 'html',
    //     }).done(function(response) {

    //     }).fail(function(jqXHR, ajaxOptions, thrownError) {
    //         console.log(thrownError, ajaxOptions, jqXHR)
    //     });
    // });

    //    commission set

    $(document).on('click', '.commission_update', function (event) {
        // event.preventDefault();
        var inputs = $(this).closest("li").find("input");
        $(this).closest("li").find("input").each(function () {
            if ($(this).val()) {
                $(this).removeClass('border-danger');
            }

        });
        $.ajax({
            url: '/admin/commissions/update',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            // datatype : 'html',
            data: inputs,
        }).done(function (response) {
            console.log(response)
            sweetAlert('update', 'Commission Update Successfully.!');

        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log(thrownError, ajaxOptions, jqXHR)
        });
    });

});

//get keys list
function getKeys(page_id) {
    var datatable_length = $('#key_datatable_length').val()
    var search = $('#keySearch').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/keys?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var key_status;
        $('#recordsList').empty()
        $.each(response.data.data, function (index, value) {
            if (value.status) {
                key_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'key_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                key_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'key_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            $('#recordsList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>').append(value.name),
                    $('<td/>', {style: 'width:15%'}).append(key_status),
                    $('<td/>', {style: 'width:18%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm m-1',
                            href: 'keys/' + value.id + '/edit',
                            'title': 'Edit This Key'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-edit'})
                            )
                        ),
                        $('<form/>', {
                            action: 'keys/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This key'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            );
            id++
        })
        $('#paginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'Key-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'Key-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'Key-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'Key-pagination page-item '}).append(
                    $('<a/>', {href: '' + response.data.current_page + 1 + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'Key-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'Key-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }
        $('#paginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'keyPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//keys status


$(document).ready(function () {
    $(document).on('change', '.key_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var key_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'key/change/status',
            data: {
                'status': status,
                'key_id': key_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'key is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'key is enabled Successfully.!')
                }
            }
        });
    });
});


// get commission list

function getCommissions() {
    // var category_id = $('#category_id').val()
    // var subcategory_id = $('#subcategory_id').val()
    var category_id = ''
    var subcategory_id = ''
    var from_date = $('#from_date').val()
    var to_date = $('#to_date').val()

    $.ajax({
        url: 'commissions?category_id=' + category_id + '&subcategory_id=' + subcategory_id + '&from_date=' + from_date + '&to_date=' + to_date,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        console.log(response.data)
        var id = 1

        $('#CommissionList').empty()
        $.each(response.data, function (index, value) {
            // var image=window.location.href+'/admin/images/icons/childcategories/default.svg';
            //
            // if (value.child_category.image){
            //     image=response.mediaUrl+'/'+value.child_category.image;
            // }

            $('#CommissionList').append(
                $('<tr/>').append(
                    $('<td/>',).append(id),
                    $('<td/>',).append(value.child_category.subcategory.category.title),
                    $('<td/>',).append(value.child_category.subcategory.title),
                    // $('<td/>', { style: 'width:5%' }).append(
                    //     $('<img>',{src:image})
                    // ),
                    $('<td/>',).append(
                        value.child_category.title,
                    ),
                    $('<td/>',).append(value.storak_commission),
                    $('<td/>',).append(value.user_stores_commission),
                    $('<td/>',).append(new Date(value.created_at).toLocaleString()),
                )
            );
            id++
        })


    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}


//attributes
$(document).ready(function () {
    $(document).on('click', '.attribute-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getAttributes(page);
    });
    $('#attribute_datatable_length').change(function () {
        var page = $('ul#attributePagination').find('li.active a').attr('href');
        getAttributes(page)
    });
    // $('#attributeSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#attributePagination').find('li.active a').attr('href');
    //     getAttributes(page)
    //
    // });
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example
    var $input = $('#attributeSearch');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#attributePagination').find('li.active a').attr('href');
        getAttributes(page)
    }

    // $(document).on('click', '.attribute_status_change', function(event) {
    //     // event.preventDefault();
    //     console.log($(this))
    //     var attribute_id = $(this).attr('id');
    //     console.log('Attribute id is ' + attribute_id)
    //     $.ajax({
    //         url: 'attributes/status/changed/' + attribute_id,
    //         type: 'get',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //         },
    //         // datatype : 'html',
    //     }).done(function(response) {

    //     }).fail(function(jqXHR, ajaxOptions, thrownError) {
    //         console.log(thrownError, ajaxOptions, jqXHR)
    //     });
    // });

    //    commission
    $('#from_date').change(function () {
        getCommissions()
    });
    $('#to_date').change(function () {
        getCommissions()
    });

    //    Products status changed
    // $('.product_status_change').on('change', function(e) {
    //     var status = $(this).prop('checked') == true ? 1 : 0;
    //     var product_id = $(this).data('id');

    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: 'product/change/status',
    //         data: {
    //             'status': status,
    //             'product_id': product_id
    //         },
    //         success: function(data){
    //             console.log(data.status)
    //             if (data.status==0){
    //                 sweetAlert('update','Product is disabled Successfully.!')
    //             }else{
    //                 sweetAlert('update','Product is enabled Successfully.!')
    //             }
    //         }
    //     });
    // })
    // $('.product_feature_change').on('change', function(e) {
    //     var featured = $(this).prop('checked') == true ? 1 : 0;
    //     var product_id = $(this).data('id');

    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: 'product/change/status',
    //         data: {
    //             'featured': featured,
    //             'product_id': product_id,

    //         },
    //         success: function(data){
    //             console.log(data.status)
    //             if (data.status==0){
    //                 sweetAlert('update','Product removed from featured Successfully.!')
    //             }else{
    //                 sweetAlert('update','Product added to featured Successfully.!')
    //             }
    //         }
    //     });
    // })

});


//attributes
function getAttributes(page_id) {
    var datatable_length = $('#attribute_datatable_length').val()
    var search = $('#attributeSearch').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/attributes?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var attr_status;
        console.log(response);
        $('#attribList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                attr_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: '' + value.id + '',
                        'class': 'attribute_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),

                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                attr_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: '' + value.id + '',
                        'class': 'attribute_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            $('#attribList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>').append(value.title),
                    $('<td/>', {style: 'width:15%'}).append(attr_status),
                    $('<td/>', {style: 'width:18%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm m-1',
                            href: 'attributes/' + value.id + '/edit',
                            'title': 'Edit This Attribute'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-edit'})
                            )
                        ),
                        $('<form/>', {
                            action: 'attributes/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This Attribute'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            );
            id++
        })
        $('#paginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'attribute-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'attribute-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'attribute-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'attribute-pagination page-item '}).append(
                    $('<a/>', {href: '' + response.data.current_page + 1 + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'attribute-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'attribute-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#paginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'attributePagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()


    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()

        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

$(document).on('click', '.attribute_status_change', function (e) {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var attribute_id = $(this).data('id');

    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'attribute/change/status',
        data: {
            'status': status,
            'attribute_id': attribute_id
        },
        success: function (data) {
            console.log(data.status)
            if (data.status == 0) {
                sweetAlert('update', 'Attribute is disabled Successfully.!')
            } else {
                sweetAlert('update', 'Attribute is enabled Successfully.!')
            }
        }
    });
})

//brands


$(document).ready(function () {
    $(document).on('click', '.brand-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getBrands(page);
    });
    $('#brand_datatable_length').change(function () {
        var page = $('ul#brandPagination').find('li.active a').attr('href');
        getBrands(page)
    });
    // $('#brandSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#brandPagination').find('li.active a').attr('href');
    //     getBrands(page)
    //
    // });
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example
    var $input = $('#brandSearch');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#brandPagination').find('li.active a').attr('href');
        getBrands(page)
    }
});

function getBrands(page_id) {
    var datatable_length = $('#brand_datatable_length').val()
    var search = $('#brandSearch').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/brands?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var brand_status;
        console.log(response);
        $('#brandList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                brand_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'brand_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                brand_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'brand_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            if (value.featured) {
                brand_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'status-' + value.id + '',
                        'class': 'brand_feature_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // feature =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                brand_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'status-' + value.id + '',
                        'class': 'brand_feature_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // feature =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            var brand_image_url;
            if (value.logo_image) {
                var brand_image_url = response.image_url + value.logo_image;
            } else {
                brand_image_url = response.default_url;
            }
            console.log(response.default_url);

            $('#brandList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>').append($('<img>', {'class': 'w-24 rounded', 'src': brand_image_url})),
                    $('<td/>').append(value.name),
                    $('<td/>').append(brand_status),
                    $('<td/>').append(brand_feature),
                    $('<td/>', {style: 'width:18%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm m-1',
                            href: 'brands/' + value.id + '/edit',
                            'title': 'Edit This Brand'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-edit'})
                            )
                        ),
                        $('<form/>', {
                            action: 'brands/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This Brand'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            );
            id++
        })
        $('#paginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'brand-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'brand-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'brand-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'brand-pagination page-item '}).append(
                    $('<a/>', {href: '' + response.data.current_page + 1 + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'brand-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'brand-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#paginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'brandPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//brands feature/status


$(document).ready(function () {
    $(document).on('change', '.brand_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var brand_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'brand/change/status',
            data: {
                'status': status,
                'brand_id': brand_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Brand is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Brand is enabled Successfully.!')
                }
            }
        });
    })
    $(document).on('change', '.brand_feature_change', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var brand_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'brand/change/status',
            data: {
                'featured': featured,
                'brand_id': brand_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Brand removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Brand added to featured Successfully.!')
                }
            }
        });
    });
});


//childcategories pagination

$(document).ready(function () {
    $(document).on('click', '.child-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getChildCategories(page);
    });
    $('#child_datatable_length').change(function () {
        var page = $('ul#childPagination').find('li.active a').attr('href');
        getChildCategories(page)
    });
    // $('#childSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#childPagination').find('li.active a').attr('href');
    //     getChildCategories(page)
    //
    // });
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example
    var $input = $('#childSearch');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#childPagination').find('li.active a').attr('href');
        getChildCategories(page)
    }
});

function getChildCategories(page_id) {
    var datatable_length = $('#child_datatable_length').val()
    var search = $('#childSearch').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/childcategories?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var child_status;
        console.log(response);
        $('#childList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                child_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'child_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                child_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'child_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            //featured_cat
            if (value.featured) {
                child_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'featured-' + value.id + '',
                        'class': 'child_feature_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                child_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'featured-' + value.id + '',
                        'class': 'child_feature_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            //popular
            if (value.popular) {
                child_popular = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'popular',
                        id: 'popular-' + value.id + '',
                        'class': 'child_popular_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                child_popular = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'popular',
                        id: 'popular-' + value.id + '',
                        'class': 'child_popular_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            var child_image_url;
            if (value.image) {
                child_image_url = response.image_url + value.image;
            } else {
                child_image_url = response.default_url;
            }
          var main_category='N/A';
            var sub_category='N/A';
            if (value.category){
                main_category=value.category.title;
            }
            if (value.subcategory){
                sub_category=value.subcategory.title;
            }

            $('#childList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:10%'}).append($('<img>', {
                        'class': 'w-100 rounded',
                        'src': child_image_url
                    })),
                    $('<td/>', {style: 'width:10%'}).append(value.title + "<br>" + "<b>" + "Main Category: </b>" + main_category + "<br>" + "<b>" + "Sub Category: </b>" + sub_category ),
                    $('<td/>', {style: 'width:10%'}).append(child_status),
                    $('<td/>', {style: 'width:10%'}).append(child_feature),
                    $('<td/>', {style: 'width:10%'}).append(child_popular),
                    $('<td/>', {style: 'width:10%'}).append(value.products_count),
                    $('<td/>', {style: 'width:10%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm m-1',
                            href: 'childcategories/' + value.id + '/edit',
                            'title': 'Edit This Child Category'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-edit'})
                            )
                        ),
                        $('<form/>', {
                            action: 'childcategories/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This Child Category'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            );
            id++
        })
        $('#childPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'child-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'child-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'child-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'child-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'child-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'child-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#childPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'childPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()

        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//child status/feature/popularity

//status
$(document).ready(function () {
    $(document).on('change', '.child_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var child_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'child/change/status',
            data: {
                'status': status,
                'child_id': child_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Child Category is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Child Category is enabled Successfully.!')
                }
            }
        });
    })
    //feature
    $(document).on('change', '.child_feature_change', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var child_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'child/change/status',
            data: {
                'featured': featured,
                'child_id': child_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Child Category removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Child Category added to featured Successfully.!')
                }
            }
        });
    });
    //popular
    $(document).on('change', '.child_popular_change', function (e) {
        var popular = $(this).prop('checked') == true ? 1 : 0;
        var child_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'child/change/status',
            data: {
                'popular': popular,
                'child_id': child_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Child Category removed from popular Successfully.!')
                } else {
                    sweetAlert('update', 'Child Category added to popular Successfully.!')
                }
            }
        });
    });
});


//    subcategories pagination


$(document).ready(function () {
    $(document).on('click', '.subcategory-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getsubCategories(page);
    });
    $('#subcategory_datatable_length').change(function () {
        var page = $('ul#subcategoryPagination').find('li.active a').attr('href');
        getsubCategories(page)
    });
    // $('#subcategorySearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#subcategoryPagination').find('li.active a').attr('href');
    //     getsubCategories(page)
    //
    // });
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example
    var $input = $('#subcategorySearch');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#subcategoryPagination').find('li.active a').attr('href');
        getsubCategories(page)
    }
});

function getsubCategories(page_id) {
    var datatable_length = $('#subcategory_datatable_length').val()
    var search = $('#subcategorySearch').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/subcategories?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {


        var id = 1
        var subcategory_status;
        console.log(response);
        $('#subcategoryList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                subcategory_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'subcategory_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                subcategory_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'subcategory_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            //featured_cat
            if (value.featured) {
                subcategory_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'featured-' + value.id + '',
                        'class': 'subcategory_feature_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                subcategory_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'featured',
                        id: 'featured-' + value.id + '',
                        'class': 'subcategory_feature_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            //popular
            if (value.popular) {
                subcategory_popular = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'popular',
                        id: 'popular-' + value.id + '',
                        'class': 'subcategory_popular_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                subcategory_popular = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'popular',
                        id: 'popular-' + value.id + '',
                        'class': 'subcategory_popular_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }


            var sub_image_url;
            if (value.image) {
                var sub_image_url = response.image_url + value.image;
            } else {
                sub_image_url = response.default_url;
            }
            console.log(response.default_url);

            $('#subcategoryList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:10%'}).append($('<img>', {
                        'class': 'w-100 rounded',
                        'src': sub_image_url
                    })),
                    $('<td/>', {style: 'width:10%'}).append(value.title + "<br>" + "<b>" + "Main Category: </b>" + value.category.title),
                    $('<td/>', {style: 'width:10%'}).append(subcategory_status),
                    $('<td/>', {style: 'width:10%'}).append(subcategory_feature),
                    $('<td/>', {style: 'width:10%'}).append(subcategory_popular),
                    $('<td/>', {style: 'width:10%'}).append(value.products_count),
                    $('<td/>', {style: 'width:18%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm m-1',
                            href: 'subcategories/' + value.id + '/edit',
                            'title': 'Edit This Brand'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-edit'})
                            )
                        ),
                        $('<form/>', {
                            action: 'subcategories/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This Subcategory'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            );
            id++
        })
        $('#subcategoryPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'subcategory-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'subcategory-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'subcategory-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1
                link = $('<li/>', {'class': 'subcategory-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'subcategory-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'subcategory-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#subcategoryPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'subcategoryPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}


// products pagination


$(document).ready(function () {
    var typingTimer; //timer identifier
    var doneTypingInterval = 3000; //time in ms, 5 seconds for example


    //********************************************************  Start Product search actions ************************************************************

    $(document).on('click', '.product-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getProducts(page);
    });
    $(document).on('change', '.filters_products', function() {
        getProducts(1);
    })

    var $productSearch = $('#productSearch');

    //on keyup, start the countdown
    $productSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(productSearchlist, doneTypingInterval);
    });
    //on keydown, clear the countdown
    $productSearch.on('keydown', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(productSearchlist, doneTypingInterval);
    });
    function productSearchlist() {
        var page = $('ul#productPagination').find('li.active a').attr('href');
        getProducts(page)
    }
    //********************************************************  end Product search actions ************************************************************


    //********************************************************  Start Customer search actions ************************************************************

    $(document).on('click', '.customer-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getCustomers(page);
    });

    $(document).on('change', '.customer_filters', function() {
        getCustomers(1);
    })

    var $customerSearch = $('#customerSearch');

    //on keyup, start the countdown
    $customerSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(customerSearchlist, doneTypingInterval);
    });
    //on keydown, clear the countdown
    $customerSearch.on('keydown', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(customerSearchlist, doneTypingInterval);
    });
    function customerSearchlist() {
        var page = $('ul#customerPagination').find('li.active a').attr('href');
        getCustomers(page)
    }
    //********************************************************  end Customer search actions ************************************************************

     //********************************************************  Start wish list search actions ************************************************************

     $(document).on('click', '.wishlist-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getWishlistItems(page);
    });

    $(document).on('change', '.wishlist_filters', function() {
        getWishlistItems(1);
    })
    
    //********************************************************  end wish list search actions ************************************************************

     //********************************************************  Start Cart Item search actions ************************************************************

     $(document).on('click', '.cartItem-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getCartItems(page);
    });

    $(document).on('change', '.cartItem_filters', function() {
        getCartItems(1);
    })
    
    //********************************************************  end Cart Item list search actions ************************************************************

//************************************************************** start Stock Management **********************************************************************
    $(document).on('click', '.product-stock-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getProductStocks(page);
    });

    $(document).on('change', '.product_stock_filters', function() {
        getProductStocks(1);
    })

    var $productStockSearch = $('#productStockSearch');

    //on keyup, start the countdown
    $productStockSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getProductStocksList, doneTypingInterval);
    });
    //on keydown, clear the countdown
    $productStockSearch.on('keydown', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getProductStocksList, doneTypingInterval);
    });
    function getProductStocksList() {
        var page = $('ul#productStockPagination').find('li.active a').attr('href');
        getProductStocks(page)
    }
//************************************************************** end Stock Management **********************************************************************


});
//************************************************************* products  *******************************************************************************
function getProducts(page_id) {
    var datatable_length = $('#product_datatable_length').val()
    var search = $('#productSearch').val()
    var category_id = $('#category_id').val()
    var subcategory_id = $('#subcategory_id').val()
    var childcategory_id = $('#childcategory_id').val()
    var store_id = $('#store_id').val()
    var brand_id = $('#brand_id').val()
    var status = $('#status').val()
    var featured = $('#featured').val()
    var from_date = $('#from_date').val()
    var to_date = $('#to_date').val()
    var translation = $('#translation').val()
    $('.pre-loader').show()
    $.ajax({
        url: 'get/products?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+ '&category_id=' + category_id + '&subcategory_id=' + subcategory_id+ '&childcategory_id=' + childcategory_id+ '&store_id=' + store_id + '&brand_id=' + brand_id + '&status=' + status  + '&featured=' + featured + '&from_date=' + from_date+ '&to_date=' + to_date + '&translation=' + translation ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var product_status;
        console.log(response);
        $('#productList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                product_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'product_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                product_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'product_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            if (value.featured) {
                product_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'feature',
                        id: 'status-' + value.id + '',
                        'class': 'product_feature_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                product_feature = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'feature',
                        id: 'status-' + value.id + '',
                        'class': 'product_feature_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }
            if (value.translation_verified) {
                translation_verified = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'translation_verified',
                        id: 'status-' + value.id + '',
                        'class': 'translation_verified_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                translation_verified = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'translation_verified',
                        id: 'status-' + value.id + '',
                        'class': 'translation_verified_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            var product_image_url;
            if (value.primary_image) {
                var product_image_url = response.image_url + value.primary_image;
            } else {
                product_image_url = response.default_url;
            }
            console.log(response.default_url);

            $('#productList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>',{style: 'width:10%'}).append($('<img>', {'class': 'w-100 rounded', 'src': product_image_url})),
                    $('<td/>',{style: 'width:20%'}).append(
                        $('<b/>').append('Product: '), value.name, '<br>',
                        $('<b/>').append('Category: '), value.category.title, '<br>',
                        $('<b/>').append('Sub Category: '), value.subcategory.title, '<br>',
                        $('<b/>').append('Child Category: '), value.category.title, '<br>',
                        $('<b/>').append('Brand: '), value.brand.name, '<br>',
                        $('<b/>').append('Store: '), value.store.store_name, '<br>',
                    ),
                    $('<td/>',{style: 'width:5%'}).append(product_status),
                    $('<td/>',{style: 'width:5%'}).append(product_feature),
                    $('<td/>',{style: 'width:5%'}).append(translation_verified),
                    $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at).toLocaleString()),
                    $('<td/>',{style: 'width:10%'}).append(
                        // $('<button/>', {
                        //     'class': 'btn btn-primary btn-sm mb-1 w-100',
                        //     'data-toggle': 'modal',
                        //     'data-target': '#variantmodal' + value.id
                        // }).append(
                        //     'Variants pop'
                        // ),
                        $('<a/>', {
                            href: 'products/' + value.id + '/variants',
                            'class': 'btn btn-primary btn-sm mb-1 w-100',
                            'title': 'Go to All Variants of This Product Page',
                        }).append('Variants'),
                        $('<a/>', {
                            href: 'products/' + value.id + '/reviews',
                            'class': 'btn btn-warning btn-sm mb-1 w-100 text-white',
                            'title': 'Go to All Reviews of This Product Page',
                        }).append('Reviews'),

                        $('<a/>', {
                            href: 'products/' + value.id + '/questions',
                            'class': 'btn btn-info btn-sm mb-1 w-100 text-white',
                            'title': 'Go to All Questions of This Product Page',
                        }).append('Questions'),
                    ),

                    $('<td/>', {style: 'width:12%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm mr-1',
                            href: 'products/' + value.id,
                            'title': 'Edit This Product'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-eye'})
                            )
                        ),
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm mr-1',
                            href: 'product/' + value.id + '/editTranslation',
                            'title': 'Edit This Product'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-language'})
                            )
                        ),
                        $('<form/>', {
                            action: 'products/' + value.id + '',
                            method: 'POST',
                            'class': 'd-inline'
                        }).append(
                            $('<input/>', {
                                type: 'hidden',
                                name: '_token',
                                value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                            }), $('<input/>', {
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }),
                            $('<button/>', {
                                type: 'button',
                                'class': 'btn btn-danger btn-sm archive-btn',
                                title: 'Delete This Product'
                            }).append(
                                $('<span/>', {'class': 'btn-inner-icon'}).append(
                                    $('<i/>', {'class': 'fa fa-trash-o'})
                                )
                            )
                        ),
                    )
                )
            )
            id++
        })
        $('#productPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'product-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'product-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'product-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'product-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'product-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'product-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#productPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'productPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//************************************************************* start Stocks Managements****************************************************************

function getProductStocks(page_id) {
    var datatable_length = $('#product_stock_datatable_length').val()
    var search = $('#productStockSearch').val()
    var status = $('#status').val()
    var from_date = $('#from_date').val()
    var to_date = $('#to_date').val()
    $('.pre-loader').show()
    $.ajax({
        url: window.location.origin+'/admin/product/stocks/list?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+  '&status=' + status + '&from_date=' + from_date+ '&to_date=' + to_date ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {
        var id = 1
        var variant_availability;

        $('#productStockList').empty();
        $('#total_stock').empty();
        $('#sold_stock').empty();
        $('#in_stock_products').empty();
        $('#out_stock_products').empty();
        $('#total_stock').append(response.total_stock);
        $('#sold_stock').append(response.sold_stock);
        $('#in_stock_products').append(response.in_stock);
        $('#out_stock_products').append(response.out_stock);



        $.each(response.data.data, function (index, value) {

            if (value.availability) {
                variant_availability = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'product_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                variant_availability = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'product_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            var product_image_url;
            if (value.product.primary_image) {
                var product_image_url = response.image_url + value.product.primary_image;
            } else {
                product_image_url = response.default_url;
            }
            $('#productStockList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>',{style: 'width:10%'}).append($('<img>', {'class': 'w-100 rounded', 'src': product_image_url})),
                    $('<td/>',{style: 'width:20%'}).append(
                        $('<b/>').append('Product: '), value.product.name, '<br>',
                        $('<b/>').append('Category: '), value.product.category.title, '<br>',
                        $('<b/>').append('Sub Category: '), value.product.subcategory.title, '<br>',
                        $('<b/>').append('Child Category: '), value.product.category.title, '<br>',
                        $('<b/>').append('Brand: '), value.product.brand.name, '<br>',
                        $('<b/>').append('Store: '), value.product.store.store_name, '<br>',
                    ),
                    $('<td/>',{style: 'width:5%'}).append('N/A'),
                    $('<td/>',{style: 'width:5%'}).append(value.price),
                    $('<td/>',{style: 'width:5%'}).append(value.special_price),
                    $('<td/>',{style: 'width:5%'}).append(value.quantity),
                    $('<td/>',{style: 'width:5%'}).append(value.sold_stock),
                    $('<td/>',{style: 'width:10%'}).append( new Date(value.updated_at).toDateString()),
                    $('<td/>',{style: 'width:10%'}).append(variant_availability),
                    $('<td/>', {style: 'width:10%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm mr-1',
                            href: 'products/' + value.id,
                            'title': 'Edit This Product'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-eye'})
                            )
                        ),
                    )
                )
            )
            id++
        })
        $('#productStockPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'product-stock-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'product-stock-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'product-stock-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'product-stock-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'product-stock-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'product-stock-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#productStockPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'productStockPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//************************************************************* end Stocks Managements******************************************************************




// customers pagination

function getCustomers(page_id) {
    var datatable_length = $('#customer_datatable_length').val()
    var search = $('#customerSearch').val()
    var status = $('#status').val()
    var from_date = $('#customer_from_date').val()
    var to_date = $('#customer_to_date').val()
    $('.pre-loader').show()
    $.ajax({
        url: window.location.origin+'/admin/customer/profiles?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+'&status=' + status + '&from_date=' + from_date+ '&to_date=' + to_date ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {

        console.log(response);
        var id = 1
        var customer_status;
        $('#customerList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                customer_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'customer_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                customer_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'customer_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            $('#customerList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:5%'}).append(value.name),
                    $('<td/>', {style: 'width:5%'}).append(value.email),
                    $('<td/>', {style: 'width:5%'}).append(value.country_code+value.mobile),
                    $('<td/>', {style: 'width:5%'}).append(value.registered_with),
                    $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at).toLocaleString()),
                    $('<td/>',{style: 'width:5%'}).append(customer_status),
                    $('<td/>', {style: 'width:12%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm mr-1',
                            href: window.location.origin+'/admin/customer/profile/' + value.id,
                            'title': 'View this Customer'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-eye'})
                            )
                        ),
                        // $('<a/>', {
                        //     'class': 'btn btn-primary btn-sm mr-1',
                        //     href: 'product/' + value.id + '/editTranslation',
                        //     'title': 'Edit This Product'
                        // }).append(
                        //     $('<span/>', {'class': 'btn-inner--icon'}).append(
                        //         $('<i/>', {'class': 'fa fa-language'})
                        //     )
                        // ),
                        // $('<form/>', {
                        //     action: 'products/' + value.id + '',
                        //     method: 'POST',
                        //     'class': 'd-inline'
                        // }).append(
                        //     $('<input/>', {
                        //         type: 'hidden',
                        //         name: '_token',
                        //         value: '' + $('meta[name="csrf-token"]').attr('content') + ''
                        //     }), $('<input/>', {
                        //         type: 'hidden',
                        //         name: '_method',
                        //         value: 'DELETE'
                        //     }),
                        //     $('<button/>', {
                        //         type: 'button',
                        //         'class': 'btn btn-danger btn-sm archive-btn',
                        //         title: 'Delete This Product'
                        //     }).append(
                        //         $('<span/>', {'class': 'btn-inner-icon'}).append(
                        //             $('<i/>', {'class': 'fa fa-trash-o'})
                        //         )
                        //     )
                        // ),
                    )
                )
            )
            id++
        })
        $('#customerPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'customer-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'customer-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'customer-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'customer-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'customer-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'customer-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#customerPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'customerPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//********************************************************  Wish List Pagination  *********************************************************************

function getWishlistItems(page_id) {
    var datatable_length = $('#wishlist_datatable_length').val()
    var from_date = $('#wishList_from_date').val()
    var to_date = $('#wishList_to_date').val()
    // console.log('from date ======> ' +from_date);
    $('.pre-loader').show()
    $.ajax({
        url: window.location.origin+'/admin/customer/wishlist?page_id=' + page_id + '&datatable_length=' + datatable_length  + '&from_date=' + from_date+ '&to_date=' + to_date ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {

        console.log(response);
        var id = 1
        $('#customerwishList').empty()
        $.each(response.data.data, function (index, value) {
            if (value.product_detail) {
                primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + value.product_detail.primary_image + '"\n' +
                    'alt="product image" class=" rounded w-50" >'
            } else {
                primary_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                    'class=" rounded img-bdr-primary"> '
            }
            $('#customerwishList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:10%'}).append(
                        $('<a/>', {
                            href : 'https://storak.qa/product-detail/' + value.product_detail.slug,
                            target : '_blank'
                        }).append(
                            primary_image 
                        ),
                    ),
                    $('<td/>', {style: 'width:5%'}).append(value.product_detail.name),
                    $('<td/>', {style: 'width:5%'}).append(value.user_detail.name + "<br>" + value.user_detail.email + "<br>" + value.user_detail.mobile ),
                    $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at).toLocaleString() ),
                )
            )
            id++
        })
        $('#wishListPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'wishlist-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'wishlist-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'wishlist-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'wishlist-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'wishlist-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'wishlist-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#wishListPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'wishlistPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}

//********************************************************  Wishlist Pagination End *********************************************************************

//********************************************************  Cart Items List Pagination  *********************************************************************

    
function getCartItems(page_id) {
    var datatable_length = $('#cartItems_datatable_length').val()
    var from_date = $('#cartItem_from_date').val()
    var to_date = $('#cartItem_to_date').val()
    // console.log('from date ======> ' +from_date);
    $('.pre-loader').show()
    $.ajax({
        url: window.location.origin+'/admin/customer/cartItems?page_id=' + page_id + '&datatable_length=' + datatable_length  + '&from_date=' + from_date+ '&to_date=' + to_date ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {

        console.log(response);
        var id = 1
        $('#cartItemList').empty()
        $.each(response.data.data, function (index, value) {
            if (value.product_detail) {
                primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + value.product_detail.primary_image + '"\n' +
                    'alt="product image" class=" rounded w-50" >'
            } else {
                primary_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                    'class=" rounded img-bdr-primary"> '
            }
            $('#cartItemList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:10%'}).append(
                        $('<a/>', {
                            href : 'https://storak.qa/product-detail/' + value.product_detail.slug,
                            target : '_blank'
                        }).append(
                            primary_image 
                        ),
                    ),
                    $('<td/>', {style: 'width:5%'}).append(value.product_detail.name),
                    $('<td/>', {style: 'width:5%'}).append(value.user_detail.name + "<br>" + value.user_detail.email + "<br>" + value.user_detail.mobile ),
                    $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at).toLocaleString() ),
                )
            )
            id++
        })
        $('#cartItemPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'cartItem-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'cartItem-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'cartItem-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'cartItem-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'cartItem-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'cartItem-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#cartItemPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'cartItemPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}


//********************************************************  Cart Items List Pagination  End *********************************************************************


 //********************************************************  Vedndors Pagination  *********************************************************************

function getVendors(page_id) {
    var datatable_length = $('#vendor_datatable_length').val()
    var search = $('#vendorSearch').val()
    var status = $('#status').val()
    var from_date = $('#from_date').val()
    var to_date = $('#to_date').val()
    var profile_status = $('#profile_status').val()
    $('.pre-loader').show()
    $.ajax({
        url: window.location.origin+'/admin/vendor/profiles?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+'&status=' + status + '&from_date=' + from_date + '&to_date=' + to_date + '&profile_status=' + profile_status ,
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        // datatype : 'html',
    }).done(function (response) {

        console.log(response);
        var id = 1
        var customer_status;
        $('#vendorList').empty()
        $.each(response.data.data, function (index, value) {

            if (value.status) {
                customer_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'vendor_status_change',
                        'checked': 'checked',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
            } else {
                vendor_status = $('<label/>', {'class': 'toggle-switch'}).append(
                    $('<input/>', {
                        type: 'checkbox',
                        name: 'status',
                        id: 'status-' + value.id + '',
                        'class': 'vendor_status_change',
                        'data-id': value.id
                    }),
                    $('<span/>', {'class': 'toggle-switch-slider'})
                )
                // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
            }

            $('#vendorList').append(
                $('<tr/>').append(
                    $('<td/>', {style: 'width:5%'}).append(id),
                    $('<td/>', {style: 'width:5%'}).append(value.name),
                    $('<td/>', {style: 'width:5%'}).append(value.email),
                    $('<td/>', {style: 'width:5%'}).append(value.country_code+value.mobile),
                    $('<td/>', {style: 'width:5%'}).append(value.registered_with),
                    $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at).toLocaleString()),
                    $('<td/>',{style: 'width:5%'}).append(customer_status),
                    $('<td/>', {style: 'width:12%'}).append(
                        $('<a/>', {
                            'class': 'btn btn-primary btn-sm mr-1',
                            href: window.location.origin+'/admin/vendor/profile/' + value.id,
                            'title': 'View this Customer'
                        }).append(
                            $('<span/>', {'class': 'btn-inner--icon'}).append(
                                $('<i/>', {'class': 'fa fa-eye'})
                            )
                        ),
                    )
                )
            )
            id++
        })
        $('#vendorPaginationList').empty()
        var links = [];
        var link
        $.each(response.data.links, function (index, value) {
            if (value.url == null && value.label == '&laquo; Previous') {
                link = $('<li/>', {'class': 'vendor-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url != null && value.label == '&laquo; Previous') {
                var previous = response.data.current_page - 1
                link = $('<li/>', {'class': 'vendor-pagination page-item '}).append(
                    $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                )
            }
            if (value.url == null && value.label == 'Next &raquo;') {
                link = $('<li/>', {'class': 'vendor-pagination page-item disabled'}).append(
                    $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.url != null && value.label == 'Next &raquo;') {
                var next = response.data.current_page + 1;
                link = $('<li/>', {'class': 'vendor-pagination page-item '}).append(
                    $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                )
            }
            if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                if (value.active) {
                    link = $('<li/>', {'class': 'vendor-pagination page-item active'}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                } else {
                    link = $('<li/>', {'class': 'vendor-pagination page-item '}).append(
                        $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                    )
                }
            }
            links.push(link);
        })

        var from = 0;
        var to = 0;
        if (response.data.from) {
            from = response.data.from;
        }
        if (response.data.to) {
            to = response.data.to
        }

        $('#vendorPaginationList').append(
            $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                $('<div/>', {'class': 'dataTables_info'}).append(
                    'Showing ' + from + ' to ' + to + ' of ' + response.data.total + ' entries ',
                )
            ),
            $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                    $('<ul/>', {'class': 'pagination', id: 'vendorPagination'}).append(
                        links
                    )
                )
            ),
        )
        $('.pre-loader').hide()

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        $('.pre-loader').hide()
        console.log(thrownError, ajaxOptions, jqXHR)
    });
}


//products status/feature
$(document).ready(function () {
    $(document).on('change', '.product_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var product_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/product/change/status',
            data: {
                'status': status,
                'product_id': product_id
            },
            success: function (data) {
                console.log('product status ===>' + data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Product is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Product is enabled Successfully.!')
                }
            }
        });
    })
    // product feature
    $(document).on('change', '.product_feature_change', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var product_id = $(this).data('id');
        console.log(window.location.origin)

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/product/change/status',
            data: {
                'featured': featured,
                'product_id': product_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Product removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Product added to featured Successfully.!')
                }
            }
        });
    });
    // product translation enable/disable
    $(document).on('change', '.translation_verified_change', function (e) {
        var translation = $(this).prop('checked') == true ? 1 : 0;
        var product_id = $(this).data('id');
        console.log(window.location.origin)

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/product/change/status',
            data: {
                'translation': translation,
                'product_id': product_id,
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Product Translation Disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Product Translation Enabled Successfully.!')
                }
            }
        });
    });

//    customer status change
    $(document).on('change', '.customer_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/customer/status',
            data: {
                'status': status,
                'user_id': user_id
            },
            success: function (data) {
                if (data.status == 0) {
                    sweetAlert('update', 'Customer is in-active Successfully.!')
                } else {
                    sweetAlert('update', 'Customer is active Successfully.!')
                }
            }
        });
    })

});

//category status/feature/popular

$(document).ready(function () {
    $(document).on('change', '.category_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var category_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'category/change/status',
            data: {
                'status': status,
                'category_id': category_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Category is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Category is enabled Successfully.!')
                }
            }
        });
    })
    //feature
    $(document).on('change', '.category_feature_change', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var category_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'category/change/status',
            data: {
                'featured': featured,
                'category_id': category_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Category removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Category added to featured Successfully.!')
                }
            }
        });
    });
    //popular
    $(document).on('change', '.category_popular_change', function (e) {
        var popular = $(this).prop('checked') == true ? 1 : 0;
        var category_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'category/change/status',
            data: {
                'popular': popular,
                'category_id': category_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Category removed from popular Successfully.!')
                } else {
                    sweetAlert('update', 'Category added to popular Successfully.!')
                }
            }
        });
    });
});

//subcategory status/feature/popular

//category status/feature/popular

$(document).ready(function () {
    $(document).on('change', '.subcategory_status_change', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var subcategory_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'subcategory/change/status',
            data: {
                'status': status,
                'subcategory_id': subcategory_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Subcategory is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Subcategory is enabled Successfully.!')
                }
            }
        });
    })
    //feature
    $(document).on('change', '.subcategory_feature_change', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var subcategory_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'subcategory/change/status',
            data: {
                'featured': featured,
                'subcategory_id': subcategory_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Subcategory removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Subcategory added to featured Successfully.!')
                }
            }
        });
    });
    //popular
    $(document).on('change', '.subcategory_popular_change', function (e) {
        var popular = $(this).prop('checked') == true ? 1 : 0;
        var subcategory_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'subcategory/change/status',
            data: {
                'popular': popular,
                'subcategory_id': subcategory_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', ' Subcategory removed from popular Successfully.!')
                } else {
                    sweetAlert('update', 'Subcategory added to popular Successfully.!')
                }
            }
        });
    });
});


//    vendor store feature/status
$(document).ready(function () {
    $(document).on('change', '.vendor_store_status', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var vendor_store_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/vendor/store/status',
            data: {
                'status': status,
                'vendor_store_id': vendor_store_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Vendor store is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Vendor store is enabled Successfully.!')
                }
            }
        });
    })
    $(document).on('change', '.vendor_store_feature', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var vendor_store_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/vendor/store/status',
            data: {
                'featured': featured,
                'vendor_store_id': vendor_store_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Vendor store removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Vendor store added to featured Successfully.!')
                }
            }
        });
    });
});

//    customer store status/feature

$(document).ready(function () {
    $(document).on('change', '.customer_store_status', function (e) {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var customer_store_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/customer/store/status',
            data: {
                'status': status,
                'customer_store_id': customer_store_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Customer store is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Customer store is enabled Successfully.!')
                }
            }
        });
    })
    $(document).on('change', '.customer_store_feature', function (e) {
        var featured = $(this).prop('checked') == true ? 1 : 0;
        var customer_store_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/customer/store/status',
            data: {
                'featured': featured,
                'customer_store_id': customer_store_id,

            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Customer store removed from featured Successfully.!')
                } else {
                    sweetAlert('update', 'Customer store added to featured Successfully.!')
                }
            }
        });
    });
});

//collections visibility

$(document).ready(function () {
    $(document).on('change', '.collection_visibility_change', function (e) {
        var visibility = $(this).prop('checked') == true ? 1 : 0;
        var collection_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: window.location.origin + '/admin/collection/visibility',
            data: {
                'visibility': visibility,
                'collection_id': collection_id
            },
            success: function (data) {
                console.log(data.status)
                if (data.status == 0) {
                    sweetAlert('update', 'Visibility is disabled Successfully.!')
                } else {
                    sweetAlert('update', 'Visibility is enabled Successfully.!')
                }
            }
        });
    });
});
