<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["name", "total", "delivered_at","user_id","coupon_id"];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getCreatedAtAttribute($value)
    {
        
        return Carbon::parse($value)->diffForHumans();
    
    }
    public function getDeliveredAtAttribute($value)
    {
        if($value){
        return Carbon::parse($value)->diffForHumans();
    }else{
        return null;
    }
    }

}
