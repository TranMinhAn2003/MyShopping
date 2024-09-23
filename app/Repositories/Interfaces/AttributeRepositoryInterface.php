<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserRepositoryInterface
 * @package App\Services\Interfaces
 */
interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function all();
    public function create(array $load = []);
    public function searchAttributes( array $option = []);
}
