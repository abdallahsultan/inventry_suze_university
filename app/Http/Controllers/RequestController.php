<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Product;
use Carbon\Carbon;
use App\RequestModel;
// use Symfony\Component\HttpFoundation\Request;
use App\ProductQuntity;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = RequestModel::where('senter_stock',auth()->user()->faculty->id)->get();
        $products = Product::orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        $faculties = Faculty::where('id','!=',auth()->user()->faculty->id)->orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        
        return view('requests.index',compact('requests','products','faculties'));
    }
    public function index_received()
    {

        $requests = RequestModel::where('receiver_stock',auth()->user()->faculty->id)->get();
        $products = Product::orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        $faculties = Faculty::orderBy('name','ASC')
                            ->get()
                            ->pluck('name','id');
        auth()->user()->faculty->notifications()->update(['new'=>0]);
        return view('requests.received',compact('requests','products','faculties'));
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
            'faculty_id'   => 'required',
            'product_id'   => 'required',
            'qty'   => 'required',
         ]);
         $data=[];
         
         $product =Product::find($request->product_id);
         $faculty =Faculty::find($request->faculty_id);
         $senter_stock =auth()->user()->faculty;
       
         $data['product_id']=$product->id;
         $data['product_name']=$product->name;
         $data['qty']=$request->qty;
         $data['senter_stock']=(int)$senter_stock->id;
         $data['receiver_stock']=(int)$request->faculty_id;
         $data['details']=$senter_stock->name .' want '.$request->qty .' of product '. $product->name . ' from '. $faculty->name ;
         $data['create_by_user_id']=auth()->user()->id;
         $data['create_by_user_name']=auth()->user()->name;
       
        //  dd( $faculty->notification()->create(['body'=>$data['details']]));
        
        $requestModel=RequestModel::create($data);
        $faculty->notifications()->create(['product_id'=>$product->id,'body'=>$data['details'],'date'=>Carbon::now()]);
        //  return $data;
         return response()->json([
            'success'    => true,
            'message'    => 'Request Created'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestModel $RequestModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestModel $RequestModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function apiReceivedRequests()
    {
        
        $user=auth()->user();
        $faculty_id=$user->faculty->id;
        $requests = RequestModel::where('receiver_stock',$faculty_id);
  
        return Datatables::of($requests->orderBy('id', 'DESC'))
            // ->addColumn('status', function($requests){
               
            //     return $requests->;
            // })
            ->addColumn('receiver_status', function($requests){
               if($requests->receiver_status == 'not_received'){
                return 'Not Receied';
               }elseif($requests->receiver_status == 'received'){
                 return 'Received';
               } else{
                return 'Canceld';
               }          
             })
            ->addColumn('senter_stock', function($requests){
               
                return $requests->senterstock->name ?? 'Deleted Faculty';
            })
            ->addColumn('action', function($requests){
               if($requests->senter_status =='pending' && $requests->receiver_status !='canceled'){
                return '<a onclick="addFormConfirm('. $requests->id .')" class="btn btn-outline-success btn-xs"><i class="glyphicon glyphicon-close"></i> Confirm</a>'
                 . ' <a onclick="addFormCancel('. $requests->id .')" class="btn btn-outline-danger btn-xs"><i class="glyphicon glyphicon-close"></i> Reject</a>';
               }else{
                return '-----';
                // return '<a href="#" disabled class="btn btn-outline-dark btn-md">'.$requests->senter_status.'</a>';
               }
            })
            ->rawColumns(['action','senter_stock'])->make(true);
    }

    public function apiRequests()
    {
        $user=auth()->user();
        $faculty_id=$user->faculty->id;
        $requests = RequestModel::where('senter_stock',$faculty_id)->orderBy('id', 'DESC');
       
        return Datatables::of($requests)
            // ->addColumn('status', function($requests){
               
            //     return $requests->;
            // })
           
            ->addColumn('receiver_stock', function($requests){
               
                return $requests->receiverstock->name ?? 'Deleted Faculty';
            })
            ->addColumn('action', function($requests){
                if($requests->receiver_status =='not_received' && $requests->senter_status =='done'){
                    return '<a onclick="addFormrecieved('. $requests->id .')" class="btn btn-outline-primary btn-xs"><i class="glyphicon glyphicon-close"></i> Recieved</a>';
                   }elseif($requests->senter_status =='pending' && $requests->receiver_status != 'canceled' ){
                    return ' <a onclick="cancelData('. $requests->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-close"></i> Cancel</a>';
                    // return '<a href="#" disabled class="btn btn-outline-dark btn-md">'.$requests->senter_status.'</a>';
                   }elseif($requests->receiver_status =='canceled' ){
                    return $requests->receiver_status ;
                    // return '<a href="#" disabled class="btn btn-outline-dark btn-md">'.$requests->senter_status.'</a>';
                   }else{
                    return '-----';
                   }
              
            })
            ->rawColumns(['action','receiver_stock'])->make(true);
    }

    public function confirm_request_senter(Request $request)
    {
      
       $id=$request->id; 
      $requestModel= RequestModel::find($id);
      $product= Product::find($requestModel->product_id);
      $faculty=Faculty::find($requestModel->receiver_stock);
      if(!$product || !$faculty ){
        return response()->json([
            'success'    => false,
            'message'    => 'some data of Product  is deleted check please'
        ]);
      }
     
      $ProductQuntity=ProductQuntity::where('faculty_id',auth()->user()->faculty->id)->where('product_id', $product->id)->get()->count();
       if($ProductQuntity > 0){
        $minimum_qty=$product->minimum_qty;
        $main=0;
       }else{
        $minimum_qty=0;
        $main=1;
       }
        $input_product_qty=[
            'product_id'=>$product->id,
            'faculty_id'=>auth()->user()->faculty->id,
            'qty'=>$requestModel->qty,
            'monitor_inventory_auto'=> $product->monitor_inventory_auto,
            'minimum_qty'=>$minimum_qty,
            'type'=>'in',
            'main'=>$main,
           ];
           
        $product_qty= ProductQuntity::create($input_product_qty);
     

      $body=auth()->user()->faculty->name ." Confirmed Recived qty " . $requestModel->qty ." of " .$product->name ." from you" ;
      $faculty->notifications()->create(['product_id'=>$product->id,'body'=>$body,'date'=>Carbon::now()]);
      if($product_qty){
        $requestModel->update(['receiver_status'=>'received',
       
      ]);
      }
      return response()->json([
        'success'    => true,
        'message'    => 'Requested Confirm Recived'
    ]);
    }
    public function confirm_request_reciver(Request $request)
    {
       
       $id=$request->id; 
      $requestModel= RequestModel::find($id);
      $product= Product::find($requestModel->product_id);
      $faculty=Faculty::find($requestModel->senter_stock);
      if($requestModel->qty <= $product->qty){
        $input_product_qty=[
            'product_id'=>$product->id,
            'faculty_id'=>auth()->user()->faculty->id,
            'qty'=>$requestModel->qty,
            'monitor_inventory_auto'=> $product->monitor_inventory_auto,
            'minimum_qty'=>$product->minimum_qty,
            'type'=>'out',
            'main'=>0,
           ];
           
           $product_qty= ProductQuntity::create($input_product_qty);
      }else{
        $product_qty=null;
        return response()->json([
            'success'    => false,
            'message'    => 'Dont have this quntity for this product'
        ]);
      }

      $body=auth()->user()->faculty->name ." sent " . $requestModel->qty ." of " .$product->name ." to you" ;
      $faculty->notifications()->create(['product_id'=>$product->id,'body'=>$body,'date'=>Carbon::now()]);
      if($product_qty){
        $requestModel->update(['senter_status'=>'done',
        'receiver_national_name'=>$request->reciver_national_name,
        'receiver_national_phone'=>$request->reciver_national_phone,
        'receiver_national_id'=>$request->reciver_national_id,
      ]);
      }
      return response()->json([
        'success'    => true,
        'message'    => 'Requested Done'
    ]);
    }
    public function rejected_request_reciver(Request $request)
    {
        $id=$request->id;
      $requestModel= RequestModel::find($id);
     
      $requestModel->update(['senter_status'=>'rejected','reason'=>$request->reason]);
        return response()->json([
            'success'    => true,
            'message'    => 'Requested Rejected'
        ]);
    }
    public function cancel_request_senter(Request $request)
    {
      $id=$request->id;
      $requestModel= RequestModel::find($id);
      $requestModel->update(['receiver_status'=>'canceled']);
    
      return response()->json([
        'success'    => true,
        'message'    => 'Requested Canceled'
      ]);

    }

    public function exportRequestsAll()
    {
        $requests = RequestModel::all();
        $pdf = PDF::loadView('requests.requestsAllPDF',compact('requests'));
        return $pdf->download('requests.pdf');
    }

    public function exportExcel()
    {
        return (new Exportrequests())->download('requests.xlsx');
    }
}
