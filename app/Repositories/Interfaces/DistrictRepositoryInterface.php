<?php

namespace App\Repositories\Interfaces;

/**
 * Interface DistrictRepositoryInterface
 * @package App\Services\Interfaces
 */
interface DistrictRepositoryInterface extends BaseRepositoryInterface
{
    public function all();
    public function findDistrict(int $province_id=0);
}
