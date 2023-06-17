@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        
        
        <div class="box-header">
            <h3 class="box-title">List of requests for ({{auth()->user()->faculty->name}} )</h3>
            <a onclick="addForm()" class="btn btn-outline-primary pull-right " style="margin-right:5px " ><i class="fa fa-plus"></i> Add Request</a>
            <a href="{{ route('exportPDF.requestsAll') }}" class="btn btn-outline-danger pull-right" style="margin-right:5px "><i class="fa fa-file-pdf-o"></i> Export PDF</a>
            <a href="{{ route('exportExcel.requestsAll') }}" class="btn btn-outline-success pull-right" style="margin-right:5px"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="requests-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Reciver</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div><!-- Log on to codeastro.com for more projects! -->

    @include('requests.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

     <!-- Validator  -->
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>


    <script type="text/javascript">
        var table = $('#requests-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.requests') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'product_name', name: 'product_name'},
                {data: 'qty', name: 'qty'},
                {data: 'receiver_stock', name: 'receiver_stock'},
                {data: 'details', name: 'details'},
                {data: 'senter_status', name: 'senter_status'},
                {data: 'reason', name: 'reason'},
                {data: 'action', name: 'action',width:"150px", orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add requests');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('requests') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit requests');

                    $('#id').val(data.id);
                    $('#name').val(data.name);
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
                    url : "{{ url('requests') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('requests') }}";
                    else url = "{{ url('requests') . '/' }}" + id;

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
        function addFormrecieved(id){
           
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "the required quantity has already arrived?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Recieved it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('/requests/senter/confirm') }}",
                    type : "POST",
                    data : {'_method' : 'POST', '_token' : csrf_token,'id': id},
                    success : function(data) {
                        table.ajax.reload();

                        if(data.success){

                        
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    }else{
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
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

        function cancelData(id){
            
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Canceld it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('/requests/senter/cancel') }}",
                    type : "POST",
                    data : {'_method' : 'POST', '_token' : csrf_token,'id': id},
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

        
    </script>

@endsection
