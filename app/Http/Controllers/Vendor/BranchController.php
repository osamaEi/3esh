<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;

class BranchController extends Controller
{
    public function __construct(
        BranchRepositoryInterface $branchRepository,
        VendorRepositoryInterface $vendorRepository,
        )
{
    $this->branchRepository = $branchRepository;
    $this->vendorRepository = $vendorRepository;
}

public function index()
{
    $employee = Auth::guard('employee')->user();
    $vendorID = $employee->vendor_id;
    $branches = $this->branchRepository->findByVendor($vendorID);
    return view('vendors.branches.index', compact('branches'));
}
public function create()
{
    $employee = Auth::guard('employee')->user();
    
   $vendorId = $employee->vendor_id;
        
        
    return view('vendors.branches.create',compact('vendorId'));
}

public function show($id)
{
    $branch = $this->branchRepository->show($id);
    return view('vendors.branches.show', compact('branch'));
}

public function store(BranchRequest $request)
{
    $this->branchRepository->create($request->validated());
    return redirect()->back()->with('success', __('Branch created successfully.'));
}
public function edit($id)
{
    $vendors = $this->vendorRepository->all();
    $branch = $this->branchRepository->findById($id);
    $employeess = Auth::guard('employee')->user();
    
    $vendorId = $employeess->vendor_id;
    return view('vendors.branches.edit',compact('vendors','branch','vendorId'));
}
public function update(BranchRequest $request, $id)
{
    $this->branchRepository->update($id, $request->validated());
    return redirect()->route('vendors.branches.index')->with('success', __('Branch updated successfully.'));
}
    


}
