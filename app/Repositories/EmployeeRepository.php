<?php
namespace App\Repositories;

use App\Models\Vendor;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        return Employee::all();
    }

    public function findById($id)
    {
        return Employee::findOrFail($id);
    }

    public function findByVendor($id)
    {
        return Vendor::where('employee_id',$id)->get();
    }

    public function show($id)
    {
        return $this->findById($id);
    }
    public function create(array $data)
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
      
        return Employee::create($data);
    }
    
    public function update($id, array $data)
    {
        $employee = $this->findById($id);
    
        if (isset($data['photo'])) {
            if ($employee->photo) {
                $this->deletePhoto($employee->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
    
        $employee->update($data);
        return $employee;
    }
    
    private function uploadPhoto($photo)
    {
        $path = $photo->store('public/branches'); 
        return str_replace('public/', '', $path); 
    }
    
    
    private function deletePhoto($filename)
    {
        $path = public_path('uploads/branches/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
    
    public function delete($id)
    {
        $employee = $this->findById($id);
        return $employee->delete();
    }

}
