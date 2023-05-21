<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Notification;
use Illuminate\Http\Request;

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
    public function index()
    {
       
        $notifcations=auth()->user()->faculty->notifications;
        $notify_count=$notifcations->count();
        // return view('home',compact('notifcations','notify_count'));
        return view('home');
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
}
