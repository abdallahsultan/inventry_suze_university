@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="modal-header">
            <h3 class="box-title">Add Product to any store </h3>

        </div>


        <!-- /.box-header -->
        <form  id="form-item" method="post" action="{{ route('faculties_products.store') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
            {{ csrf_field() }} {{ method_field('POST') }}
        @include('Admin.products.form')
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Add New</button>
            </div>

        </form>

        
        <!-- /.box-body -->
    </div>

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
            ajax: "{{ route('api.products') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                // {data: 'harga', name: 'harga'},
                {data: 'qty', name: 'qty'},
                {data: 'show_photo', name: 'show_photo'},
                {data: 'category_name', name: 'category_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Products');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('products') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Products');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#harga').val(data.harga);
                    $('#qty').val(data.qty);
                    $('#category_id').val(data.category_id);
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
                    url : "{{ url('products') }}" + '/' + id,
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
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('products') }}";
                    else url = "{{ url('products') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
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
