<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-item" method="post" class="form-horizontal" data-toggle="validator"
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
                                {!! Form::select('faculty_id', $faculty, null, ['class' => 'form-control select',
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
                                    id="name" name="name" value="{{ old('name') }}" required autofocus
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
                                    name="email" value="{{ old('email') }}" required placeholder="Email">
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
                                <input type="text"  class="form-control" id="phone" name="phone" placeholder="phone">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="signup-password">Password :</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" id="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required placeholder="Password">
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
                                    placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                        </div>




                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->