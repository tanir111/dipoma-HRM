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
                        <a href="/dashboard"> {{trans('messages.dashboard')}} </a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href=""> {{trans('messages.promotion')}} </a>
                    </li>
                    <li class="breadcrumb-current-item"> {{trans('messages.promotion_listings')}} </li>
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
                                    <span class="panel-title hidden-xs"> {{trans('messages.promotion_listings')}} </span>
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
                                                <th class="text-center">{{trans('messages.old_designation')}}</th>
                                                <th class="text-center">{{trans('messages.new_designation')}}</th>
                                                <th class="text-center">{{trans('messages.old_salary')}}</th>
                                                <th class="text-center">{{trans('messages.new_salary')}}</th>
                                                <th class="text-center">{{trans('messages.date_of_promotion')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i =0;?>
                                            @foreach($promotions as $promotion)
                                                <tr>
                                                    <td class="text-center">{{$i+=1}}</td>
                                                    <td class="text-center">{{$promotion->employee->name}}</td>
                                                    <td class="text-center">{{$promotion->old_designation}}</td>
                                                    <td class="text-center">{{$promotion->new_designation}}</td>
                                                    <td class="text-center">{{$promotion->old_salary}}</td>
                                                    <td class="text-center">{{$promotion->new_salary}}</td>
                                                    <td class="text-center">{{getFormattedDate($promotion->date_of_promotion)}}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                {!! $promotions->render() !!}
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
@endsection