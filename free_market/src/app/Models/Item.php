<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name','brand','price','detail','condition','pic','sold','user_id'];
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
    public function purchases(){
          return $this->hasMany('App\Models\Purchase');
        }
    public function categories() { 
        return $this->belongsToMany(Category::class, 'App\Models\Category','item_id', 'category_master_id'); }


}
