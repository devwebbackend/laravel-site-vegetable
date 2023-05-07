<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $tables='products';
    protected $fillable=['product','price','category_id','image','status'];

  public function category()  
  {
return $this->belongsTo('App\Models\Category','category_id');
  }
}
