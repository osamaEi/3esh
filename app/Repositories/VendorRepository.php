<?php
namespace App\Repositories;
use App\Models\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;
class VendorRepository implements VendorRepositoryInterface
{
    protected $model;
    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    
    /**
     * Get all active and approved vendors
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActiveAndApproved()
    {
        return $this->model->where('is_approved', 1)
                          ->where('is_active', 1)
                          ->get();
    }
    
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * Find an active and approved vendor by ID
     * 
     * @param int $id
     * @return Vendor|null
     */
    public function findActiveAndApproved($id)
    {
        return $this->model->where('id', $id)
                          ->where('is_approved', 1)
                          ->where('is_active', 1)
                          ->firstOrFail();
    }
    
    public function findByCategory($categoryId)
    {
        return $this->model->whereHas('categories', function($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();
    }
    
    /**
     * Find active and approved vendors by category
     * 
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByCategoryActiveAndApproved($categoryId)
    {
        return $this->model->whereHas('categories', function($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })
        ->where('is_approved', 1)
        ->where('is_active', 1)
        ->get();
    }
    
    public function create(array $data)
    {
        if (isset($data['logo'])) {
            $data['logo'] = $this->uploadPhoto($data['logo']);
        }
        return $this->model->create($data);
    }
    
    public function update($id, array $data)
    {
        $vendor = $this->find($id);
        
        if (isset($data['logo']) && $data['logo'] != $vendor->logo) {
            // Delete old logo if it exists
            if ($vendor->logo) {
                $this->deletePhoto($vendor->logo);
            }
            
            // Upload new logo
            $data['logo'] = $this->uploadPhoto($data['logo']);
        }
        
        $vendor->update($data);
        return $vendor;
    }
    
    public function delete($id)
    {
        $vendor = $this->find($id);
        return $vendor->delete();
    }
    
    public function approve($id)
    {
        $vendor = $this->find($id);
        $vendor->is_approved = true;
        $vendor->save();
        return $vendor;
    }
    
    public function block($id)
    {
        $vendor = $this->find($id);
        $vendor->blocked = true;
        $vendor->save();
        return $vendor;
    }
    
    public function unblock($id)
    {
        $vendor = $this->find($id);
        $vendor->blocked = false;
        $vendor->save();
        return $vendor;
    }
    
    public function uploadPhoto($photo)
    {
        $path = $photo->store('public/vendors');
        return str_replace('public/', '', $path);
    }
    
    protected function deletePhoto($path)
    {
        \Storage::delete('public/' . $path);
    }
}