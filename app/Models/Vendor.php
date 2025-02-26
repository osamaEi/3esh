<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;



    public function branches(){

        return $this->hasMany(Branch::class);
    }

    public function employees(){

        return $this->hasMany(Employee::class);
    }

    public function categories(){

        return $this->belongsToMany(Category::class);
    }



}
