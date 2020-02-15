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
                        <a href=""> {{trans('messages.assigned_project')}} </a>
                    </li>
                    <li class="breadcrumb-current-item">{{trans('messages.project_assignment_listings')}}</li>
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
                                    <span class="panel-title hidden-xs">{{trans('messages.project_assignment_listings')}}</span>
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
                                                <th class="text-center">{{trans('messages.project')}}</th>
                                                <th class="text-center">{{trans('messages.issuing_authority')}}</th>
                                                <th class="text-center">{{trans('messages.date_of_assignment')}}</th>
                                                <th class="text-center">{{trans('messages.date_of_release')}}</th>
                                                <th class="text-center">{{trans('messages.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i =0;?>
                                            @foreach($projects as $project)
                                                <tr>
                                                    <td class="text-center">{{$i+=1}}</td>
                                                    <td class="text-center">{{$project->employee->name}}</td>
                                                    <td class="text-center">{{$project->project->name}}</td>
                                                    <td class="text-center">{{$project->authority->name}}</td>
                                                    <td class="text-center">{{getFormattedDate($project->date_of_assignment)}}</td>
                                                    <td class="text-center">{{getFormattedDate($project->date_of_release)}}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group text-right">
                                                            <button type="button"
                                                                    class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"> {{trans('messages.action')}}
                                                                <span class="caret ml5"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="/edit-project-assignment/{{$project->id}}">{{trans('messages.edit')}}</a>
                                                                </li>
                                                                <li>
                                                                    <a href="/delete-project-assignment/{{$project->id}}">{{trans('messages.delete')}}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                {!! $projects->render() !!}
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