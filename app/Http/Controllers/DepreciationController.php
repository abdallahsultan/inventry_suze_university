<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Product;
use App\Depreciation;
use App\ProductQuntity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepreciationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Depreciation::all();
        $products = Product::orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        $faculties = Faculty::orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        return view('depreciation.index',compact('requests','products','faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'   => 'required',
            'qty'   => 'required',
            'date'   => 'required',
            'reason'   => 'required',
         ]);
         $data=[];
         
         $product =Product::find($request->product_id); 
         
         if($product->qty == null || $product->qty < $request->qty){
           if(!$product->qty){
            return response()->json([
                'success'    => false,
                'message'    => 'not have this product'
             ]);
           }
           return response()->json([
            'success'    => false,
            'message'    => 'not have this qty of product'
          ]);
         }   
         $input_product_qty=[
            'product_id'=>$product->id,
            'faculty_id'=>auth()->user()->faculty->id,
            'qty'=>$request->qty,
            'monitor_inventory_auto'=> $product->my_monitor_inventory_auto,
            'minimum_qty'=>$product->my_minimum_qty,
            'type'=>'out',
            'main'=>0,
           ];
          
         $product_qty= ProductQuntity::create($input_product_qty);

         $data['product_id']=$product->id;
         $data['product_name']=$product->name;
         $data['faculty_id']=auth()->user()->faculty->id;
         $data['qty']=$request->qty;
         $data['reason']=$request->reason;
         $data['date']=$request->date;
       
         Depreciation::create($data);
        //  return $data;
         return response()->json([
            'success'    => true,
            'message'    => 'deprecition product Created'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Depreciation  $depreciation
     * @return \Illuminate\Http\Response
     */
    public function show(Depreciation $depreciation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Depreciation  $depreciation
     * @return \Illuminate\Http\Response
     */
    public function edit(Depreciation $depreciation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Depreciation  $depreciation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depreciation $depreciation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depreciation  $depreciation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depreciation $depreciation)
    {
        // $depreciation =Depreciation::find($id);
        $product =Product::find($depreciation->product_id); 
         
        $input_product_qty=[
           'product_id'=>$product->id,
           'faculty_id'=>auth()->user()->faculty->id,
           'qty'=>$depreciation->qty,
           'monitor_inventory_auto'=> $product->my_monitor_inventory_auto,
           'minimum_qty'=>$product->my_minimum_qty,
           'type'=>'in',
           'main'=>0,
          ];
         
        $product_qty= ProductQuntity::create($input_product_qty);

        $depreciation->delete();

        return response()->json([
            'success'    => true,
            'message'    => 'qty of product returned'
        ]);
    }


    public function apiDepreciations()
    {
        
        $user=auth()->user();
        $faculty_id=$user->faculty->id;
        $Depreciation = Depreciation::where('faculty_id',$faculty_id)->get();
  
        return Datatables::of($Depreciation)
            // ->addColumn('status', function($requests){
               
            //     return $requests->;
            // })
         
            ->addColumn('action', function($Depreciation){
               
                return '<a onclick="deleteData('. $Depreciation->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-close"></i> Cancel</a>';
            })
            ->rawColumns(['action','senter_stock'])->make(true);
    }

    public function exportDepreciationsAll()
    {
        $faculties = Depreciation::all();
        $pdf = PDF::loadView('faculties.facultiesAllPDF',compact('faculties'));
        return $pdf->download('faculties.pdf');
    }

    public function exportExcel()
    {
        return (new ExportDepreciations())->download('Depreciations.xlsx');
    }
}
