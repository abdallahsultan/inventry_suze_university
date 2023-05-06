<aside class="main-sidebar">
    <br>
    <br>
    <br>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar left_contentlist">
 
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
        <div class="itemconfiguration ">
        <ul class="sidebar-menu  "  data-widget="tree">
            <!-- <li class="header">Functions</li> -->
            <!-- Optionally, you can add icons to the links -->
            @if(auth()->user()->role == 'admin')
            <li class="nav-header "> <a href="#" style="color:#b8c7ce;"><span>Main Menu </span></a></li>
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('faculties.index') }}"><i class="fa fa-user-secret"></i> <span>Faculties</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
            @endif
            <li class="nav-header "> <a href="#" style="color:#b8c7ce;"><span>Work Space</span></a></li>
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
            <li><a href="{{ route('units.index') }}"><i class="fa fa-th-large"></i> <span>Units</span></a></li>
            @if(auth()->user()->role == 'admin')
            <li><a href="{{ route('faculties_products.index') }}"><i class="fa fa-cubes"></i> <span>All Faculties Procudcts </span></a></li>
            @endif
            <li><a href="{{ route('products.index') }}"><i class="fa fa-cubes"></i> <span>My Products</span></a></li>
            <li class="nav-header "> <a href="#" style="color:#b8c7ce;"><span>Transactions </span></a></li>
            <li><a href="#"><i class="fa fa-cubes"></i> <span>Requests</span></a></li>
            
        
        </ul>
    </div>
    <button class="btn btn-primary pull-right">Log out</button>
        
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
