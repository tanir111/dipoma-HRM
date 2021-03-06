@extends('hrms.layouts.base')
@php
    $i = 0;
    if (session('currency') == 'kzt') {
        $currency = 1;
    } else if (session('currency') == 'rub') {
        $currency = 5;
    }else if (session('currency') == 'usd') {
        $currency = 380;
    } else {
        $currency = 1;
    }
@endphp
@section('content')
    <!-- START CONTENT -->
    <div class="content">

        <header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a href="/dashboard">
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-active">
                        <a href="/dashboard"> {{trans('messages.dashboard')}} </a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href="">{{trans('messages.employees')}}</a>
                    </li>
                    <li class="breadcrumb-current-item">{{trans('messages.employee_manager')}}</li>
                </ol>
            </div>
        </header>


        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <!-- -------------- Products Status Table -------------- -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">{{trans('messages.employee_lists')}}</span><br/>
                                </div>
                                <br/>
                                @if(Session::has('failed'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif
                                <div class="panel-menu allcp-form theme-primary mtn">
                                    <div class="row">
                                        {!! Form::open() !!}
                                        <div class="col-md-3">
                                            <input type="text" class="field form-control" placeholder="query string"
                                                   style="height:40px" value="{{$string}}" name="string">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="field select">
                                                {!! Form::select('column', getEmployeeDropDown(),$column) !!}
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="submit" value="{{trans('messages.search')}}" name="button"
                                                   class="btn btn-primary">
                                        </div>
                                        {!! Form::close() !!}
                                        <div class="col-md-1">
                                            <button onclick="exportExcel()"
                                                    class="btn btn-success">{{trans('messages.export')}}</button>
                                        </div>

                                        <div class="col-md-1">
                                            <a href="/employee-manager">
                                                <input type="submit" value="{{trans('messages.reset')}}"
                                                       class="btn btn-warning"></a>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="dropdown dropdown-fuse">
                                                <a href="#" class="btn btn-success dropdown-toggle fw600" data-toggle="dropdown">
                                                    <span class="hidden-xs"><name>{{trans('messages.currency')}}</name></span>
                                                    <span class="fa fa-money"></span>
                                                </a>

                                                <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                                                    <p class="dropdown-footer text-center">
                                                        <a class="dropdown-item"
                                                           href="{{URL::route('setCurrencyKZT')}}">KZT</a>
                                                    </p>
                                                    <p class="dropdown-footer text-center">
                                                        <a class="dropdown-item"
                                                           href="{{URL::route('setCurrencyRUB')}}">RUB</a>
                                                    </p>
                                                    <p class="dropdown-footer text-center">
                                                        <a class="dropdown-item"
                                                           href="{{URL::route('setCurrencyUSD')}}">USD</a>
                                                    </p>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body pn">
                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                            <thead>
                                            <tr class="bg-light">
                                                <th class="text-center">{{trans('messages.id')}}</th>
                                                <th class="text-center">{{trans('messages.employee_code')}}</th>
                                                <th class="text-center">{{trans('messages.name')}}</th>
                                                <th class="text-center">{{trans('messages.salary')}}</th>
                                                <th class="text-center">{{trans('messages.employee_surname')}}</th>
                                                <th class="text-center">{{trans('messages.email_in_system')}}</th>
                                                <th class="text-center">{{trans('messages.status')}}</th>
                                                <th class="text-center">{{trans('messages.role')}}</th>
                                                <th class="text-center">{{trans('messages.joining_date')}}</th>
                                                <th class="text-center">{{trans('messages.mobile_number')}}</th>
                                                <th class="text-center">{{trans('messages.department')}}</th>
                                                <th class="text-center">{{trans('messages.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($emps as $emp)
                                                <tr>
                                                    <td class="text-center">{{$i+=1}}</td>
                                                    <td class="text-center">{{$emp->employee['code']}}</td>
                                                    <td class="text-center">{{$emp->name}}</td>
                                                    <td class="text-center">{{round(round($emp->employee['salary'] ? $emp->employee['salary']  : 0)/$currency)}}</td>
                                                    <td class="text-center">{{$emp->surname}}</td>
                                                    <td class="text-center">{{$emp->email}}</td>
                                                    <td class="text-center">{{convertStatusBack($emp->employee['status'])}}</td>
                                                    <td class="text-center">{{isset($emp->role->role->name)?$emp->role->role->name:''}}</td>
                                                    <td class="text-center">{{date('Y-m-d', strtotime($emp->employee['date_of_joining']))}}</td>
                                                    <td class="text-center">{{$emp->employee['number']}}</td>
                                                    <td class="text-center">{{$emp->employee['department']}}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group text-right">
                                                            <button type="button"
                                                                    class="btn btn-info br2 btn-xs fs12 dropdown-toggle"
                                                                    data-toggle="dropdown"
                                                                    aria-expanded="false"> {{trans('messages.action')}}
                                                                <span class="caret ml5"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="/edit-emp/{{$emp->id}}">{{trans('messages.edit')}}</a>
                                                                </li>
                                                                @if(\Auth::user()->isHR() || \Auth::user()->isHR())
                                                                    <li>
                                                                        <a href="/delete-emp/{{$emp->id}}">{{trans('messages.delete')}}</a>
                                                                    </li>
                                                                @else
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="10">
                                                    {!! $emps->render() !!}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection



@section("extrascriptForExport")
    <script src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <!-- <script src="xlsx.js"></script> -->
    <script>
        var data = '{!! $jsonEmps !!}';
        data = JSON.parse(data);

        function exportExcel() {
            createXLSLFormatObj = document.getElementById('table');
            var filename = "Employee.xlsx";
            var ws_name = "Employee";
            var wb = XLSX.utils.book_new(),
                ws = XLSX.utils.json_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, ws_name);
            XLSX.writeFile(wb, filename);
        }

    </script>
@endsection