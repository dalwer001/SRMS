<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function productCategory()
    {
        return $this->belongsTo(ProductCategories::class,'category_id','id');
    }
}

