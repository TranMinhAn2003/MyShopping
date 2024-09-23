<?php

namespace App\Repositories;

use App\Models\AttributeCatalogue;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AttributeCRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AttributeCRepository extends BaseRepository implements AttributeCRepositoryInterface
{
    protected $model;

    public function __construct(AttributeCatalogue $model)
    {

        $this->model = $model;
    }
    public function all()
    {
        return $this->model::all();
    }

}
