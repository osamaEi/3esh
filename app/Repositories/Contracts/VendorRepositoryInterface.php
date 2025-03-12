<?php

namespace App\Repositories\Contracts;


interface VendorRepositoryInterface
{
    public function all();
    public function find($id);
    public function findByCategory($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function approve($id);
    public function block($id);
    public function unblock($id);
}