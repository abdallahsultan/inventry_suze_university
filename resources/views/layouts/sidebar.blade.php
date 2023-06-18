<aside class="main-sidebar mode-sidebar">
    <br>
 

    <!-- sidebar: style can be found in sidebar.less -->
    {{-- <section class="sidebar left_contentlist"> --}}
        <section class="sidebar">
 
        <!-- Sidebar user panel (optional) -->
      
        <!-- Log on to codeastro.com for more projects! -->
        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        {{-- <div class="itemconfiguration "> --}}
        <div class=" ">
            <ul class="sidebar-menu "  data-widget="tree">
                <!-- <li class="header">Functions</li> -->
                <!-- Optionally, you can add icons to the links -->
                <li class="nav-header "> <a href="#" style="color:#b8c7ce;"><span>Main Menu </span></a></li>
                <li class="{{ Route::is('home') ? 'active' : '' }}"><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                @if(auth()->user()->role == 'admin')
                <li class="{{ Route::is('faculties.index') ? 'active' : '' }}"><a href="{{ route('faculties.index') }}"><i class="fa fa-user-secret"></i> <span>Faculties</span></a></li>
                <li class="{{ Route::is('user.index') ? 'active' : '' }}"><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                @endif
                <li class="nav-header  "> <a href="#" style="color:#b8c7ce;"><span>Work Space</span></a></li>
                <li class="{{ Route::is('categories.index') ? 'active' : '' }}"><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
                <li class="{{ Route::is('units.index') ? 'active' : '' }}"><a href="{{ route('units.index') }}"><i class="fa fa-th-large"></i> <span>Units</span></a></li>
                @if(auth()->user()->role == 'admin')
                <li class="{{ Route::is('faculties_products.index') ? 'active' : '' }}"><a href="{{ route('faculties_products.index') }}"><i class="fa fa-cubes"></i> <span>All Faculties Procudcts </span></a></li>
                @endif
                <li class="{{ Route::is('products.index') ? 'active' : '' }} "><a href="{{ route('products.index') }}"><i class="fa fa-cubes"></i> <span>My Products</span></a></li>
                <li class="{{ Route::is('depreciations.index') ? 'active' : '' }}"><a href="{{ route('depreciations.index') }}"><i class="fa fa-trash" aria-hidden="true"></i><span>Depreciations</span></a></li>
                <li class="nav-header "> <a href="#" style="color:#b8c7ce;"><span>Transactions </span></a></li>
                <li class="{{ Route::is('products.inquiries') ? 'active' : '' }}"><a href="{{ route('products.inquiries') }}"><i class="fa fa-cubes"></i> <span>Product inquiries</span></a></li>
                <li class="{{ Route::is('requests.index') ? 'active' : '' }}"><a href="{{ route('requests.index') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Sent Requests</span></a></li>
                <li class="{{ Route::is('requests.index_received') ? 'active' : '' }}  "><a href="{{ route('requests.index_received') }}" class=""><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Recived Requests  </span> @if($notify_count > 0) <i style="color:red;" class="fa fa-circle" aria-hidden="true"></i>  @endif </a></li>
            
                
            </ul>
        
        </div>
       
       <div class="logout  sidebar-menu "   data-widget="tree">
        <hr>
         <form id="logout-form" action="{{ route('logout') }}" method="POST"
            style="display: none;">
            @csrf
        </form>
        
        <li class="{{ Route::is('requests.index') ? 'active' : '' }}"><a  href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out" aria-hidden="true"></i><span>Log out</span></a></li>
           
        </div>
        {{-- <hr>
        <li><a href="#" class="text-center"><i class="fa fa-cubes"></i> <span>Log out</span></a></li> --}}

   
    
        
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
