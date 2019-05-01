@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        {{--add section model --}}
        <div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">edit Subject</h4>
                    </div>

                    <br>
                    {!! Form::open(['url'=>'admin/subject/update','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Subject Code</label>
                            <div class="col-sm-5 {{ $errors->has('subjectCode') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="subjectCode" value="{{$data->subjectCode}}">
                                <input type="hidden" class="form-control" name="id" value="{{$data->id}}">

                                @if ($errors->has('subjectCode'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('subjectCode') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Subject Name</label>
                            <div class="col-sm-5 {{ $errors->has('subjectName') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="subjectName" value="{{$data->subjectName}}">

                                @if ($errors->has('subjectName'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('subjectName') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-success btn-block">Update Section</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
