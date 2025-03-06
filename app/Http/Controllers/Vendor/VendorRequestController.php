<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VendorRequestController extends Controller
{
    /**
     * Show the vendor registration form.
     */
    public function create()
    {
        return view('vendors.form_request');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate vendor data
        $vendorValidator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:vendors,email',
            'contact_person' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($vendorValidator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $vendorValidator->errors()
            ], 422);
        }

        // Validate employees data if present
        $employeesData = $request->employees ?? [];
        $employeeValidationRules = [];
        
        foreach ($employeesData as $key => $employee) {
            if (!empty($employee['name'])) {
                $employeeValidationRules["employees.{$key}.name"] = 'required|string|max:255';
                $employeeValidationRules["employees.{$key}.email"] = 'nullable|email|max:255';
                $employeeValidationRules["employees.{$key}.phone"] = 'nullable|string|max:20';
                $employeeValidationRules["employees.{$key}.position"] = 'nullable|string|max:255';
                $employeeValidationRules["employees.{$key}.photo"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            }
        }

        if (!empty($employeeValidationRules)) {
            $employeeValidator = Validator::make($request->all(), $employeeValidationRules);
            
            if ($employeeValidator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $employeeValidator->errors()
                ], 422);
            }
        }

        try {
            // Begin transaction
            DB::beginTransaction();
            
            // Create vendor
            $vendorData = $request->only([
                'business_name', 
                'email', 
                'contact_person'
            ]);
            
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $vendorData['logo'] = $request->file('logo')->store('vendors/logos', 'public');
            }
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $vendorData['photo'] = $request->file('photo')->store('vendors/photos', 'public');
            }
            
            // Set default values for vendor registration
            $vendorData['is_active'] = true;
            $vendorData['is_approved'] = false; // Requires admin approval
            $vendorData['blocked'] = false;
            
            // Create the vendor
            $vendor = Vendor::create($vendorData);
            
            // Create employees if any
            $createdEmployees = [];
            
            if (!empty($employeesData)) {
                foreach ($employeesData as $employeeData) {
                    if (!empty($employeeData['name'])) {
                        $newEmployee = new Employee([
                            'name' => $employeeData['name'],
                            'position' => $employeeData['position'] ?? null,
                            'email' => $employeeData['email'] ?? null,
                            'phone' => $employeeData['phone'] ?? null,
                        ]);
                        
                        // Handle employee photo upload if present
                        if (isset($employeeData['photo']) && $employeeData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                            $newEmployee->photo = $employeeData['photo']->store('employees/photos', 'public');
                        }
                        
                        // Associate with vendor
                        $newEmployee->vendor_id = $vendor->id;
                        $newEmployee->save();
                        
                        $createdEmployees[] = $newEmployee;
                    }
                }
            }
            
            // Commit transaction
            DB::commit();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vendor registration submitted successfully! Your application is pending approval.',
                    'vendor' => $vendor,
                    'employees' => $createdEmployees,
                    'redirect' => route('vendors.register.success', ['id' => $vendor->id])
                ]);
            }
            
            // For non-AJAX requests, redirect to success page
            return redirect()->route('vendors.register.success', ['id' => $vendor->id])
                ->with('success', 'Vendor registration submitted successfully! Your application is pending approval.');
            
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->withInput()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Show registration success page.
     */
    public function success(Request $request)
    {
        // If ID is provided, fetch the vendor
        $vendor = null;
        if ($request->has('id')) {
            $vendor = Vendor::find($request->id);
        }
        
        return view('vendors.register_success', compact('vendor'));
    }
}