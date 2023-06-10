@extends('layouts.app',['title'=>'Profile'])


@section('content')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{$user->name}}</a></li>
        </ol>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{asset('/images/avatar/1.png')}}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{$user->name}}</h4>
                                    <p>{{$user->job}}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{$user->email}}</h4>
                                    <p>Email</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-statistics">
                                    <div class="text-center">
                                        <div class="row">

                                            <div class="col">


                                                        @php
                                                            $profileUrl = route('user.view',$user->id);
                                                            $qrCode = SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->generate($profileUrl);
                                                        @endphp
                                                        {{$qrCode}}


                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

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
