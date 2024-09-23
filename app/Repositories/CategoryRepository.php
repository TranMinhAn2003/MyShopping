<?php

namespace App\Repositories;

use App\Models\AttributeCatalogue;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {

        $this->model = $model;
    }
    public function all()
    {
        return $this->model::all();
    }

}
