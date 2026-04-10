<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function scopeKeywordSearch($query, $keyword)
            {
                if (!empty($keyword)) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                }
            return $query;
            }
    public function likes(){
          return $this->hasMany('App\Models\Like');
        }
    public function carts(){
          return $this->hasMany('App\Models\Cart');
        }



}
