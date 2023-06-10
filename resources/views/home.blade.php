
@extends('layouts.app',['title'=>'Home'])

@section('content')

            <div class="row">
                <div class="col-xl-9 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">


                                <div class="col-xl-12">
                                    <div class="row  mt-xl-0 mt-4">
                                        <div class="col-md-12">
                                            <h4 class="card-title">User Management system</h4>
                                            <span>Welcome to the User Management system (UMS)</span>
                                            <ul class="card-list mt-4">
                                                <li><span class="bg-blue circle"></span>Users<span>{{\App\Models\User::count()}}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


@stop
