
<div class="modal fade" id="product-update-modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <form  id="product-update-form-item" method="PATCH" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('PATCH') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="product-update-modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="name">Item Name :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus
                                    placeholder="Name">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                      
                            <div class="col-md-1">
                                <label for="faculty_id">Category:</label>
                            </div>
                            <div class="col-md-4">
                                
                                {!! Form::select('category_id',[], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                            <a href="#" onclick="addcategoryForm()"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                           
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="type">Type :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('type',['fixed'=>'fixed','perishable'=>'consumed'], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Type --', 'id' => 'type']) !!}
                                <span class="help-block with-errors"></span>
                            </div>   
                            <div class="col-md-1">
                                <label for="unit_id">Unit :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('unit_id',[], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Unit --', 'id' => 'unit_id']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                          
                            <a onclick="addunitForm()"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                            
                            
                        </div>
                       
                       
                       
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="quantity">Barcode :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}"
                                    id="barcode" name="barcode" value="{{ old('barcode') }}" 
                                    placeholder="barcode">
                                @if ($errors->has('barcode'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('barcode') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="minimum_quantity">Desciption :</label>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    id="description" name="description" placeholder="Desciption"></textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
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
                

              
                <script>
            
                    function ShowPrompt(isChecked) {
                        if(isChecked){
                            this.val(1);
                        }else{
                            this.val(0);

                        }
                    }

                    
                </script>