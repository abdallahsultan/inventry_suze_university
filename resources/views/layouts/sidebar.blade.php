<aside class="main-sidebar">
    <br>
    <br>
    <br>

    <!-- sidebar: style can be found in sidebar.less -->
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
        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header">Functions</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li class="nav-header"> <a href="#" style="color:#b8c7ce;"><span>Main Menu </span></a></li>
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('faculties.index') }}"><i class="fa fa-user-secret"></i> <span>Faculties</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>Create Users</span></a></li>
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>Category</span></a></li>
            <li><a href="{{ route('products.index') }}"><i class="fa fa-cubes"></i> <span>Product</span></a></li>
            <!-- <li><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customer</span></a></li>
            <li class="nav-header">Main Menu</li>
            <li><a href="{{ route('sales.index') }}"><i class="fa fa-cart-plus"></i> <span>Penjualan</span></a></li>
            <li><a href="{{ route('suppliers.index') }}"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
            <li><a href="{{ route('productsOut.index') }}"><i class="fa fa-minus"></i> <span>Outgoing Products</span></a></li>
            <li><a href="{{ route('productsIn.index') }}"><i class="fa fa-cart-plus"></i> <span>Purchase Products</span></a></li> -->








        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
