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
    
    /**
     * Search for vendors based on multiple criteria
     * Only returns active and approved vendors
     * 
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(array $params)
    {
        $query = $this->model->where('is_approved', 1)
                            ->where('is_active', 1);
        
        // Search by vendor name
        if (!empty($params['name'])) {
            $query->where('business_name', 'LIKE', '%' . $params['name'] . '%');
        }
        
        // Search by category
        if (!empty($params['category_id'])) {
            $query->whereHas('categories', function($q) use ($params) {
                $q->where('categories.id', $params['category_id']);
            });
        }
        
        // Define a variable to track if we're doing location search
        $locationSearch = false;
        
        // Search by location (latitude and longitude)
        if (!empty($params['latitude']) && !empty($params['longitude'])) {
            $lat = $params['latitude'];
            $lng = $params['longitude'];
            $radius = $params['radius'] ?? 10; // Default radius is 10 km
            $locationSearch = true;
            
            // Filter vendors that have branches within the radius
            $query->whereHas('branches', function($q) use ($lat, $lng, $radius) {
                $q->whereRaw("(
                    6371 * acos(
                        cos(radians(?)) * 
                        cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + 
                        sin(radians(?)) * 
                        sin(radians(latitude))
                    )
                ) < ?", [$lat, $lng, $lat, $radius]);
            });
            
            // Eager load branches with distance calculation
            $query->with(['branches' => function($q) use ($lat, $lng) {
                $q->selectRaw("*, (
                    6371 * acos(
                        cos(radians(?)) * 
                        cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + 
                        sin(radians(?)) * 
                        sin(radians(latitude))
                    )
                ) AS distance", [$lat, $lng, $lat])
                ->orderBy('distance', 'asc');
            }]);
        } else {
            // If not doing location search, just load active branches
            $query->with(['branches' => function($q) {
                $q->where('is_active', 1);
            }]);
        }
        
        // Always load categories
        $query->with('categories');
        
        // If we're doing location search, order by the nearest branch
        if ($locationSearch) {
            // First, get the vendor IDs we need
            $vendorResults = $query->get();
            $vendorIds = $vendorResults->pluck('id')->toArray();
            
            if (empty($vendorIds)) {
                return collect([]);
            }
            
            // Then, do a separate query to get the minimum distance for each vendor
            // and order by that distance
            $orderedVendors = $this->model
                ->whereIn('id', $vendorIds)
                ->where('is_approved', 1)
                ->where('is_active', 1)
                ->with(['branches' => function($q) use ($lat, $lng) {
                    $q->selectRaw("*, (
                        6371 * acos(
                            cos(radians(?)) * 
                            cos(radians(latitude)) * 
                            cos(radians(longitude) - radians(?)) + 
                            sin(radians(?)) * 
                            sin(radians(latitude))
                        )
                    ) AS distance", [$lat, $lng, $lat])
                    ->orderBy('distance', 'asc');
                }])
                ->with('categories')
                ->get()
                ->sortBy(function ($vendor) {
                    // Sort by the distance of the nearest branch
                    return $vendor->branches->min('distance');
                });
            
            return $orderedVendors->values();
        }
        
        return $query->get();
    }
}