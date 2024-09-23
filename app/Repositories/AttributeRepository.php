<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    protected $model;

    public function __construct(Attribute $model)
    {

        $this->model = $model;
    }
    public function all()
    {
        return $this->model::all();
    }
    public function create(array $load = [])
    {
        return $this->model::create($load)->fresh();
    }

    public function searchAttributes( array $option = []){
        return $this->model
            ->where('attribute_catalogue_id', $option['attributeCatalogueId'])
            ->get();
    }
}
