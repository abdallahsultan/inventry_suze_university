 <div class="modal fade" id="unit-modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form  id="unit-form-item" method="post" class="form-horizontal"  data-toggle="validator"  enctype="multipart/form-data" >
                                {{ csrf_field() }} {{ method_field('POST') }}
                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h3 class="unit-modal-title"> Add Unit</h3>
                                </div>
                
                
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id">
                
                
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label >Name</label>
                                            <input type="text" class="form-control" id="name" name="name"  autofocus required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                
                                </div><!-- Log on to codeastro.com for more projects! -->
                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                    {{-- <button type="submit" class="btn btn-success">new</button> --}}
                                    <a onclick="submitunitform()" class="btn btn-success">new</a>
                                </div>
                
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
