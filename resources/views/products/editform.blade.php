
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" name="faculty_id" value="{{auth()->user()->faculty->id}}" >

                    <div class="box-body">
                        <div class="form-group">
                            
                            <div class="col-sm-2">
                            <label><input type="radio" name="q_type"  value="in"> Increase</label> 
                            </div> 
                            <div class="col-sm-2">
                            <label><input type="radio" name="q_type" value="out"> Decrease</label> 
                            </div> 
                            <div class="col-sm-5">
                            <label><input type="radio" name="q_type" checked="checked" value="none"> Update Minimum Quantity Or  Monitor inventory quantity  Only</label> 
                            </div> 
                           
                        </div>
                        
                        {{-- <div class="add_new_type" style="display:none;">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="name">Item Name :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="name" name="name" value="{{ $product->name ?? old('name') }}"
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
                                    
                                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id']) !!}
                                    <span class="help-block with-errors"></span>
                                </div>
                                <a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                            
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
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
                                    {!! Form::select('type',['fixed'=>'fixed','preishable'=>'consumed'], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Type --', 'id' => 'type']) !!}
                                    <span class="help-block with-errors"></span>
                                </div>   
                            </div>
                        </div> --}}
                        <div class="form-group quantity" style="display:none; ">
                            <div class="col-md-2">
                                <label id="increase_decrease"></label>
                                <label for="qty">Sum quantities ({{$product->qty}}) :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    id="qty" name="qty" value="{{  old('qty') }}" 
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
                                <input id="showprompt monitor_inventory_auto" type="checkbox"  name="monitor_inventory_auto" value="1" @if($product->my_monitor_inventory_auto) checked="checked" @endif  onclick="ShowPrompt(this.checked)" />
                                <label for="monitor_inventory_auto"> Monitor inventory quantity automatically</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="minimum_qty">Minimum Quantity :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control{{ $errors->has('minimum_qty') ? ' is-invalid' : '' }}"
                                    id="minimum_qty" name="minimum_qty" value="{{$product->my_minimum_qty?? old('minimum_qty') }}" 
                                    placeholder="minimum_quantity">
                                @if ($errors->has('minimum_qty'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Minimum Quantity') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group add_new_type" style="display:none">
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
@section('bot')
              
    <script>

    // function ShowPrompt(isChecked) {
    //         if(isChecked){
    //             this.val(1);
    //         }else{
    //             this.val(0);

    //         }
    //     }

    $('input[name=q_type]').on('change', function() {
     
        if($("input[type='radio']:checked").val() == 'in'){
            
            $("#increase_decrease ").html('Increase Qty :');
            $(".quantity ").show();
            $(".quantity input").attr('required',true);
    
       
        }
        else if($("input[type='radio']:checked").val() == 'out')
        {
            $("#increase_decrease ").html('Decrease Qty :');
            $(".quantity ").show();
            $(".quantity input").attr('required',true);
        }else{

            $("#increase_decrease ").html('');
            $(".quantity ").hide();
            $(".quantity input").attr('required',false);
          
        }
       
    });
    
        
    </script>
@endsection
                