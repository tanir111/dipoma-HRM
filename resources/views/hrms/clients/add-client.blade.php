@extends('hrms.layouts.base')

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
                        <a href="/dashboard"> {{trans('messages.dsahboard')}} </a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href=""> {{trans('messages.client')}} </a>
                    </li>
                    <li class="breadcrumb-current-item">{{trans('messages.add_client')}}</li>
                </ol>
            </div>
        </header>
        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">
            <!-- -------------- Column Center -------------- -->
            <div class="chute-affix" data-spy="affix" data-offset-top="200">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">{{trans('messages.add_client')}}</span>
                                </div>

                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <div class="panel-body p25 pb10">
                                            @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                    {{Session::get('flash_message')}}
                                                </div>
                                            @endif
                                            {!! Form::open(['class' => 'form-horizontal']) !!}

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{trans('messages.client')}}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="name" id="input002" class="select2-single form-control" placeholder="Name" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{trans('messages.address')}}</label>
                                                <div class="col-md-6">
                                                    <textarea class="select2-single form-control" rows="3" id="address" placeholder="Client Address" name="address"></textarea>
                                                </div>
                                            </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> {{trans('messages.company')}} </label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="company" id="input002" class="select2-single form-control" placeholder="Company">
                                                    </div>
                                                </div>

                                                <div class="form-group code-group">
                                                    <label class="col-md-3 control-label">{{trans('messages.code')}}</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="code" id="code" class="select2-single form-control" placeholder="Unique Code" required>
                                                    </div>
                                                </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-2">

                                                    <input type="submit" class="btn btn-bordered btn-info btn-block save-client" value="{{trans('messages.submit')}}">
                                                </div>
                                                <div class="col-md-2"><a href="/add-client">
                                                        <input type="button" class="btn btn-bordered btn-success btn-block" value="{{trans('messages.reset')}}"></a>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
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