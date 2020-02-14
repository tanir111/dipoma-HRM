@extends('hrms.layouts.base')

@section('content')


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body">
                        <form enctype="multipart/form-data" action="{{route('upload-emp.excel')}}" method="post">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('admin.excelfile')}}</label>
                                        <input type="file" id="file" name="file" class="form-control"
                                               placeholder="{{trans('admin.excelfile')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-block"
                                               value="{{trans('admin.add')}}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
