
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" name="faculty_id" value="{{auth()->user()->faculty->id}}" >

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-2">
                            <label><input type="radio" name="add_type" checked="checked" value="select">Select Product</label> 
                            </div> 
                            <div class="col-sm-2">
                            <label><input type="radio" name="add_type" value="add">Add New</label> 
                            </div> 
                           
                        </div>
                        <div class="form-group select_type">
                            <div class="col-md-2">
                                <label for="product_id">Product :</label>
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Product --', 'id' => 'product_id','required']) !!}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="add_new_type" style="display:none;">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="name">Item Name :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="name" name="name" value="{{ old('name') }}"
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
                                <div class="col-md-1">
                                    <label for="type">Type :</label>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('type',['fixed'=>'fixed','perishable'=>'consumed'], null, ['class' => 'form-control select', 'placeholder' => '-- Choose Type --', 'id' => 'type']) !!}
                                    <span class="help-block with-errors"></span>
                                </div>   
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
    $(document).ready(function() {
        getunit();
        getcategories();
    });

    
function getunit(){
  
  let url="{{ route('units.index') }}";
  $.ajax({
      type: "GET",
      dataType: 'json',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      url: url,
      success: function(result) {
          console.log(result.units);
          if (result) {
           
              var html_units = '';
              var html_units = '<option value="" >-- Choose Unit --</option>';
              $.each(result.units, function(key, value) {
                
              html_units += '<option   value="' + result.units[key].id + '" >' + result.units[key].name + '  </option>';
                  
              });
             
              

              $('#unit_id').html(html_units);
             
          
          }
      },
      error: function(error, jqXHR, exception) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: exception,
              // footer: '<a href="">Why do I have this issue?</a>'
          })
      }
  });
}
    function addunitForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#unit-modal-form').modal('show');
            $('#unit-modal-form form')[0].reset();
            $('.unit-modal-title').text('Add units');
        }

    $('input[name=add_type]').on('change', function() {
    
        if($("input[type='radio']:checked").val() == 'add'){
            $(".select_type").hide();
        $(".add_new_type").show();
        $(".add_new_type input").attr('required',true);
        $(".select_type input").attr('required',false);
        $("#product_id").attr('required',false);
       
        }else{

           
            $("#product_id").attr('required',true);
            $(".select_type input").attr('required',true);
            $(".add_new_type input").attr('required',false);
            $(".add_new_type").hide();
            $(".select_type").show();
        }
       
    });
    
    function submitunitform(){
                  
        var id = $('#id').val();
        // if (save_method == 'add') url = "{{ url('units') }}";
        // else url = "{{ url('units') . '/' }}" + id;
        url = "{{ url('units') }}";
        $.ajax({ 
            url : url,
            type : "POST",
            data: new FormData($("#unit-modal-form form")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                $('#unit-modal-form').modal('hide');
                getunit();
                swal({
                    title: 'Success!',
                    text: data.message,
                    type: 'success',
                    timer: '1500'
                })
            },
            error : function(data){
                swal({
                    title: 'Oops...',
                    text: data.message,
                    type: 'error',
                    timer: '1500'
                })
            }
        });
        return false;
    
          
        }

    
function getcategories(){
  
  let url="{{ route('categories.index') }}";
  $.ajax({
      type: "GET",
      dataType: 'json',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      url: url,
      success: function(result) {
          console.log(result.categories);
          if (result) {
           
              var html_categories = '';
              var html_categories = '<option value="" >-- Choose Category --</option>';
              $.each(result.categories, function(key, value) {
                
              html_categories += '<option   value="' + result.categories[key].id + '" >' + result.categories[key].name + '  </option>';
                  
              });
             
              

              $('#category_id').html(html_categories);
             
          
          }
      },
      error: function(error, jqXHR, exception) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: exception,
              // footer: '<a href="">Why do I have this issue?</a>'
          })
      }
  });
}
    function addcategoryForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#category-modal-form').modal('show');
            $('#category-modal-form form')[0].reset();
            $('.category-modal-title').text('Add category');
        }

    $('input[name=add_type]').on('change', function() {
    
        if($("input[type='radio']:checked").val() == 'add'){
            $(".select_type").hide();
        $(".add_new_type").show();
        $(".add_new_type input").attr('required',true);
        $(".select_type input").attr('required',false);
        $("#product_id").attr('required',false);
       
        }else{

           
            $("#product_id").attr('required',true);
            $(".select_type input").attr('required',true);
            $(".add_new_type input").attr('required',false);
            $(".add_new_type").hide();
            $(".select_type").show();
        }
       
    });
    
    function submitcategoryform(){
                  
        var id = $('#id').val();
        // if (save_method == 'add') url = "{{ url('units') }}";
        // else url = "{{ url('units') . '/' }}" + id;
        url = "{{ url('categories') }}";
        $.ajax({ 
            url : url,
            type : "POST",
            data: new FormData($("#category-modal-form form")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                $('#category-modal-form').modal('hide');
                getcategories();
                swal({
                    title: 'Success!',
                    text: data.message,
                    type: 'success',
                    timer: '1500'
                })
            },
            error : function(data){
                swal({
                    title: 'Oops...',
                    text: data.message,
                    type: 'error',
                    timer: '1500'
                })
            }
        });
        return false;
    
          
        }
    </script>
@endsection
                