<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
        public function category_items(){
        return $this->belongsTo('App\Models\Category_Item');
    }
}
