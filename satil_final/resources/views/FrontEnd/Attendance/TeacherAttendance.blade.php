@extends('home')
@section('MainContainer')
    @can('isStudent')
        <h1>student</h1>
        <h1 class="text-center">Wellcome, {{Auth::user()->name}}</h1>
        <h3 class="text-center">Take Attendence</h3>
        <div class="text-center">
            {!! Form::open(['url'=>'GiveAttendance/','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="attendence" value="1" id="">Attendence</label>
                            </div>
                        </div>
                    </div>
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
        <h2 class="text-center">Uniquecode : <span class="text-info">{{$uniqueCode}}</span></h2>
        <div class="text-center">
            {!! Form::open(['url'=>'takeAttendance/','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                @foreach( $datas as $data)
                <div class="row">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="{{$data->user_name}}" value="1" id="{{$data->user_id}}">{{$data->user_name}}</label>
                        </div>
                    </div>
                </div>
                @endforeach
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
