<!-- -------------- Sidebar - Author -------------- -->
<div class="sidebar-widget author-widget">
    <div class="media">
        <a href="/profile" class="media-left">
            @if(Auth::user()->employee->photo == '')
                <img src="../assets/img/avatars/profile_pic.png" class="img-responsive">
            @else
                <img src="{{asset(Auth::user()->employee->photo)}}" width="40px" height="30px" class="img-responsive">
            @endif
        </a>

        <div class="media-body">
            <div class="media-author"><a href="/profile">{{Auth::user()->name}}</a></div>
        </div>
    </div>
</div>

<!-- -------------- Sidebar Menu  -------------- -->
<ul class="nav sidebar-menu scrollable">
    <li class="active">
        <a  href="{{route('dashboard')}}">
            <span class="fa fa-dashboard"></span>
            <span class="sidebar-title">{{trans('messages.dashboard')}}</span>
        </a>
    </li>
    @if(Auth::user()->isHR())
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">{{trans('messages.employee')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-employee')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.add_employee')}}</a>
                </li>
                <li>
                    <a href="{{route('employee-manager')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.employee_listing')}}</a>
                </li>
                {{--<li>--}}
                    {{--<a href="{{route('upload-emp')}}">--}}
                        {{--<span class="glyphicon glyphicon-tags"></span> Upload </a>--}}
                {{--</li>--}}
            </ul>
        </li>

        @if(\Auth::user()->isAdmin || \Auth::user()->isHR() || \Auth::user()->isManager())
            <li>
                <a class="accordion-toggle" href="/dashboard">
                    <span class="fa fa-user"></span>
                    <span class="sidebar-title">{{trans('messages.clients')}}</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li>
                        <a href="{{route('add-client')}}">
                            <span class="glyphicon glyphicon-tags"></span>{{trans('messages.add_client')}}</a>
                    </li>

                    <li>
                        <a href="{{route('list-client')}}">
                            <span class="glyphicon glyphicon-tags"></span>{{trans('messages.client_list')}}</a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-user"></span>
                <span class="sidebar-title">{{trans('messages.projects')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-project')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.add_project')}}</a>
                </li>

                <li>
                    <a href="{{route('list-project')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.project_list')}}</a>
                </li>

                <li>
                    <a href="{{route('assign-project')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.assign_project')}}</a>
                </li>

                <li>
                    <a href="{{route('project-assignment-listing')}}">
                        <span class="glyphicon glyphicon-tags"></span>{{trans('messages.assignment_project_list')}}</a>
                </li>
            </ul>
        </li>

        <li>

            <a href="/bank-account-details">
                <span class="fa fa-bank"></span>
                <span class="sidebar-title">{{trans('messages.bank_account')}}</span>

            </a>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-group"></span>
                <span class="sidebar-title">{{trans('messages.teams')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-team')}}">
                        <span class="glyphicon glyphicon-book"></span>{{trans('messages.add_team')}}</a>
                </li>
                <li>
                    <a href="{{route('team-listing')}}">
                        <span class="glyphicon glyphicon-modal-window"></span>{{trans('messages.team_listing')}}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-graduation-cap"></span>
                <span class="sidebar-title">{{trans('messages.roles')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-role')}}">
                        <span class="glyphicon glyphicon-book"></span>{{trans('messages.add_role')}}</a>
                </li>
                <li>
                    <a href="{{route('role-list')}}">
                        <span class="glyphicon glyphicon-modal-window"></span>{{trans('messages.role_listing')}}</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa fa-laptop"></span>
                <span class="sidebar-title">{{trans('messages.assets')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="{{route('add-asset')}}">
                        <span class="glyphicon glyphicon-shopping-cart"></span>{{trans('messages.add_asset')}}</a>
                </li>
                <li>
                    <a href="{{route('asset-listing')}}">
                        <span class="glyphicon glyphicon-calendar"></span>{{trans('messages.asset_listing')}}</a>
                </li>
                <li>
                    <a href="{{route('assign-asset')}}">
                        <span class="fa fa-desktop"></span>{{trans('messages.assign_asset')}}</a>
                </li>
                <li>
                    <a href="{{route('assignment-listing')}}">
                        <span class="fa fa-clipboard"></span>{{trans('messages.assign_asset_listing')}}</a>
                </li>
            </ul>
        </li>
    @endif
    <li>
        <a class="accordion-toggle" href="/dashboard">
            <span class="fa fa-envelope"></span>
            <span class="sidebar-title">{{trans('messages.leaves')}}</span>
            <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
            <li>
                <a href="{{route('apply-leave')}}">
                    <span class="glyphicon glyphicon-shopping-cart"></span>{{trans('messages.apply_leave')}}</a>
            </li>
            <li>
                <a href="{{route('my-leave-list')}}">
                    <span class="glyphicon glyphicon-calendar"></span>{{trans('messages.my_leave_list')}}</a>
            </li>

            @if(\Auth::user()->isHR())
                <li>
                    <a href="{{route('add-leave-type')}}">
                        <span class="fa fa-desktop"></span>{{trans('messages.add_leave_type')}}</a>
                </li>
                <li>
                    <a href="{{route('leave-type-listing')}}">
                        <span class="fa fa-clipboard"></span>{{trans('messages.leave_type_listing')}}</a>
                </li>
            @endif
            @if(Auth::user()->isHR() || Auth::user()->isCoordinator())
                <li>
                    <a href="{{route('total-leave-list')}}">
                        <span class="fa fa-clipboard"></span>{{trans('messages.total_leave_listing')}}</a>
                </li>
            @endif
        </ul>
    </li>

    @if(Auth::user()->isHR())
        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa-arrow-circle-o-up"></span>
                <span class="sidebar-title">{{trans('messages.promotions')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="/promotion">
                        <span class="glyphicon glyphicon-book"></span> {{trans('messages.promote')}}</a>
                </li>
                <li>
                    <a href="/show-promotion">
                        <span class="glyphicon glyphicon-modal-window"></span>{{trans('messages.promotion_listing')}}</a>
                </li>
            </ul>
        </li>

{{--        <li>--}}
{{--            <a class="accordion-toggle" href="/dashboard">--}}
{{--                <span class="fa fa-money"></span>--}}
{{--                <span class="sidebar-title">Expenses</span>--}}
{{--                <span class="caret"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav sub-nav">--}}
{{--                <li>--}}
{{--                    <a href="{{route('add-expense')}}">--}}
{{--                        <span class="glyphicon glyphicon-book"></span> Add Expense </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{route('expense-list')}}">--}}
{{--                        <span class="glyphicon glyphicon-modal-window"></span> Expense Listings </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li>
            <a class="accordion-toggle" href="/dashboard">
                <span class="fa fa fa-trophy"></span>
                <span class="sidebar-title">{{trans('messages.awards')}}</span>
                <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
                <li>
                    <a href="/add-award">
                        <span class="fa fa-adn"></span>{{trans('messages.add_award')}}</a>
                </li>
                <li>
                    <a href="/award-listing">
                        <span class="glyphicon glyphicon-calendar"></span>{{trans('messages.award_listing')}}</a>
                </li>
                <li>
                    <a href="/assign-award">
                        <span class="fa fa-desktop"></span>{{trans('messages.awardees')}}</a>
                </li>
                <li>
                    <a href="/awardees-listing">
                        <span class="fa fa-clipboard"></span>{{trans('messages.awardees_listing')}} </a>
                </li>
            </ul>
        </li>
    @endif


{{--    <li>--}}
{{--        <a class="accordion-toggle" href="#">--}}
{{--            <span class="fa fa fa-gavel"></span>--}}
{{--            <span class="sidebar-title">Trainings</span>--}}
{{--            <span class="caret"></span>--}}
{{--        </a>--}}
{{--        <ul class="nav sub-nav">--}}
{{--            @if(\Auth::user()->notAnalyst())--}}
{{--                <li>--}}
{{--                    <a href="/add-training-program">--}}
{{--                        <span class="fa fa-adn"></span> Add Training Program </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            <li>--}}
{{--                <a href="/show-training-program">--}}
{{--                    <span class="glyphicon glyphicon-calendar"></span> Program Listings </a>--}}
{{--            </li>--}}
{{--            @if(\Auth::user()->notAnalyst())--}}
{{--                <li>--}}
{{--                    <a href="/add-training-invite">--}}
{{--                        <span class="fa fa-desktop"></span> Training Invite </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            <li>--}}
{{--                <a href="/show-training-invite">--}}
{{--                    <span class="fa fa-clipboard"></span> Invitation Listings </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}


{{--    @if(Auth::user()->isHR())--}}
{{--        <li>--}}
{{--            <a class="accordion-toggle" href="#">--}}
{{--                <span class="fa fa-clock-o"></span>--}}
{{--                <span class="sidebar-title"> Attendance </span>--}}
{{--                <span class="caret"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav sub-nav">--}}
{{--                <li>--}}
{{--                    <a href="{{route('attendance-upload')}}">--}}
{{--                        <span class="glyphicon glyphicon-book"></span> Upload Sheets</a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a class="accordion-toggle" href="#">--}}
{{--                <span class="fa fa-tree"></span>--}}
{{--                <span class="sidebar-title">Holiday</span>--}}
{{--                <span class="caret"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav sub-nav">--}}
{{--                <li>--}}
{{--                    <a href="/add-holidays">--}}
{{--                        <span class="glyphicon glyphicon-book"></span> Add Holiday </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="/holiday-listing">--}}
{{--                        <span class="glyphicon glyphicon-modal-window"></span> Holiday Listings </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--    @endif--}}

    <li class="sidebar-label pt30"> {{trans('messages.extras')}}</li>
    <li>
        <a href="/create-meeting">
            <span class="fa fa-calendar-o"></span>
            <span class="sidebar-title">{{trans('messages.meeting')}}&nbsp {{trans('messages.invitation')}} </span>
        </a>
    </li>

    @if(Auth::user()->isCoordinator() ||  Auth::user()->isHR())
        <li>
            <a href="/create-event">
                <span class="fa fa-calendar-o"></span>
                <span class="sidebar-title">{{trans('messages.event')}}  &nbsp {{trans('messages.invitation')}} </span>
            </a>
        </li>
    @endif

    <li>
        <a href="/hr-policy">
            <span class="fa fa-gavel"></span>
            <span class="sidebar-title">{{trans('messages.company_policy')}}</span>
        </a>
    </li>
    <p> &nbsp; </p>
</ul>
<!-- -------------- /Sidebar Menu  -------------- -->