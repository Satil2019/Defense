@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        <!-- // market-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd" >Add subject</button>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
            <br>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        {{--add section model --}}
        <div class="modal fade" id="myModalAdd" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Add Section</h4>
                    </div>

                    <br>
                    {!! Form::open(['url'=>'admin/subject/save','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Subject Code</label>
                            <div class="col-sm-5 {{ $errors->has('subjectCode') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="subjectCode">

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
                                <input type="text" class="form-control" name="subjectName">

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
                                <button type="submit" class="btn btn-success btn-block">Save Section</button>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Subject Code</th>
                    <th class="text-center">Subject Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->subjectCode}}</td>
                        <td>{{$item->subjectName}}</td>
                        <td>
                            <a class="edit-modal btn btn-info" data-id="{{$item->id}}" href="{{url('/admin/subjectEdit/'.$item->id)}}">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <a class="delete-modal-section btn btn-danger" href="{{url('/admin/subjectDelete/'.$item->id)}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
