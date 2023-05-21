<div class="modal fade" id="modal-form-confirm" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item-confirm" method="post"  class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }}
                 {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title-confirm"></h3>
                </div>


                <div class="modal-body-confirm">
                    <input type="hidden" id="id" name="id">

                  
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-3">
                            <label for="name" >Reciver Name :</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" class="form-control" id="reciver_national_name" name="reciver_national_name"  autofocus required>
                            <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                            <label for="name" >Reciver Phone :</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" class="form-control" id="reciver_national_phone" name="reciver_national_phone"  autofocus >
                            <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                            <label for="name" >Reciver nationalID :</label>
                            </div>
                            <div class="col-md-9">
                            <input type="text" class="form-control" id="reciver_national_id" name="reciver_national_id"  autofocus>
                            <span class="help-block with-errors"></span>
                            </div>
                        </div>
                     
                    </div>
                    <!-- /.box-body -->

                </div><!-- Log on to codeastro.com for more projects! -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
