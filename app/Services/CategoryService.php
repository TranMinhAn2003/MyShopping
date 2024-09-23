<?php

namespace App\Services;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\AttributeCServiceInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;





/**
 * Class UserService
 * @package App\Services
 */
class CategoryService  implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function all()
    {
        return $this->categoryRepository->all();
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $load = $request->except('_token');
            $category = $this->categoryRepository->create($load);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function update($id,$request)
    {
        DB::beginTransaction();
        try {

            $load = $request->except(['_token']);

            $category = $this->categoryRepository->update($id,$load);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category=$this->categoryRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }
}


