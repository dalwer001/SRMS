<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function productDetails()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id','id');
    }
    
}
