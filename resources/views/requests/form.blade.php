<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
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
                                <label for="faculty_id">Faculty :</label>
                            </div>
                            <div class="col-md-9">
                                {!! Form::select('faculty_id', $faculties, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Faculty --', 'id' => 'faculty_id','required']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group select_type">
                            <div class="col-md-3">
                                <label for="product_id">Product :</label>
                            </div>
                            <div class="col-md-9">
                                {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Product --', 'id' => 'product_id','required']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                            <label for="name" >Qty :</label>
                            </div>
                            <div class="col-md-9">
                            <input type="number" class="form-control" id="qty" name="qty"  autofocus required>
                            <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div><!-- Log on to codeastro.com for more projects! -->

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
