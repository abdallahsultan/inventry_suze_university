<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Category;
use Carbon\Carbon;
use App\Notification;
use App\ProductQuntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        
        if(!$request->search){
            return back();
        }
        $search=strtolower(trim($request->search));
        $routeCollection = Route::getRoutes();
        $ALLarra=[];
        $arra=[];
        foreach ($routeCollection as $key =>$value) {
            
            $ALLarra[$key]=$value->uri();

            if($search == 'home' || $search == 'dashboard'){
                return redirect()->route('home');
            }
           if($this->like($search.'%', $value->uri()) === true ){

             
               return redirect()->route($value->uri().'.index');
           }
          
        }
        
        return back()->with('error', 'Not Found Page');
        
    }
    public function index()
    {
        $monthes = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
        $monthes = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        $user=User::all();
        $user_count =$user->count();
        $user_online=$user->where('is_online',1)->count();
        $user_offline=$user->where('is_online',0)->count();
        // ====================================================
        // dd(auth()->user()->faculty->products);
        // dd($routeCollection);
        $productQuntites=ProductQuntity::where('faculty_id',auth()->user()->faculty->id)->get();
        $categories=Category::whereHas('products')->take(5)->get();
        // $productQuntites=auth()->user()->faculty->products;
       
       $chart_yValues=[];
       $chart2_yValues2=[];
      
       foreach ($categories as  $category) {
        $sum_items_qty=0;
        $products_ids=$category->products->pluck('id')->toArray();
        foreach ($monthes as  $month) {
            $month_num=Carbon::parse($month)->format('m');
            $sum_product_qty=0;
            if($productQuntites->where('category_id',$category->id)->where('month_number',(int)$month_num)->count() > 0 ){
              foreach ($products_ids as  $product_id) {
                // dd($month,$productQuntites->where('category_id',$category->id)->where('month','<=',$month)->count());
                $sum_product_in = $productQuntites->where('product_id', $product_id)->where('type','in')->where('category_id',$category->id)->where('month_number','<=',$month_num)->sum('qty') ?? 0;
                $sum_product_out=$productQuntites->where('product_id', $product_id)->where('type','out')->where('category_id',$category->id)->where('month_number','<=',$month_num)->sum('qty') ?? 0;
                $sum_product_qty+=$sum_product_in - $sum_product_out;
               }
              }
            $chart_yValues[$category->name][$month]= $sum_product_qty;
        }
        if($productQuntites->where('category_id',$category->id)->count() > 0 ){
            foreach ($products_ids as  $product_id) {
              $sum_items_in = $productQuntites->where('product_id', $product_id)->where('type','in')->where('category_id',$category->id)->sum('qty') ?? 0;
              $sum_items_out=$productQuntites->where('product_id', $product_id)->where('type','out')->where('category_id',$category->id)->sum('qty') ?? 0;
              $sum_items_qty+=$sum_items_in - $sum_items_out;
             }
            }
         $chart2_yValues2[$category->name]= $sum_items_qty;
       }
      
        $monthes=json_encode($monthes);
        $chart_yValues=json_encode($chart_yValues);
        $chart2_yValues2=json_encode($chart2_yValues2);
        
       
        
       
        $notifcations=auth()->user()->faculty->notifications;
        $notify_count=$notifcations->count();
       
        return view('home',compact('user','user_count','user_online','user_offline','chart2_yValues2','chart_yValues','monthes'));
    }
    public function setting()
    {
        $setting = Setting::first();
       
      if($setting){
       if( $setting->dark_mode == 0){

           $setting->update(['dark_mode'=>1]);
        }else{
            
            $setting->update(['dark_mode'=>0]);
            
       }
    }else{
        Setting::create(['dark_mode'=>1]);
    }

        return 1;
    }

    function like($pattern, $subject) {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }
}
