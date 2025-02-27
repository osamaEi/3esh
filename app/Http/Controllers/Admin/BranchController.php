<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
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
    $branches = $this->branchRepository->getAll();
    return view('admin.vendors.branches.index', compact('branches'));
}
public function create()
{
    $vendors = $this->vendorRepository->all();
    return view('admin.vendors.branches.create',compact('vendors'));
}

public function show($id)
{
    $branch = $this->branchRepository->show($id);
    return view('admin.vendors.branches.show', compact('branch'));
}

public function store(BranchRequest $request)
{
    $this->branchRepository->create($request->validated());
    return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
}
public function edit($id)
{
    $vendors = $this->vendorRepository->all();
    $branch = $this->branchRepository->findById($id);

    return view('admin.vendors.branches.edit',compact('vendors','branch'));
}
public function update(BranchRequest $request, $id)
{
    $this->branchRepository->update($id, $request->validated());
    return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
}
}
