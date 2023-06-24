

            @php $count = 1; @endphp
            @foreach ($response->data as $key)
                <tr>
                    <td width="5%">{{ $count }}</td>
                    <td>{{ $key->name }}</td>
                    <td width="15%">
                        @if ($key->status)
                            <span class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active</span>
                        @else
                            <span class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive</span>
                        @endif
                    </td>
                    <td width="18%">
                        <a href="{{ URL::to("admin/keys/$key->id/edit") }}" title="Edit This Key" class="btn btn-primary"><span class="btn-inner--icon"><i class="fa fa-edit"></i></span></a>
                        <form action="{{ URL::to('admin/keys/' . $key->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="button" class="btn btn-danger archive-btn" title="Delete This key"><span class="btn-inner-icon"><i class="fa fa-trash-o"></i></span></button></form>
                    </td>
                    @php $count++; @endphp
                </tr>
            @endforeach




<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status">Showing {{$response->from}} to {{$response->to}} of {{$response->total}} entries
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                @foreach($response->links as $links)
                    @if($links->url ==null && $links->label=='&laquo; Previous')
                        <li class="pagination page-item disabled"><a href="" class="page-link">Previous</a></li>
                    @endif
                    @if($links->url !=null && $links->label=='&laquo; Previous')
                        <li class="pagination page-item"><a
                                href="{{$response->current_page - 1}}"
                                class="page-link">Previous</a></li>
                    @endif
                    @if($links->url ==null && $links->label=='Next &raquo;')
                        <li class="pagination page-item disabled"><a
                                href=""
                                class="page-link">Next</a></li>
                    @endif
                    @if($links->url !=null && $links->label=='Next &raquo;')
                        <li class="pagination page-item"><a
                                href="{{$response->current_page + 1}}"
                                class="page-link">Next</a></li>
                    @endif
                    @if($links->label !=='&laquo; Previous' && $links->label !=='Next &raquo;')
                        <li class="pagination page-item @if($links->active) active @endif"><a
                                href="{{$links->label}}"
                                class="page-link">{{$links->label}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
