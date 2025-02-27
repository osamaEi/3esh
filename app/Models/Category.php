<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    // Get all descendants
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_categories');
    }

}
