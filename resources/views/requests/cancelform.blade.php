<div class="modal fade" id="modal-form-cancel" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item-cancel" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title-cancel"></h3>
                </div>


                <div class="modal-body-cancel">
                    <input type="hidden" id="id" name="id">

                  
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-3">
                            <label for="name" >Resone :</label>
                            </div>
                            <div class="col-md-9">
                            <textarea  class="form-control" name="reason"></textarea>
                            </div>
                        </div>
                       
                     
                    </div>
                    <!-- /.box-body -->

                </div><!-- Log on to codeastro.com for more projects! -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm Rejected</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
