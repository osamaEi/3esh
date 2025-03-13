<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'latitude',
        'longitude',
        'vendor_id',
        'is_active',
    ];
    
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the vendor that owns the branch
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
    /**
     * Scope a query to only include active branches.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}