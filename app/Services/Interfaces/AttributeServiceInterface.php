<?php

namespace App\Services\Interfaces;

/**
 * Interface UserRepositoryInterface
 * @package App\Services\Interfaces
 */
interface AttributeServiceInterface
{
    public function all();
    public function create($request);
}
