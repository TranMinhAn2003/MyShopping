<?php

namespace App\Services\Interfaces;

/**
 * Interface UserRepositoryInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
public function paginate($request);
public function create($request);
public function update($id,$request);
public function destroy($id);
public function updateStatus();
}
