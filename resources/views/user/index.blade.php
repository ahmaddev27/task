@extends('layouts.app',['title'=>'Users list'])

@section('content')
    @push('css')
        <link href="{{asset('/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{asset('/vendor/toastr/css/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>

    @endpush
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users List</a></li>
        </ol>
    </div>



    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Users List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="width: 845px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Job</th>
                            <th>QR</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @push('js')
            <script src="{{asset('/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>


            <script src="{{asset('/vendor/toastr/js/toastr.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('/vendor/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>


            <script>
                @if(Session::has('message'))
                var type="{{Session::get('alert-type','info')}}"

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-left",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                switch(type) {
                    case'info':
                        toastr.info("{{Session::get('message')}}");
                        break;
                    case'success':
                        toastr.success("{{Session::get('message')}}");
                        break;
                    case'warning':
                        toastr.warning("{{Session::get('message')}}");
                        break;
                    case'error':
                        toastr.error("{{Session::get('message')}}");
                        break;
                }
                @endif
            </script>

            <script type="text/javascript">
                $(function () {
                    var table = $('#example').DataTable({

                        'processing': true,
                        'serverSide': true,
                        pagingType: 'simple',
                        searching: true,

                        ajax: "{{ route('user.list') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'id',"className": "text-center",},
                            {data: 'name', name: 'name',"className": "text-center",},
                            {data: 'email', name: 'email',"className": "text-center",},
                            {data: 'job', name: 'job',"className": "text-center",},
                            {data: 'qr', name: 'qr',"className": "text-center",},
                            {data: 'status', name: 'status',"className": "text-center",},
                            {data: 'action', name: 'action', orderable: false, searchable: false,"className": "text-center",},
                        ]
                    });

                });
            </script>





            {{-- delete--}}
            <script>

                $(document).on("click",'#delete',function (e){
                    e.preventDefault();
                    var model_id = $(this).attr('model_id');
                    var route = $(this).attr('route');

                    swal({
                        title: 'Are you sure ?',
                        text: "You won't be able to get it back!",
                        type: 'warning',
                        confirmButtonText: 'Delete',
                        confirmButtonColor: '#f4516c',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        cancelButtonColor: '#343a40',
                    }).then(function(result){
                        if (result.value) {

                            $.ajax({

                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': model_id,
                                },
                                url: route,
                                type: "json",
                                method: "post",


                                success: function (data) {
                                    swal(
                                        'Deleted !',
                                        data.message,
                                        'success'
                                    )

                                    $('#example').DataTable().ajax.reload();

                                },
                            })

                        } else if (result.dismiss === 'cancel') {
                            swal(
                                'Canceled',
                                'Not deleted ',
                                'error',
                            )
                        }
                    });
                });

            </script>





            {{-- status--}}
            <script>

                $(document).on("click",'#status',function (e){
                    e.preventDefault();
                    var model_id = $(this).attr('model_id');
                    var route = $(this).attr('route');
                    var status = $(this).attr('status');

                    swal({
                        title: 'Are you sure ?',
                        text: "You need to change user status!",
                        type: 'warning',
                        confirmButtonText: 'Change',
                        confirmButtonColor: '#f4516c',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        cancelButtonColor: '#343a40',
                    }).then(function(result){
                        if (result.value) {

                            $.ajax({

                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': model_id,
                                    'status': status,
                                },
                                url: route,
                                type: "json",
                                method: "post",


                                success: function (data) {
                                    swal(
                                        'Changed !',
                                        data.message,
                                        'success'
                                    )

                                    $('#example').DataTable().ajax.reload();

                                },
                            })

                        } else if (result.dismiss === 'cancel') {
                            swal(
                                'Canceled',
                                'Not Changed ',
                                'error',
                            )
                        }
                    });
                });

            </script>




    @endpush
@stop
