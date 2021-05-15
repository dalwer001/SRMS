<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded=[];
    // protected $fillable=['name','email','contact_no','salary','birth_date','join_date'];

    public function employeeDetail(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    use HasFactory;
}
