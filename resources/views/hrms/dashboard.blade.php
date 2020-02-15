@extends('hrms.layouts.base')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- -------------- Topbar -------------- -->
    <header id="topbar" class="alt">
        <div class="topbar-left">
            <ol class="breadcrumb">
                <li class="breadcrumb-icon">
                    <a href="/dashboard">
                        <span class="fa fa-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-active">
                    <a href="/dashboard">{{trans('messages.dashboard')}}</a>
                </li>
                <li class="breadcrumb-link">
                    <a href="/dashboard">{{trans('messages.home')}}</a>
                </li>
                <li class="breadcrumb-current-item">{{trans('messages.dashboard')}}</li>
            </ol>
        </div>

    </header>
    <!-- -------------- /Topbar -------------- -->

    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">

        <!-- -------------- Column Center -------------- -->
        <div class="chute chute-center">

            <!-- -------------- Quick Links -------------- -->
            <div class="row">
                @if(Auth::user()->isHR())
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10">
                                        <img src="/assets/img/pages/clipart2.png" class="img-responsive mauto" alt=""/>
                                    </div>
                                    <div class="col-xs-7 pl5">
                                        <h5 class="text-muted"><a href="{{route('employee-manager')}}">
                                                {{trans('messages.employee_manager')}}
                                            </a></h5>
                                        {{--<h2 class="fs50 mt5 mbn">385</h2>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="/assets/img/pages/clipart0.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h5 class="text-muted"><a href="{{route('total-leave-list')}}">
                                                {{trans('messages.leave_manager')}}
                                            </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="/assets/img/pages/laptop.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h5 class="text-muted"><a href="{{route('asset-listing')}}">
                                                {{trans('messages.asset_manager')}}
                                            </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="/assets/img/pages/dollar.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h5 class="text-muted"><a href="{{route('expense-list')}}">
                                                {{trans('messages.expense_manager')}}
                                            </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-4 ph10"><img src="/assets/img/pages/clipart5.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-8 pl5">
                                        <h5 class="text-muted"><a href="{{route('attendance-manager')}}">
                                                {{trans('messages.attendance_manager')}}
                                            </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel">
                                    <canvas id="myChart1"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel">
                                    <canvas id="myChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>





                    <script>


                        function createChart(id, data, colors, labels) {
                            var ctx = document.getElementById(id).getContext('2d');
                            data = {
                                datasets: [{
                                    data: data,
                                    backgroundColor: colors
                                }],

                                // These labels appear in the legend and in the tooltips when hovering different arcs
                                labels: labels
                            };
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: data,
                            });
                        }

                        var labels = [
                            '{{trans('messages.projects')}}',
                            '{{trans('messages.clients')}}'
                        ];
                        var data = [
                            0{{$projectsCount}},
                            0{{$clientsCount}}
                        ];
                        var colors = [
                            'green',
                            'blue'
                        ];

                        createChart('myChart1', data, colors, labels);

                        labels = [
                            '{{trans('messages.approved')}}',
                            '{{trans('messages.disapproved')}}'
                        ];
                        data = [
                            0{{$appliedCount}},
                            0{{$notAppliedCount}}
                        ];
                        colors = [
                            'green',
                            'blue'
                        ];

                        createChart('myChart2', data, colors, labels);

                    </script>
                @endif
                @if(!Auth::user()->isHR())
                    <div class="col-sm-6 col-xl-3">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="/assets/img/pages/clipart0.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h4 class="text-muted"><a href="{{route('my-leave-list')}}"> LEAVES </a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{--                <div class="col-sm-6 col-xl-3">--}}
                {{--                    <div class="panel panel-tile">--}}
                {{--                        <div class="panel-body">--}}
                {{--                            <div class="row pv10">--}}
                {{--                                <div class="col-xs-5 ph10"><img src="/assets/img/pages/clipart6.png"--}}
                {{--                                                                class="img-responsive mauto" alt=""/></div>--}}
                {{--                                <div class="col-xs-7 pl5">--}}
                {{--                                    <h4 class="text-muted"><a href="{{route('hr-policy')}}"> HR POLICIES </a></h4>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                @if($events)
                    <div class="col-md-12">
                        <h3 class="mb10 mr5 notification" data-note-style="primary" style="color: darkturquoise">Latest
                            &nbsp; Events </h3>
                        @foreach (array_chunk($events, 3, true) as $results)
                            <table class="table">
                                <tr>
                                    @foreach($results as $event)
                                        <td>
                                            <div class='fc-event fc-event-primary' data-event="primary">
                                                <div class="fc-event-icon" style="color: darkslateblue">
                                                    <span class="fa fa-exclamation"></span>
                                                </div>
                                                <div class="fc-event-desc blink" id="blink">
                                                    <a href="{{route('create-event')}}"><b>{{ \Carbon\Carbon::createFromTimestamp(strtotime($event->date))->diffForHumans()}} </b> {{$event->name}}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        @endforeach
                    </div>
                @endif

                @if($meetings)
                    <div class="col-md-12">
                        <h3 class=" mb10 mr5 notification" data-note-style="primary" style="color: darkturquoise">
                            Latest &nbsp;&nbsp; Meetings </h3>
                        @foreach (array_chunk($meetings, 3, true) as $results)
                            <table class="table">
                                <tr>
                                    @foreach($results as $meeting)
                                        <td>
                                            <div class='fc-event fc-event-primary' data-event="primary">
                                                <div class="fc-event-icon" style="color: darkslateblue">
                                                    <span class="fa fa-exclamation"></span>
                                                </div>
                                                <div class="fc-event-desc blink" id="blink">
                                                    <b>{{ \Carbon\Carbon::createFromTimestamp(strtotime($meeting->date))->diffForHumans()}} </b> {{$meeting->name}}
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        @endforeach
                    </div>
                @endif


            </div>
        </div>
    </section>
@endsection