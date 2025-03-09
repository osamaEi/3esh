<?php
namespace App\Repositories;

use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;

class BranchRepository implements BranchRepositoryInterface
{
    public function getAll()
    {
        return Branch::all();
    }

    public function findById($id)
    {
        return Branch::findOrFail($id);
    }
    public function findByVendor($id)
    {
        return Branch::where('vendor_id',$id)->get();

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
        if (isset($data['working_days'])) {
            $data['working_days'] = json_encode($data['working_days']);
        }
        return Branch::create($data);
    }
    
    public function update($id, array $data)
    {
        $branch = $this->findById($id);
    
        if (isset($data['photo'])) {
            if ($branch->photo) {
                $this->deletePhoto($branch->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
    
        $branch->update($data);
        return $branch;
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
        $branch = $this->findById($id);
        return $branch->delete();
    }

}
