<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseRepositoryInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $modelId, array $column = ['*'], array $relation = []);
    public function create(array $load = []);
    public function update(int $id,array $load=[]);
    public function delete($id);
    public function pagintion(
        array $column=['*'], array $condition=[],array $join=[],array $search=[]
    );

    public function find($id);

    public function allAttribute(array $column = ['*'], array $relation = []);
    public function findAttribute(array $relation = [],int $attribute_catalogue_id=0);
}
