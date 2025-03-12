<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $table="subscription_plans";

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'subscription_vendors', 'subscription_id', 'vendor_id')
                    ->withTimestamps();
    }
}
