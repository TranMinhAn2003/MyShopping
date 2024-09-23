<?php

namespace App\Services\Interfaces;

/**
 * Interface UserRepositoryInterface
 * @package App\Services\Interfaces
 */
interface CategoryServiceInterface
{
    public function all();
    public function create($request);
}
