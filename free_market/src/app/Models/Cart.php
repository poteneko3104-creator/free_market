<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function Item(){
        return $this -> hasOne('App\Models\Item','id');
    }
    public function User(){
        return $this -> hasOne('App\Models\User','id');
    }
}
