@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        <!-- // market-->
        <div class="container">
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
            <h3 class="text-center text-danger">{{Session::get('error')}}</h3>
            <div class="row">
                {!! Form::open(['url'=>'admin/add/sectionTeacher','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="imputEmail" class="col-sm-4 control-label">Section</label>
                                <div class="col-sm-6 {{ $errors->has('section_id') ? ' has-error' : '' }}">
                                    <select class="form-control" id="sel1" name="section_id">
                                        @foreach( $sections as $section)
                                            <option value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('section_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('section_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-1"></div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="imputEmail" class="col-sm-4 control-label">Subject</label>
                                <div class="col-sm-6 {{ $errors->has('subject_id') ? ' has-error' : '' }}">
                                    <select class="form-control" id="sel1" name="subject_id">
                                        @foreach( $subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subjectName}}</option>
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
                                <label for="imputEmail" class="col-sm-4 control-label">Teacher</label>
                                <div class="col-sm-6 {{ $errors->has('teacher_id') ? ' has-error' : '' }}">
                                    <select class="form-control" id="sel1" name="teacher_id">
                                        @foreach( $teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
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
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-success btn-block">Add on section</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>


                </div>
                <div class="modal-footer">
                </div>
                {!! Form::close() !!}
            </div>
            <div class="table-responsive text-center">
                <table class="table table-borderless" id="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Section</th>
                        <th class="text-center">Teacher</th>
                        <th class="text-center">subject</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    @foreach($datas as $data)
                        <tr class="item{{$data->section_teachers_id}}">
                            <td>{{$data->section_teachers_id}}</td>
                            <td>{{$data->section_name}}</td>
                            <td>{{$data->user_name}}</td>
                            <td>{{$data->subjectName}}</td>
                            <td><a class="edit-modal btn btn-info"
                                   href="{{url('admin/sectionTeacher/edit/'.$data->section_teachers_id)}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </a>
                                <a class="delete-modal-section btn btn-danger"
                                   href="{{url('admin/sectionTeacher/delete/'.$data->section_teachers_id)}}"
                                   onclick="return confirm('Are you sure to delete');">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>

@endsection
