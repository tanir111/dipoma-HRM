<header class="navbar navbar-fixed-top bg-system">
    <div class="navbar-logo-wrapper bg-system">
        <a class="navbar-logo-text" href="welcome">
        </a>

        <span id="sidebar_left_toggle" class="ad ad-lines"></span>
    </div>
    <ul class="nav navbar-nav navbar-left">
        <li class="hidden-xs">
            <a class="navbar-fullscreen toggle-active" href="#">
                <span class="glyphicon glyphicon-fullscreen"></span>
            </a>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

        <li class="dropdown dropdown-fuse">
            <div class="navbar-btn btn-group">



        <li class="dropdown dropdown-fuse">
            <div class="navbar-btn btn-group">
        <li class="dropdown dropdown-fuse">
            <a href="#" class="dropdown-toggle fw600" data-toggle="dropdown">
                <span class="hidden-xs"><name>{{\Auth::user()->name}}</name> </span>
                <span class="fa fa-caret-down hidden-xs mr15"></span>
                @if(Auth::user()->employee->photo == "")
                    <img src="/assets/img/avatars/profile_pic.png" alt="avatar" class="mw55">
                @else
                    <img src="{{asset(Auth::user()->employee->photo)}}" width="50px" height="50px"
                         alt="avatar" class="mw55">

                @endif
            </a>
            <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                @if(\Route::getFacadeRoot()->current()->uri() != 'change-password')
                    <li class="dropdown-footer text-center">
                        <a href="/change-password" class="btn btn-primary btn-sm btn-bordered">
                            <span class="fa fa-lock pr5"></span>{{trans('messages.change_password')}}</a>
                    </li>
                @endif
                <li class="dropdown-footer text-center">
                    <a href="/logout" class="btn btn-primary btn-sm btn-bordered">
                        <span class="fa fa-power-off pr5"></span>{{trans('messages.logout')}} </a>
                </li>
            </ul>
        </li>

        <li>
            <a style="text-color:white;" href="{{URL::route('setlangrus')}}">
                РУС</a>
        </li>
        <li style=" border-left: 1px solid white">
            <a style="text-color:white;" href="{{URL::route('setlangeng')}}">
                ENG</a>
        </li>
    </ul>
</header>