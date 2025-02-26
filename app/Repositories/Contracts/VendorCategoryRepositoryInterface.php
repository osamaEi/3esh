<?php

namespace App\Repositories\Contracts;

interface VendorCategoryRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByVendorId($vendorId);
    public function findByCategoryId($categoryId);
}