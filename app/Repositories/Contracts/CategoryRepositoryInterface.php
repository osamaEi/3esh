<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
  
    public function all(array $columns = ['*']);
    public function paginate(int $perPage = 15);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function find(int $id, array $columns = ['*']);
    public function findBy(string $column, string $value);
    public function getActive();
    public function getTree();
}