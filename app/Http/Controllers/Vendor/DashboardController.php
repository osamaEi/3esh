<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
 
        $vendor = $employee->vendor; // Fetch vendor via relationship

        return view('vendors.dashboard.index', compact('vendor'));
    }

    public function data()
    {
        $employee = Auth::guard('employee')->user();
  
        $vendor = $employee->vendor; // Fetch vendor with branches
        $branches = $vendor->branches; // Fetch branches

        return view('vendors.dashboard.data', compact('vendor', 'branches'));
    }


}
