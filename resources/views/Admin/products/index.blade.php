@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

      
        <div class="box-header">
            <h3 class="box-title">List of  ALl Products </h3>

            <a  href="{{ route('faculties_products.create') }}" class="btn btn-outline-primary pull-right" style="margin-top: -8px;"><i class="fa fa-plus"></i> Add Products</a>
            {{-- <a onclick="addForm()" class="btn btn-outline-primary pull-right" style="margin-top: -8px;"><i class="fa fa-plus"></i> Add Products</a> --}}
        </div>


    </div>
    
        <!-- /.box-header -->
    <div class="box-body filter_section">
        <div class="form-group">
          
            <div class="col-md-3">
                <label for="name">Item ID :</label>
                <input type="number" class="form-control"
                    id="kt_datatable_search_query0" name="id" 
                    placeholder="Item ID">
               
            </div>
            <div class="col-md-3">
                <label for="name">Item Name :</label>
                <input type="text" class="form-control"
                    id="kt_datatable_search_query" name="name" 
                    placeholder="Name">
                
            </div>
      
            <div class="col-md-3">
                <label for="faculty_id">Category:</label>
                
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'kt_datatable_search_query1', 'required']) !!}
                <span class="help-block with-errors"></span>
            </div>
            
           
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box box-success">


        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>type.</th>
                    <th>Total Qty</th>
                    {{-- <th>Monitor inventory auto</th>
                    <th>Minimum Qty</th> --}}
                    <th>Unit</th>
                    <th>Category</th>
                    <th>Barcode</th>
                    <th>Desciption</th>
                  
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('Admin.products.form_edit')
    @include('products.unitform')
    @include('products.categoryform')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script type="text/javascript">
        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.faculties_products') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'all_qty', name: 'all_qty'},
                // {data: 'monitor_inventory_auto', name: 'monitor_inventory_auto'},
                // {data: 'minimum_qty', name: 'minimum_qty'},
                // {data: 'show_photo', name: 'show_photo'},
                {data: 'unit_name', name: 'unit_name'},
                {data: 'category_name', name: 'category_name'},
                {data: 'barcode', name: 'barcode'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action',orderable: false, searchable: false}
            ]
        });

              
$('#kt_datatable_search_query1').change(function() {
    if($('#kt_datatable_search_query1 option:selected').html() == '-- Choose Category --'){
        $('#products-table').DataTable().column(5).search('').draw();
    }else{
        $('#products-table').DataTable().column(5).search($('#kt_datatable_search_query1 option:selected').html()).draw();

    }

});
$('#kt_datatable_search_query').keyup(function() {
  
    $('#products-table').DataTable().column(1).search($(this).val()).draw();

});
$('#kt_datatable_search_query0').keyup(function() {
  
    $('#products-table').DataTable().column(0).search($(this).val()).draw();

});


        function addForm() {
            save_method = "add";
            $('#product-update-form-item input[name=_method]').val('POST');
            $('#product-update-modal-form').modal('show');
            $('#product-update-modal-form form')[0].reset();
            $('.product-update-modal-title').text('Add Products');
        }

        function editForm(id) {
            save_method = 'edit';
            $('#product-update-form-item input[name=_method]').val('PATCH');
            $('#product-update-modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('faculties_products') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#product-update-modal-form').modal('show');
                    $('.product-update-modal-title').text('Edit Product');

                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#barcode').val(data.barcode);
                    $('#description').html(data.description);
                    $('#type').val(data.type);
                  
                    $('#category_id').val(data.category_id);
                    $('#unit_id').val(data.unit_id);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('faculties_products') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#product-update-modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                   url = "{{ url('faculties_products') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#product-update-modal-form form').serialize(),
                        data: new FormData($("#product-update-modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#product-update-modal-form').modal('hide');
                            table.ajax.reload();
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
            });
        });



        // =====================================================================

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
              var html_units = '<option  value="">-- Choose Unit --</option>';
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
            $('#unit-modal-form input[name=_method]').val('POST');
            $('#unit-modal-form').modal('show');
            $('#unit-modal-form form')[0].reset();
            $('.unit-modal-title').text('Add units');
        }

    
    function submitunitform(){
                  
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
            $('#category-modal-form input[name=_method]').val('POST');
            $('#category-modal-form').modal('show');
            $('#category-modal-form form')[0].reset();
            $('.category-modal-title').text('Add category');
        }


    
    function submitcategoryform(){
                  
 
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
