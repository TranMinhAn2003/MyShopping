<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\AttributeCServiceInterface;
use App\Repositories\Interfaces\AttributeCRepositoryInterface as AttributeCRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;





/**
 * Class UserService
 * @package App\Services
 */
class AttributeCService  implements AttributeCServiceInterface
{
    protected $attributeCRepository;

    public function __construct(AttributeCRepository $attributeCRepository)
    {
        $this->attributeCRepository = $attributeCRepository;
    }
    public function all()
    {
        return $this->attributeCRepository->all();
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $load = $request->except('_token');
            $attributeC = $this->attributeCRepository->create($load);
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

            $attributeC = $this->attributeCRepository->update($id,$load);
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
            $attributeC=$this->attributeCRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }
}


