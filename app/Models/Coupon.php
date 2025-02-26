<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ["name", "discount", "valid_until"];

    //Convert the cuppon name to uppercase

    public function setNameAttribute($value)
    {
        $this->attribute['name']=Str::upper($value);
    }
    // check cuppon if expired 
    public function checkIfValid($value)
    {
        if($this->valid_until > Carbon::now()){
            return true;
        }else{
            return false;
        }
    }


}
