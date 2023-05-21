@php $mode= App\Setting::first()  ?? null;
$mode= $mode->dark_mode ?? '0';     
$notifcations=auth()->user()->faculty->notifications->where('new',1);
$notify_count=$notifcations->count();
@endphp 
<!DOCTYPE html>
<html>

<head>
    <!-- Log on to codeastro.com for more projects! -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/v2/css/bootstrap.min.css ')}}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.css ')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">

    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.css')}} ">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-custom.css')}} ">
    <style>
        .notification:after {
            content: "";
            display: block;
            position: absolute;
            width: 10px;
            height: 10px;
            background: red;
            top: 0;
            right: 0;
            border-radius: 50%;
        }
      .mode {
            /* float:right; */
        }
      .mode-sidebar {
            /* float:right; */
        }
        .change {
            cursor: pointer;
            border: 1px solid #555;
            border-radius: 40%;
            width: 20px;
            text-align: center;
            padding: 5px;
            margin-left: 8px;
        }
        .dark{
            background-color: #222 !important;
            color: #e6e6e6 !important;
            
        }
        .dark-sidebar{
            background-color: #8d8d8d  !important;
            color: #070707 !important;
            
        }
        .dark-sidebar li{
            background-color: #8d8d8d  !important;
            color: #070707 !important;
            
        }
        .filter_section{
            border: 2px solid #065182;
            border-radius: 12px;
            /* background: #065182; */
            background:  linear-gradient(155deg, rgb(98 156 225 / 61%) 41%, rgb(166 198 236 / 58%) 56%, rgb(238 174 202 / 53%) 100%);
            color: #fff;
            width: 75%;
            margin: 1%;
            left: 10%;
            position: relative;

        }
        th {text-align:center}
        /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }
        thead{
            background: #b9c8d1;
            color: #065182;
            height: 58px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #065182;
        border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #065182;
        border-radius: 10px;
        }
      .logout
        {       
                /* height:10%; */
                width:215px;
                /* background-color:#CCC; */		
                /* overflow-y:auto; */
                float:left;
                position:relative;
                /* margin-left:-5px; */
        }
      .itemconfiguration
        {
                height:435px;
                width:215px;
                /* background-color:#CCC; */		
                overflow-y:auto;
                float:left;
                position:relative;
                /* margin-left:-5px; */
        }
        .left_contentlist{
        width:215px;
        float:left;
        padding:0 0 0 5px;
        position:relative;
        float:left;
        /* border-right: 1px #f8f7f3 solid; */
        /* background-image:url(images/bubble.png); */
        /* background-color: black; */
        }
       
        
        </style>

    @yield('top')

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini mode">
    <div class="wrapper mode">

        <!-- Main Header -->
        <header class="main-header mode">

            <!-- Logo -->
            <a href="{{route('home')}}" class="logo mode">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ asset('assets/img/inner-logo.png') }}"
                        style="padding: 2%; width: 26%;border-radius: 20%;" alt="Inventory"><b>Inventory</b> <br><br></span>
            </a>
           
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top mode" role="navigation" >
                
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="col-md-3 nav navbar-nav  ">
                   
                    <div class="user-panel"  data-toggle="dropdown">
                        
                        <div class="pull-left image ">
                            <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info mode">
                            
                            <p>{{ \Auth::user()->name  }}   </p>
                            <!-- Status -->
                            <!-- <a href="#" style="color: #000;margin: 25px;"><i class="fa fa-circle text-success"></i> Online</a> -->
                            <a href="#" class="mode"> <b>{{ \Auth::user()->email  }} </b></a>
                           
                        </div>
                        
                        <div class="pull-right image">
                            <p>  <i class="fa fa-chevron-down" aria-hidden="true"></i></p>
                        </div>
                        
                      
                    </div>

                      
                   
                            <!-- Menu Toggle Button -->
                          
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="" style="text-align: center">
                                    <img src="{{ asset('user-profile.png') }} " class="img-circle" style="width: 32%;    background: black;" alt="User Image">

                                    <!-- <p>
                                        {{ \Auth::user()->name  }}
                                        <small>{{ \Auth::user()->email  }}</small>
                                    </p> -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer" style="padding:5%;">
                                    {{--<div class="pull-left">--}}
                                    {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                    {{--</div>--}}
                                    <div class="" style="text-align: center" >
                                        <a class="btn btn-outline-info" href="{{route('edit.profile')}}">
                                            Profile
                                        </a>
                                        <a class="btn btn-outline-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                       

                </div>
               
                <div class="col-md-4 " style=" border-left: 2px solid #0005;">
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                        <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                                </button>
                            </span>
                            <input type="text" name="q" dir="ltr" class="form-control" placeholder="Search...">
                            
                        </div>
                    </form>
                </div>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- User Account Menu -->
                   <!-- <li class="dropdown user user-menu">
                           
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               
                                <img src="{{ asset('user-profile.png') }}" class="user-image" alt="User Image">
                              
                                <span class="hidden-xs">{{ \Auth::user()->name  }}</span>
                            </a>
                            <ul class="dropdown-menu">
                            
                                <li class="user-header">
                                    <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">

                                    <p>
                                        {{ \Auth::user()->name  }}
                                        <small>{{ \Auth::user()->email  }}</small>
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                    {{--<div class="pull-left">--}}
                                    {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                    {{--</div>--}}
                                    <div class="pull-right">
                                        <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li> -->
                       
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                        <a href="#" class="mode" onclick="myFunction()"  data-toggle="control-sidebar"><i class="fa fa-moon-o" style="font-size: 25px;" aria-hidden="true"></i></a>
                       </li>
                        <li>
                        <a href="#" class="mode" style="border-left: 2px solid #0005;" data-toggle="dropdown"><i class="fa fa-bell-o @if($notify_count > 0) notification @endif" style="font-size: 25px;" aria-hidden="true">  </i></a>
                        <ul class="dropdown-menu" style="width: fit-content;">
                            <!-- The user image in the menu -->
                            @if($notify_count > 0)
                            @foreach($notifcations as $notify)
                            <li ><a href="{{ route('requests.index_received') }}"><i class="fa fa-bell-o "></i> {{$notify->body}}</a></li>
                            @endforeach
                            @else
                            <li ><a href="#">---- Empty ----</li>
                            @endif
                           
                           
                        </ul>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <div class="content-wrapper mode">
            <section class="content container-fluid " style="color:#070707 !important">

                @yield('content')


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer mode">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Developed by Suez University Students
            </div>
            <!-- Default to the left -->
            <?php $date = date('Y')?>
            <strong>&copy; {{$date}} - Inventory Management System </strong>
        </footer>

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
   
    <!-- AdminLTE App -->
    <script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>

    @yield('bot')
    
		
@if(session()->has('success'))
		
		<script>
			// swal("Good job!", "asfasfasfas", "success");
            alert('error_page4')
swal({
position: 'top-end',
icon: 'success',
title: '<?php echo session()->get('success') ?>',
showConfirmButton: false,
timer: 1500
})

   </script>

@endif
		
@if(session()->has('message'))
		
		<script>
			// swal("Good job!", "asfasfasfas", "success");
            swal({
                    title: 'Success!',
                    text: '<?php echo session()->get('message') ?>',
                    type: 'success',
                    timer: '1500'
                })


   </script>

@endif
@if(session()->has('error'))
		
		<script>
			// swal("Good job!", "asfasfasfas", "success");
            swal({
                            title: 'Oops...',
                            text: '<?php echo session()->get('error') ?>',
                            type: 'error',
                            timer: '2000'
                        })


   </script>

@endif
@if(session()->has('error_page'))
		
		<script>
            alert('error_page')
			// swal("Good job!", "asfasfasfas", "success");
swal({
  icon: 'error',
  title: 'Oops...',
  text: '<?php echo session()->get('error_page') ?>',
//   footer: '<a href="">Why do I have this issue?</a>'
})

   </script>

@endif

<script>
   
    var mode="{{$mode}}" ;
    var m = $("meta[name=csrf-token]");    
    var csrf_token =m.attr("content");
// alert(m.attr("content"));
  $( document ).ready(function() {
    if(mode == 1){
        changetheme();
    }
   
  });
       
    function myFunction() {
        $.ajax({
                    url : "{{ url('settings') }}",
                    type : "POST",
                    data : {'_token' :csrf_token },
                    success : function(data) {
                        table.ajax.reload();
                        // swal({
                        //     title: 'Success!',
                        //     text: data.message,
                        //     type: 'success',
                        //     timer: '1500'
                        // })
                    },
                    error : function () {
                        // swal({
                        //     title: 'Oops...',
                        //     text: data.message,
                        //     type: 'error',
                        //     timer: '1500'
                        // })
                    }
                });
    
                changetheme();
    // element2.toggle("dark");
    }
    function changetheme(){
        var element = document.body;
    var element2 = document.getElementsByClassName("mode");;
    $('.mode').toggleClass('dark');
    // $('.mode-sidebar').toggleClass('dark-sidebar');
    // $("#canvas-wrapper").toggleClass("dark-mode");
    element.classList.toggle("dark");
    }

</script>
</body>

</html>