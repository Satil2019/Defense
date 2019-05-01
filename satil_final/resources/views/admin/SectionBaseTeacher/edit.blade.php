@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        <!-- // market-->
        <div class="container">
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
            <br>
            <div class="row">
                {!! Form::open(['url'=>'admin/sectionTeacher/update','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="imputEmail" class="col-sm-4 control-label">Section</label>
                                <div class="col-sm-6 {{ $errors->has('section') ? ' has-error' : '' }}">
                                    <input type="hidden" name="id" value="{{$data->id}}" id="{{$data->id}}">
                                    <select class="form-control" id="sel1" name="section_id">
                                        @foreach( $sections as $section)
                                            <option value="{{$section->id}}" @if($data->section_id==$section->id) selected @endif>{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('section'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="imputEmail" class="col-sm-4 control-label">subject</label>
                                <div class="col-sm-6 {{ $errors->has('section') ? ' has-error' : '' }}">
                                    <input type="hidden" name="id" value="{{$data->id}}" id="{{$data->id}}">
                                    <select class="form-control" id="sel1" name="subject_id">
                                        @foreach( $subjects as $subject)
                                            <option value="{{$subject->id}}" @if($data->section_id==$subject->id) selected @endif>{{$subject->subjectName}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('subject_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('subject_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="imputEmail" class="col-sm-4 control-label">Student</label>
                                <div class="col-sm-5 {{ $errors->has('teacher_id') ? ' has-error' : '' }}">
                                    <select class="form-control" name="teacher_id">
                                        @foreach( $students as $student)
                                            <option value="{{$student->id}}" @if($data->teacher_id==$student->id) selected @endif>{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('teacher_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('teacher_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success btn-block">Update on section</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
