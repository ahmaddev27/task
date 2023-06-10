<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="{{asset('/images/avatar/1.png')}}" width="20" alt="">
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi,<b>{{auth()->user()->name}}</b></span>
                        <small class="text-end font-w400">{{auth()->user()->email}}</small>
                    </div>
                </a>

            </li>
            <li><a class="{{request()->routeIs('home*') ? '--active' : '' }}" href="{{route('home')}}" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>


            </li>





            <li><a class="has-arrow ai-icon {{request()->routeIs('user*') ? '--active' : '' }}" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-043-menu"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('user.create')}}">Add user</a></li>
                    <li><a href="{{route('user.index')}}">All users</a></li>
                </ul>
            </li>



        </ul>

    </div>
</div>
