<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use App\Models\Vendor;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 'branch_id', 'user_id', 'amount', 'discount_percentage', 
        'discount_amount', 'confirmation_code', 'is_confirmed', 'employee_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
