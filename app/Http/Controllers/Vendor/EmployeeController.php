<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    protected $vendorRepository;
    protected $employeeRepository;

    public function __construct(
        VendorRepositoryInterface $vendorRepository,
        EmployeeRepositoryInterface $employeeRepository
    
    )
    {
        $this->vendorRepository = $vendorRepository;
        $this->employeeRepository = $employeeRepository;
    
    }

    public function index()
    {
        // Get the authenticated employee
        $employee = Auth::guard('employee')->user();
    

        // Get the vendor_id from the employee
        $vendorID = $employee->vendor_id;
    
        // Fetch vendor data using the repository
        $employees = $this->employeeRepository->vendorData($vendorID);
    
        // Return the view with the employees data
        return view('vendors.employees.index', compact('employees'));
    }



}
