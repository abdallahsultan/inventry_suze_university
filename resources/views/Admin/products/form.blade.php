
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
                                
                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id', 'required']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                            <a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                           
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="faculty_id">Store :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('faculty_id', $faculties, null, ['class' => 'form-control select', 'placeholder' => '-- Choose faculty --', 'id' => 'faculty_id']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="col-md-1">
                                <label for="unit_id">Unit :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('unit_id', $units, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Unit --', 'id' => 'unit_id']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                            <a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                            
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
                            <div class="col-md-1">
                                <label for="type">Type :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('type',['fixed'=>'fixed','perishable'=>'consumed'], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Type --', 'id' => 'type']) !!}
                                <span class="help-block with-errors"></span>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="qty">quantity :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    id="qty" name="qty" value="{{ old('qty') }}" 
                                    placeholder="qty">
                                @if ($errors->has('qty'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('qty') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 offset-1">
                                <input id="showprompt monitor_inventory_auto" type="checkbox"  name="monitor_inventory_auto" value="1"  onclick="ShowPrompt(this.checked)" />
                                <label for="monitor_inventory_auto"> Monitor inventory quantity automatically</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="minimum_qty">Minimum Quantity :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('minimum_qty') ? ' is-invalid' : '' }}"
                                    id="minimum_qty" name="minimum_qty" value="{{ old('minimum_qty') }}" 
                                    placeholder="minimum_quantity">
                                @if ($errors->has('minimum_qty'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Minimum Quantity') }}</strong>
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

              
                <script>
            
                    function ShowPrompt(isChecked) {
                        if(isChecked){
                            this.val(1);
                        }else{
                            this.val(0);

                        }
                    }
                </script>