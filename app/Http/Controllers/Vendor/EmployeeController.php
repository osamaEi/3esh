<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
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
        $employee = Auth::guard('employee')->user();
        $vendorID = $employee->vendor_id;
        $employees = $this->employeeRepository->vendorData($vendorID);
        return view('vendors.employees.index', compact('employees'));
    }


    public function create()
    {
        $employee = Auth::guard('employee')->user();
    
        $vendorId = $employee->vendor_id;

        $branches = Branch::where('vendor_id',$vendorId)->get();

        return view('vendors.employees.create', compact('vendorId','branches'));
    }

    
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $employee = $this->employeeRepository->create($data);
         return redirect()->back()->with('success', __('employee created successfully.'));
    }
    public function edit($id)
    {
        $employee = $this->employeeRepository->findById($id);
        $employeess = Auth::guard('employee')->user();
    
        $vendorId = $employeess->vendor_id;
        $branches = Branch::where('vendor_id',$vendorId)->get();

        return view('vendors.employees.edit', compact('employee','vendorId','branches'));
    }

    // Update the specified employee in the database
    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeRepository->update($id, $request->validated());
        return redirect()->route('vendors.employee')->with('success', __('employee updated successfully.'));
    }

    // Remove the specified employee from the database
    public function destroy($id)
    {
        $this->employeeRepository->delete($id);
        return redirect()->back()->with('success', __('employee deleted successfully.'));
    }

}
