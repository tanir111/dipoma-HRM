@extends('hrms.layouts.base')

@section('content')
        <!-- START CONTENT -->
<div class="content">

    <header id="topbar" class="alt">
        <div class="topbar-left">
            @if(\Route::getFacadeRoot()->current()->uri() == 'edit-asset-assignment/{id}')
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
                        <a href=""> {{trans('messages.assets')}} </a>
                    </li>
                    <li class="breadcrumb-current-item"> {{trans('messages.edit')}} {{$assets->name}} </li>
                </ol>


            @else
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
                    <a href=""> {{trans('messages.assets')}} </a>
                </li>
                <li class="breadcrumb-current-item"> {{trans('messages.assign_asset')}} </li>
            </ol>
            @endif
        </div>
    </header>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn" >
        <!-- -------------- Column Center -------------- -->
        <div class="chute-affix" data-spy="affix" data-offset-top="200">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                    <div class="panel">
                        <div class="panel-heading">
                            @if(\Route::getFacadeRoot()->current()->uri() == 'edit-asset-assignment/{id}')
                                <span class="panel-title hidden-xs"> {{trans('messages.edit_asset_assignment')}} </span>
                            @else
                                <span class="panel-title hidden-xs"> {{trans('messages.assign_asset')}}</span>
                            @endif
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
                                            <label class="col-md-3 control-label">{{trans('messages.select_employee')}} </label>
                                            <div class="col-md-6">
                                                <select class="select2-multiple form-control select-primary"
                                                        name="emp_id" required>
                                                    <option value="" selected>{{trans('messages.select_one')}}</option>
                                                    @foreach($emps as $emp)
                                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> {{trans('messages.select_asset')}} </label>
                                            <div class="col-md-6">
                                                <select class="select2-multiple form-control select-primary"
                                                        name="asset_id" required>
                                                    <option value="" selected>{{trans('messages.select_one')}}</option>
                                                    @foreach($assets as $asset)
                                                        <option value="{{$asset->id}}">{{$asset->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{trans('messages.select_issuing_authority')}} </label>
                                            <div class="col-md-6">
                                                <select class="select2-multiple form-control select-primary"
                                                        name="authority_id" required>
                                                    <option value="" selected>{{trans('messages.select_one')}}</option>
                                                    @foreach($emps as $emp)
                                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                        <label for="datepicker1" class="col-md-3 control-label"> {{trans('messages.date_of_assignment')}} </label>
                                            <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar text-alert pr11"></i>
                                                        </div>
                                                        @if(\Route::getFacadeRoot()->current()->uri() == 'edit-assignment/{id}')
                                                        <input type="text" id="datepicker1" class="select2-single form-control" name="doa" value="@if($emps && $emps->date_of_assignment){{$emps->date_of_assignment}}@endif" required>
                                                        @else
                                                            <input type="text" id="datepicker1" class="select2-single form-control" name="doa" required>
                                                        @endif
                                                    </div>
                                            </div>
                                            </div>



                                        <div class="form-group">
                                            <label for="datepicker4" class="col-md-3 control-label"> {{trans('messages.date_of_release')}} </label>
                                            <div class="col-md-6">
                                                {{--@if(\Route::getFacadeRoot()->current()->uri() == 'edit-assignment/{id}')

                                                    <input type="date" id="datepicker1" class="select2-single form-control" name="dor" value="@if($emps && $emps->dor){{$emps->dor}}@endif"/>

                                                @else

                                                    <input type="date" id="datepicker1" class="select2-single form-control" name="dor"/>

                                                @endif--}}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar text-alert pr11"></i>
                                                    </div>
                                                    @if(\Route::getFacadeRoot()->current()->uri() == 'edit-assignment/{id}')
                                                        <input type="text" id="datepicker4" class="select2-single form-control" name="dor" value="@if($emps && $emps->date_of_assignment){{$emps->date_of_assignment}}@endif" required>
                                                    @else
                                                        <input type="text" id="datepicker4" class="select2-single form-control" name="dor" required>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-2">

                                                     <input type="submit" class="btn btn-bordered btn-info btn-block" value="{{trans('messages.submit')}}">
                                            </div>
                                            <div class="col-md-2"><a href="/assign-asset" >
                                                    <input type="button" class="btn btn-bordered btn-success btn-block" value="{{trans('messages.reset')}}"></a></div>
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

    </section>

</div>
@endsection
@push('scripts')
    <script src="/assets/js/pages/forms-widgets.js"></script>
    <script src="/assets/js/custom.js"></script>
    @endpush