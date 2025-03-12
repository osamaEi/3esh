<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;


    protected $fillable = [
        'business_name',
        'email',
        'logo',
        'contact_person',
        'blocked',
        'is_approved',
        'is_active',
    ];



    public function branches(){

        return $this->hasMany(Branch::class);
    }

    public function employees(){

        return $this->hasMany(Employee::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'vendor_categories');
    }
    public function subscriptionPlans()
    {
        return $this->belongsToMany(Subscription::class, 'subscription_vendors', 'vendor_id', 'subscription_id')
                    ->withTimestamps();
    }
}
