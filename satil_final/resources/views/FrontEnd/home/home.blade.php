@extends('home')
@section('MainContainer')
    @can('isStudent')
        <h1>Wellcome, {{Auth::user()->name}}</h1>
        <h3 class="text-center">Give Attendence</h3>
        <br>
        <h4 class="text-center" style="color:red;">
                {{Session::get('message')}}
            </h4>
        <div class="row">
            {!! Form::open(['url'=>'/student/giveAttendance/','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Section</label>
                            <div class="col-sm-5 {{ $errors->has('section') ? ' has-error' : '' }}">
                                <select class="form-control studentsectionName" id="sel1" name="section_id">
                                        @foreach($datas as $data)
                                            <option value="{{$data->section_id}}">{{$data->sectionName}}</option>
                                            <option value="{{$data->subject_id}}">{{$data->subjectName}}</option>
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
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Subject</label>
                            <div class="col-sm-5 {{ $errors->has('section') ? ' has-error' : '' }}">
                                <select class="form-control" id="subjectNameStudent" name="subject_id">
                                    <select class="form-control subjectName" id="subjectName" name="subject_id">
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
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Secret</label>
                            <div class="col-sm-5 {{ $errors->has('section') ? ' has-error' : '' }}">
                                <input id="secret" type="text" class="form-control{{ $errors->has('secret') ? ' is-invalid' : '' }}"
                                       name="secret" value="{{ old('secret') }}" required autofocus>

                                @if ($errors->has('secret'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-success btn-block">Give Attendence</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endcan
    @can('isTeacher')
        <h1 class="text-center">Wellcome, {{Auth::user()->name}}</h1>
        <h3 class="text-center">Take Attendence</h3>
        <div class="row">
            {!! Form::open(['url'=>'/teacher/takeAttendance/','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Section</label>
                            <div class="col-sm-5 {{ $errors->has('section') ? ' has-error' : '' }}">
                                <select class="form-control sectionName" id="sel1" name="section_id">
                                    @foreach($datas as $data)
                                 <option value="{{$data->section_id}}">{{$data->sectionName}}</option>
                                            <option value="{{$data->subject_id}}">{{$data->subjectName}}</option>
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
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Subject</label>
                            <div class="col-sm-5 {{ $errors->has('section') ? ' has-error' : '' }}">
                                <select class="form-control subjectName" id="subjectName" name="subject_id">
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
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-success btn-block">Take Attendence</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    @endcan
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.sectionName',function(){
                //console.log("hmm its change");

                var section_id=$(this).val();
                //console.log(section_id);
                var div=$(this).parent();

                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('SubjectNameTeacher')!!}',
                    data:{'id':section_id},
                    success:function(data){
                        console.log(data);
                        op+='<option value="0" selected disabled>chose Subject</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].subject_id+'">'+data[i].subjectName+'</option>';
                        }
                        $('#subjectName').html(" ")
                        $('#subjectName').append(op);
                    },
                    error:function(){

                    }
                });


            });

            $(document).on('change','.studentsectionName',function(){
                //console.log("hmm its change");

                var section_id=$(this).val();
                console.log(section_id);
                var div=$(this).parent();

                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('SubjectNameStudent')!!}',
                    data:{'id':section_id},
                    success:function(data){
                        op+='<option value="0" selected disabled>chose Subject</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].subject_id+'">'+data[i].subjectName+'</option>';
                        }
                        $('#subjectNameStudent').html(" ");
                        $('#subjectNameStudent').append(op);
                    },
                    error:function(){

                    }
                });


            });

        });
    </script>

@endsection
