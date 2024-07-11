<?php

namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


/**
 * Class UserService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {

        $this->model=$model;
    }
    public function pagintion(
        array $column=['*'], array $condition=[],array $join=[] ,array $search=[]
    )
    {
         $query=$this->model->select($column)->where(function ($query) use ($condition){
             if(isset($condition['keyword']) && !empty($condition['keyword'])){
                 $query->where('name','LIKE',''.$condition['keyword'].'%')
                     ->orWhere('email','LIKE',''.$condition['keyword'].'%')
                     ->orWhere('phone','LIKE',''.$condition['keyword'].'%')
                     ->orWhere('address','LIKE',''.$condition['keyword'].'%')
                     ->orWhere('gender','LIKE',''.$condition['keyword'].'%');
             }
             if(isset($condition['user_agent']) && !empty($condition['user_agent']) && $condition['user_agent'] !=0){
                 $query->where('user_agent','=',''.$condition['user_agent']);
             }
             return $query;
         });
         if(!empty($join)){
            $query->join(...$join);
         }
         return $query->paginate(8)->withQueryString()->withPath(env('APP_URL').$search['path']);
    }
    public function create(array $load=[]){
        $model= $this->model->create($load);
        return $model->fresh();
    }
    public function updatePublish(string $whereinfield='',array $wherein=[],array $load=[])
    {
        return $this->model->whereIn($whereinfield,$wherein)->update($load);
    }
    public function update(int $id,array $load=[])
    {
        $model=$this->findById($id);
        return $model->fresh()->update($load);

    }
    public function delete($id =0)
    {
        return $this->findById($id)->delete();
    }
    public function all()
    {
        return $this->model->all();
    }
    public function findById(int $modelId, array $column = ['*'], array $relation = [])
    {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}
