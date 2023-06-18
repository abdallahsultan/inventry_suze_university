@extends('layouts.master')

@section('top')
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Log on to codeastro.com for more projects! -->
    @if(auth()->user()->role == 'admin')
    <div class="col-md-3" style="width:24% !important">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $user_count}}</h3>

                <p>System Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    <!-- ./col -->
    <div class="col-md-3" style="width:24% !important">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $category_count }}<sup style="font-size: 20px"></sup></h3>

                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-md-3" style="width:24% !important">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $product_count }}</h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @if(auth()->user()->role == 'admin')
    <div class="col-md-3" style="width:24% !important">
       
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $faculty_count}}</h3>

                <p>Faculty</p>
            </div>
            <div class="icon">
            <i class="fa fa-building" aria-hidden="true"></i>

            </div>
            <a href="{{ route('faculties.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    <!-- ./col -->
</div>
<!-- Log on to codeastro.com for more projects! -->
<div class="box box-success">

     
        
    <div class="box-header">
        <h3 class="box-title">Item Categories</h3>
        
    </div>


    <canvas id="myChart" style="width:100%;max-width:900px"></canvas>
</div>
<div class="box box-success">

     
        
    <div class="box-header">
        {{-- <h3 class="box-title">Item Categories</h3> --}}
        
    </div>

    <div class="row">
        <div class="col-md-6">
        <canvas id="myChartcircel" style="width:100%;max-width:600px"></canvas>
        </div>
        @if(auth()->user()->role == 'admin')
        <div class="col-md-6">
        <canvas id="myChartcircel3" style="width:100%;max-width:600px"></canvas>
        </div>
        @endif
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
    const setBg = () => {
  const randomColor = Math.floor(Math.random()*16777215).toString(16);
  const color="#"+randomColor;
  return color
}

   
    // const xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
    var monthes ="{{$monthes}}";
    var chart_yValues ="{{$chart_yValues}}";
    monthes = JSON.parse(monthes.replace(/&quot;/g,'"'));
   
    const xValues=monthes;
    const datasets = [];
    // var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    $.each(JSON.parse(chart_yValues.replace(/&quot;/g,'"')), function( index, value ) {
      var color= setBg();
    
      var data= {
        label:index,
        data: Object.values(value),
        borderColor: color,
        borderText: color,
        fill: false
      }
      datasets.push(data);

    });
   
    new Chart("myChart", {
    type: "line",
    
    data: {
        labels: xValues,
        datasets:datasets
    },
    options: {
        legend: {
          display: true
        }
    }
    });

    var dt_xValues2 ="{{$chart2_yValues2}}";
    dt_xValues2 = JSON.parse(dt_xValues2.replace(/&quot;/g,'"'));
    xValues2 = Object.keys(dt_xValues2);
   
    var yValues2 =  Object.values(dt_xValues2);
  
    var barColors2 = [
      "#b91d47",
      "#091A52",
      "#67A3D9",
      "#F8B7CD",
      "#F8B7eD",
      "#F8B7qD",
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
var xValues3 = ["Online {{$user_online}}", "Offline {{$user_offline}}"];
    var yValues3 = ["{{$user_online}}", "{{$user_offline}}"];
  
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
          text: "Users Is Online / Offline All ( {{$user_count}} )"
        }
      }
    });


</script>



@endsection
