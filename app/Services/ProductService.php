<?php
//
//namespace App\Services;
//use App\Repositories\Interfaces\ProductRepositoryInterface;
//use Illuminate\Http\Request;
//use App\Models\Product;
//use App\Services\Interfaces\ProductServiceInterface;
//use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Hash;
//
//
//
//
//
///**
// * Class UserService
// * @package App\Services
// */
//class ProductService  implements ProductServiceInterface{
//
//    protected  $productRepository;
//
//    public function __construct(ProductRepository $productRepository )
//    {
//        $this->productRepository=$productRepository;
//    }
//    public function all()
//    {
//        return $this->productRepository->all();
//    }
//    public function create($request){
//        DB::beginTransaction();
//        try{
//            $load = $request->only(['name', 'description', 'price', 'sku', 'quantity']);
//            $products = $this->productRepository->create($load);
//            DB::commit();
//            return true;
//        } catch (\Exception $e) {
//            DB::rollBack();
//            echo $e->getMessage();
//            return false;
//        }
//    }
//
//}
