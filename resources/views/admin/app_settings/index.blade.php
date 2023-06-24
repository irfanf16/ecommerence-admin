@extends('admin.layouts.master', ['navItem' => 'settings'])
@section('title', 'All App Settings ')

@section('content')

    <div class="container-fluid">
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>App Settings</strong></h2>
                    </div>
                    <div class="body pt-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="DataTables_Table_0"
                                           class="table table-hover  no-footer" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                        <tr role="row">
                                            <th>Id</th>
                                            <th>Short Code</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            @can('admin-appsetting-edit')
                                            <th>Actions</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody >
                                          @foreach ($appsettings as $setting)
                                          <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{ $setting->shortcode }}
                                            </td>
                                            <td>
                                                {{ $setting->description }}
                                            </td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input data-id="{{$setting->id}}" type="checkbox" class="float-right toggle-class setting-status" name="value2" id="status-{{ $setting->id }}"
                                                      @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-appsetting-edit')) disabled @endif     {{ $setting->value2 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Setting"></span>
                                                </label>
                                            </td>
                                              @can('admin-appsetting-edit')

                                              <td width="18%">
                                                <a href="{{ route('app.setting.edit', $setting->id) }}"
                                                    title="Edit This Category" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form id="archive-{{ $setting->id }}"
                                                    action="{{ route('app.settings.destroy', $setting->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger archive-btn"
                                                        title="Archive This Category">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                              @endcan
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
            });
        </script>
    @endif


    <script>
        $(document).ready(function () {



            $('body').on('click', '.archive-btn', function () {
                // alert("hit");
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This File will be moved to Archive",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Key has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Key is Safe!");
                        }
                    });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
    $(document).on('change', '.setting-status', function(e) {
        var value2 = $(this).prop('checked') == true ? 1 : 0;
        var setting_id = $(this).data('id');
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: window.location.origin + '/admin/app/settings/status/' + setting_id,
            data: {
                'value2': value2,
                'setting_id': setting_id,
                '_token' : token
            },
            success: function(data){
                console.log(data.status)
                if (data.status==0){
                    sweetAlert('update','Setting is disabled Successfully.!')
                }else{
                    sweetAlert('update','Setting is enabled Successfully.!')
                }
            }
        });
    });
});
    </script>
@endsection
