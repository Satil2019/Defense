@extends('admin.master')
@section('rootcontent')
    <section class="wrapper">
        <!-- // market-->
  <div class="container">
      <div class="row">
          <div class="col-sm-4">
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd" >Add section</button>
          </div>
          <div class="col-sm-4">
              <a href=" {{ url('admin/section/teacher') }}" class="btn btn-lg btn-info">Teacher on section</a>
          </div>
          <div class="col-sm-4">
              <a href="{{ url('admin/section/student') }}" class="btn btn-lg btn-info">Student on section</a>
          </div>
      </div>

  </div>
        {{--add section model --}}
        <div class="modal fade" id="myModalAdd" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Add Section</h4>
                    </div>
                    <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                    <br>
                    {!! Form::open(['url'=>'admin/section/save','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="imputEmail" class="col-sm-4 control-label">Section Name</label>
                            <div class="col-sm-5 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
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
        {{ csrf_field() }}
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                                    data-name="{{$item->name}}">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </button>
                            <button class="delete-modal-section btn btn-danger"
                                    data-id="{{$item->id}}" data-name="{{$item->name}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </button></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fid" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="n">
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn actionBtn" data-dismiss="modal">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-modal', function() {
                $('#footer_action_button').text("Update");
                $('#footer_action_button').addClass('glyphicon-check');
                $('#footer_action_button').removeClass('glyphicon-trash');
                $('.actionBtn').addClass('btn-success');
                $('.actionBtn').removeClass('btn-danger');
                $('.actionBtn').addClass('edit');
                $('.modal-title').text('Edit');
                $('.deleteContent').hide();
                $('.form-horizontal').show();
                $('#fid').val($(this).data('id'));
                $('#n').val($(this).data('name'));
                $('#myModal').modal('show');
            });
            $(document).on('click', '.delete-modal-section', function() {
                $('#footer_action_button').text(" Delete");
                $('#footer_action_button').removeClass('glyphicon-check');
                $('#footer_action_button').addClass('glyphicon-trash');
                $('.actionBtn').removeClass('btn-success');
                $('.actionBtn').addClass('btn-danger');
                $('.actionBtn').addClass('delete');
                $('.modal-title').text('Delete');
                $('.did').text($(this).data('id'));
                $('.deleteContent').show();
                $('.form-horizontal').hide();
                $('.dname').html($(this).data('name'));
                $('#myModal').modal('show');
            });

            $('.modal-footer').on('click', '.edit', function() {

                $.ajax({
                    type: 'post',
                    url: '/admin/section/update',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $("#fid").val(),
                        'name': $('#n').val()
                    },
                    success: function(data) {
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal-section btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }
                });
            });
            $("#add").click(function() {

                $.ajax({
                    type: 'post',
                    url: '/admin/section/save',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'name': $('input[name=name]').val()
                    },
                    success: function(data) {
                        if ((data.errors)){
                            $('.error').removeClass('hidden');
                            $('.error').text(data.errors.name);
                        }
                        else {
                            $('.error').addClass('hidden');
                            $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal-section btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        }
                    },

                });
                $('#name').val('');
            });
            $('.modal-footer').on('click', '.delete', function() {
                $.ajax({
                    type: 'post',
                    url: '/admin/section/delete',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $('.did').text()
                    },
                    success: function(data) {
                        $('.item' + $('.did').text()).remove();
                    }
                });
            });
        });

    </script>
@endsection
