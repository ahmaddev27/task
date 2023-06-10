@extends('layouts.app',['title'=>'Edit user'])

@section('content')
    @push('css')
        <style>
            .error{
             color: red;
            }
        </style>
    @endpush


    @if ($errors->any())


        <div class="alert alert-danger alert-dismissible fade show">

            @foreach ($errors->all() as $error)
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Error! </strong> {{$error}}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>

    @endif

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Create New User</a></li>
        </ol>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add User</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form id="form" method="post" action="{{route('user.update',$user->id)}}">
                       @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" value="{{$user->name}}" class="form-control"  id="name" name="name" placeholder="Name">
                            </div>
                            <div class="col-sm-6 mt-2 mt-sm-0">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  value="{{$user->job}}" name="job"id="job" placeholder="job">
                            </div>

                            <div class="col-sm-6 mt-2 mt-sm-0">
                                <input type="email" class="form-control"  value="{{$user->email}}"name="email" id="email" placeholder="Email">
                            </div>



                        </div>


                        <div class="row mt-3 justify-content-end">
                            <div class="col-sm-2 ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{asset('/vendor/jquery-validation/jquery.validate.min.js')}}"></script>


        <script>
            $(function(){
                $("#form").validate({
                    rules: {
                        name:{required: true,},
                        job:{required: true,},
                        email:{required: true,},
                        // password:{required: true,}
                    },

                });
            })
        </script>



    @endpush
@stop
