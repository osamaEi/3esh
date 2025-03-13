<?php
namespace App\Repositories\Contracts;

interface VendorRepositoryInterface
{
    public function all();
    
    public function getAllActiveAndApproved();
    
    public function find($id);
    
    public function findActiveAndApproved($id);
    
    public function findByCategory($categoryId);
    
    public function findByCategoryActiveAndApproved($categoryId);
    
    public function create(array $data);
    
    public function update($id, array $data);
    
    public function delete($id);
    
    public function approve($id);
    
    public function block($id);
    
    public function unblock($id);
    
    public function search(array $params);
}