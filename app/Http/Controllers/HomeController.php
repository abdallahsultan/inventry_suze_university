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
        // $productQuntites=auth()->user()->faculty->products;
       
       $chart_yValues=[];
       foreach ($monthes as  $month) {
        $sum_in=0;
        $sum_out=0;
            foreach ($productQuntites as $key => $value) {
                    $date=Carbon::parse($value->created_at)->format('F');
                    $chart_yValues[$value->product->category->name][$month]=$productQuntites->where('month',$month)->where('type','in')->sum('qty') ?? 0 - $productQuntites->where('month',$month)->where('type','out')->sum('qty') ?? 0;
                    
               
                
            }
        
       }
    //    dd($chart_yValues);
        $notifcations=auth()->user()->faculty->notifications;
        $notify_count=$notifcations->count();
       
        return view('home',compact('user','user_count','user_online','user_offline'));
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
