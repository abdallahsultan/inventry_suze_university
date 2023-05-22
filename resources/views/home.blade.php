@extends('layouts.master')

@section('top')
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Log on to codeastro.com for more projects! -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ \App\User::count() }}</h3>

                <p>System Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Category::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Product::count() }}</h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ \App\Faculty::count() }}</h3>

                <p>Faculty</p>
            </div>
            <div class="icon">
            <i class="fa fa-building" aria-hidden="true"></i>

            </div>
            <a href="{{ route('faculties.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- Log on to codeastro.com for more projects! -->
<div class="box box-success">

     
        
    <div class="box-header">
        <h3 class="box-title">Item Categories</h3>
        
    </div>


    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
</div>
<div class="box box-success">

     
        
    <div class="box-header">
        {{-- <h3 class="box-title">Item Categories</h3> --}}
        
    </div>

    <div class="row">
        <div class="col-md-6">
        <canvas id="myChartcircel" style="width:100%;max-width:600px"></canvas>
        </div>
        <div class="col-md-6">
        <canvas id="myChartcircel3" style="width:100%;max-width:600px"></canvas>
        </div>
        
    </div>
    <br>
    <br>
</div>



@endsection

@section('bot')
<script src="{{  asset('assets/bower_components/chart/Chart.js') }}"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<script>
  
    const xValues = ['Jan','Feb','Mar','Apr','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    // var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    const yValues = [55, 49, 44, 24, 15];
   
    new Chart("myChart", {
    type: "line",
    
    data: {
        labels: xValues,
        datasets: [{
        data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
        title:'sultan',
        borderColor: "#67A3D9",
        fill: false
        },{
        data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
        borderColor: "#EF9BB7",
        fill: false
        },{
        data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
        borderColor: "#065182",
        fill: false
        }]
    },
    options: {
        
        legend: {display: true}
    }
    });
var xValues2 = ["chairs", "tables", "electronics", "Devices", "boards"];
    var yValues2 = [55, 49, 44, 24, 15];
    const setBg = () => {
  const randomColor = Math.floor(Math.random()*16777215).toString(16);
  const color="#"+randomColor;
  return color
}

   var color= setBg();
    var barColors2 = [
      "#b91d47",
      "#091A52",
      "#67A3D9",
      "#F8B7CD",
      "#1e7145"
    ];
    
    new Chart("myChartcircel", {
      type: "doughnut",
      data: {
        labels: xValues2,
        datasets: [{
          backgroundColor: barColors2,
          data: yValues2
        }]
      },
      options: {
        title: {
          display: true,
          text: "Total items"
        }
      }
    });
var xValues3 = ["Online", "Offline"];
    var yValues3 = [55, 49];
  
    var barColors3 = [
      "#1e7145",
      "#1114",
     
    ];
    
    new Chart("myChartcircel3", {
      type: "doughnut",
      data: {
        labels: xValues3,
        datasets: [{
          backgroundColor: barColors3,
          data: yValues3
        }]
      },
      options: {
        title: {
          display: true,
          text: "Users Is Online \ Offline"
        }
      }
    });


</script>



@endsection
