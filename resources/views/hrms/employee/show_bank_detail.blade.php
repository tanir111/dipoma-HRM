@extends('hrms.layouts.base')
@php
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

    {!! Html::script('/assets/js/jquery/jquery-1.11.3.min.js') !!}
    {!! Html::script('/assets/js/jquery/jquery_ui/jquery-ui.min.js') !!}

    <script src="/assets/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="/assets/jquery.maskedinput.min.js" type="text/javascript"></script>

    <!-- START CONTENT -->
    <input type="hidden" value="{{csrf_token()}}" id="token">
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
                        <a href=""> {{trans('messages.employee')}} </a>
                    </li>
                    <li class="breadcrumb-current-item">{{trans('messages.bank_details')}}</li>
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
                                    <span class="panel-title hidden-xs">{{trans('messages.bank_detail_listings')}}</span>

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
                                <div class="panel-body pn">
                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    {!! Form::open(['class' => 'form-horizontal']) !!}
                                    <div class="table-responsive">
                                        <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                            <thead>
                                            <tr class="bg-light">
                                                <th class="text-center">{{trans('messages.id')}}</th>
                                                <th class="text-center">{{trans('messages.employee')}}</th>
                                                <th class="text-center">{{trans('messages.salary')}}</th>
                                                <th class="text-center">{{trans('messages.bank_name')}}</th>
                                                <th class="text-center">{{trans('messages.account_number')}}</th>
                                                <th class="text-center">{{trans('messages.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0;?>
                                            @foreach($emps as $emp)
                                                <tr>
                                                    <td class="text-center">{{$i+=1}}</td>
                                                    <td class="text-center">{{$emp->name}}</td>
                                                    <td class="text-center">{{round(round($emp->employee['salary'] ? $emp->employee['salary']  : 0)/$currency)}}</td>
                                                    <td class="text-center">{{$emp->employee['bank_name']}}</td>
                                                    <td class="text-center">{{$emp->employee['account_number']}}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group text-right">
                                                            <button type="button"
                                                                    class="btn btn-success br2 btn-xs fs12 showModal"
                                                                    data-info='[
                                                                "{{$emp->employee['id']}}",
                                                                "{{$emp->employee['name']}}",
                                                                "{{$emp->employee['bank_name']}}",
                                                                "{{$emp->employee['account_number']}}"
                                                                ]'> {{trans('messages.edit')}}
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                {!! $emps->render() !!}
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>


    <!-- Modal -->
    <div id="bankModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('messages.edit')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee_name">{{trans('messages.employee_name')}}</label>
                        <input type="text" id="employee_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="bank_name">{{trans('messages.bank_name')}}</label>
                        <input type="text" id="bank_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="account_number">{{trans('messages.account_number')}}</label>
                        <input type="text" id="account_number" class="form-control">
                    </div>


                    <script>
                        $(document).ready(function ($) {
                            $("#account_number").mask("9999-9999-9999-9999");
                        });
                    </script>


                    <input type="hidden" id="emp_id" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom"
                            id="update-bank-account-details">{{trans('messages.update')}}</button>
                </div>
            </div>

        </div>
    </div>
@endsection