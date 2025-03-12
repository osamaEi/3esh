<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $employees = $this->employeeRepository->getAll();
        return view('admin.vendors.employees.index', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {     
        
        $vendors = $this->vendorRepository->all();

        return view('admin.vendors.employees.create',compact('vendors'));
    }


    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $employee = $this->employeeRepository->create($data);
    
      
        if ($request->has('categories')) {
            $employee->categories()->sync($request->categories);
        }
    
        return redirect()->route('admin.employees.index')->with('success', __('employee created successfully.'));
    }

    // Display the specified employee
    public function show($id)
    {
        $employee = $this->employeeRepository->findById($id);
        return view('admin.vendors.employees.show', compact('employee'));
    }

    // Show the form for editing the specified employee
    public function edit($id)
    {
        $employee = $this->employeeRepository->findById($id);
        $vendors = $this->vendorRepository->all();

        return view('admin.vendors.employees.edit', compact('employee','vendors'));
    }

    // Update the specified employee in the database
    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeRepository->update($id, $request->validated());
        return redirect()->route('admin.employees.index')->with('success', __('employee updated successfully.'));
    }

    // Remove the specified employee from the database
    public function destroy($id)
    {
        $this->employeeRepository->delete($id);
        return redirect()->route('admin.employees.index')->with('success', __('employee deleted successfully.'));
    }






}
