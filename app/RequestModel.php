<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $guarded = ['id'];
    protected $table = 'requests';
    
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function receiverstock()
    {
        return $this->belongsTo(Faculty::class,'receiver_stock');
    }
    public function senterstock()
    {
        return $this->belongsTo(Faculty::class,'senter_stock');
    }

    public function notifications()
    {
        return $this->belongsTo(Notification::class, 'notifiable');
    }
   
    // public function getStatusAttribute(){
      
    //     $status= $this->status;
    //     switch ($status) {
    //         case "1":
    //           return ''
    //           break;
    //         case label2:
    //           code to be executed if n=label2;
    //           break;
    //         case label3:
    //           code to be executed if n=label3;
    //           break;
    //           ...
    //         default:
    //           code to be executed if n is different from all labels;
    //       }

    // }

}
