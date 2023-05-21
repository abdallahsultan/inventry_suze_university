@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">Update Profile</h3>
            {{-- <a onclick="addForm()" class="btn btn-outline-primary pull-right" style="margin-right:5px " ><i class="fa fa-plus"></i> Add User</a> --}}
            <!-- <a href="/register" class="btn btn-success" ><i class="fa fa-plus"></i> Add User</a> -->
        </div>

        


        <!-- /.box-header -->
        <div class="box-body">
        <div class="modal-content">
            <form id="form-item" method="post" class="form-horizontal" action="{{route('update.profile')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">

                        <div class="form-group">
                            <div class="col-md-3">
                                <label>Faculty :</label>
                            </div>
                            <div class="col-md-9">
                                {!! Form::select('faculty_id', $faculty, $user->faculty->id, ['class' => ' form-control select',
                                'placeholder' => '-- Choose Faculty --', 'id' => 'faculty_id', 'required']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="name">Name :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    id="name" name="name" value="{{$user->name }}" required autofocus
                                    placeholder="Name">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="email">Email :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ $user->email }}" required placeholder="Email">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="phone">Phone :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="{{$user->phone}}" class="form-control" id="phone" name="phone" placeholder="phone">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="signup-password">Password :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" 
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" value=""  placeholder="Password">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="signup-password">Confirm Pass :</label>
                            </div>
                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control"
                                    placeholder="Confirm Password" name="password_confirmation" >
                            </div>
                        </div>




                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
        </div>
        <!-- /.box-body -->
    </div>

   
@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

       <!-- Validator  -->
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
<!-- 
    <script>
    $(function () {
    $('#items-table').DataTable()
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
    })
    </script> -->
    

    <script type="text/javascript">
        
    </script>

@endsection
