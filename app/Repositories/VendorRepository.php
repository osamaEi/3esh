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

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $vendor = $this->find($id);
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
}