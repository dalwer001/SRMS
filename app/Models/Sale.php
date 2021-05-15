<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function salesEmp(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function saleDetail(){
        return $this->hasMany(SaleDetails::class,'sale_id','id');
    }
    
}
