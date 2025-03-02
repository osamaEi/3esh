<?php

namespace App\Repositories\Contracts;

interface EmployeeRepositoryInterface
{
  
    public function getAll();
    public function findById($id);
    public function findByVendor($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}