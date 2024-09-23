<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Services\Interfaces\AttributeServiceInterface;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;





/**
 * Class UserService
 * @package App\Services
 */
class AttributeService  implements AttributeServiceInterface
{
    protected $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    public function all()
    {
        return $this->attributeRepository->all();
    }
   public function create($request){
        DB::beginTransaction();
        try{
            $load=$request->except(['_token']);
            $attribute = $this->attributeRepository->create($load);
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
            $attribute = $this->attributeRepository->update($id,$load);
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


