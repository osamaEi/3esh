<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class VendorController extends Controller
{
    protected $vendorRepository;
    protected $categoryRepository;

    public function __construct(
        VendorRepositoryInterface $vendorRepository,
        CategoryRepositoryInterface $categoryRepository
    
    )
    {
        $this->vendorRepository = $vendorRepository;
        $this->categoryRepository = $categoryRepository;
    
    }
    // Display a listing of vendors
    public function index()
    {
        $vendors = $this->vendorRepository->all();
        return view('admin.vendors.index', compact('vendors'));
    }

    // Show the form for creating a new vendor
    public function create()
    {        $categories = $this->categoryRepository->all();

        return view('admin.vendors.create',compact('categories'));
    }
    public function store(VendorRequest $request)
    {
        $data = $request->validated();
    

    
        // Create the vendor
        $vendor = $this->vendorRepository->create($data);
    
        // Attach categories
        if ($request->has('categories')) {
            $vendor->categories()->sync($request->categories);
        }
    
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    // Display the specified vendor
    public function show($id)
    {
        $vendor = $this->vendorRepository->find($id);
        return view('admin.vendors.show', compact('vendor'));
    }

    // Show the form for editing the specified vendor
    public function edit($id)
    {
        $vendor = $this->vendorRepository->find($id);
        $categories = $this->categoryRepository->all();

        return view('admin.vendors.edit', compact('vendor','categories'));
    }

    // Update the specified vendor in the database
    public function update(VendorRequest $request, $id)
    {
        $this->vendorRepository->update($id, $request->validated());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    // Remove the specified vendor from the database
    public function destroy($id)
    {
        $this->vendorRepository->delete($id);
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }

    // Approve a vendor
    public function approve($id)
    {
        $this->vendorRepository->approve($id);
        return redirect()->route('vendors.index')->with('success', 'Vendor approved successfully.');
    }

    // Block a vendor
    public function block($id)
    {
        $this->vendorRepository->block($id);
        return redirect()->route('vendors.index')->with('success', 'Vendor blocked successfully.');
    }

    // Unblock a vendor
    public function unblock($id)
    {
        $this->vendorRepository->unblock($id);
        return redirect()->route('vendors.index')->with('success', 'Vendor unblocked successfully.');
    }
}