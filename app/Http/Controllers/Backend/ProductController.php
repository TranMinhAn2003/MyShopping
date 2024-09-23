<?php

namespace App\Http\Controllers\Backend;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $productService;
    protected $attributeCService;
    protected $attributeService;
    protected $attributeRepository;
    protected $categoryRepository;
    protected $categoryService;

    public function __construct(Product $productService, AttributeCService $attributeCService, AttributeService $attributeService,AttributeRepository $attributeRepository,CategoryRepository $categoryRepository,CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->attributeCService = $attributeCService;
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;

    }

    public function index(Request $request)
    {
        $category=$this->categoryService->all();
        $categoryId = $request->input('category_id');
        $keyword = $request->input('keyword');
//        if ($categoryId || $keyword) {
//            // Lọc sản phẩm theo nhóm được chọn
//            $products = Product::with(['category', 'attributes', 'mainImage'])
//                ->where('category_id', $categoryId)
//                ->orWhere('name','like','%'.$keyword.'%')
//                ->paginate(6);
//        } else {
//            // Hiển thị tất cả sản phẩm nếu không có nhóm nào được chọn
//            $products = Product::with(['category', 'attributes', 'mainImage'])->Where('name','like','%'.$keyword.'%')->paginate(6);
//        }
        $products = Product::with(['category', 'attributes', 'mainImage'])
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($keyword, function($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(6);

        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css')

            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js'),

            ]];


            $title = 'Danh sách sản phẩm';

        $template = 'product.index';
        return view('dashboard.index', compact('template', 'config', 'title','products','category'));
    }
    public function create()
    {
        $attributeCatalogue=$this->attributeCService->all();
        $category=$this->categoryService->all();

        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css')

            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js'),
                asset('/library/variant.js'),
                asset('/plugins/ckfinder_2/ckfinder.js'),
                asset('/library/finder.js')

            ]];
        $template = 'product.variant';
        return view('dashboard.index',compact('template','config','attributeCatalogue','category'));
    }
    public function store(Request $request){
        // Bắt đầu một transaction
        DB::beginTransaction();

        try {
            // Tạo sản phẩm mới
            $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sku' => $request->input('sku'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id'),
                'is_featured' => $request->has('is_featured') ? 1 : 0
            ]);

            // Xử lý lưu các thuộc tính (nếu có)
            $attributes = $request->input('attribute', []);
            if (!empty($attributes)) {
                $product->attributes()->attach($attributes);
            }

            // Xử lý lưu ảnh (nếu có)
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as  $image) {
                    $imagePath = $image->store('product_images', 'public');

                    // Đặt ảnh đầu tiên làm ảnh chính
                    $isMain = $image->getClientOriginalName() === $images[0]->getClientOriginalName();

                    // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                    Image::create([
                        'product_id'=> $product->id,
                        'path' => $imagePath,
                        'is_main' => $isMain,
                    ]);
                }
            }

            DB::commit();
            flash()->success('Tạo bản ghi thành công');
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            flash()->error('Tạo bản ghi không thành công');
            return redirect()->route('product.create');
        }
    }
    public function edit($id)
    {
        $products=Product::with(['category', 'attributes.attribute_catalogue', 'mainImage'])->findOrFail($id);
        $category=$this->categoryService->all();
        $attributeCatalogue=$this->attributeCService->all();

        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css')

            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js'),
                asset('/library/variant.js'),
                asset('/plugins/ckfinder_2/ckfinder.js'),
                asset('/library/editproduct.js')

            ]];

        $template = 'product.update';
        $title = 'Sửa bản ghi';

        return view('dashboard.index', compact('products', 'template', 'title','config','category','attributeCatalogue'));

    }
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'sku' => $request->input('sku'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id'),
                'is_featured' => $request->has('is_featured') ? 1 : 0 // Kiểm tra checkbox
            ]);



            $attributes = $request->input('attribute',[]);
            $product->attributes()->detach();
            $product->attributes()->attach($attributes);

            if ($request->hasFile('images')) {
                $newImages = $request->file('images');

                foreach ($newImages as $index => $image) {
                    $imagePath = $image->store('product_images', 'public');
                    $isMain = ($index === 0);

                    Image::create([
                        'product_id' => $product->id,
                        'path' => $imagePath,
                        'is_main' => $isMain,
                    ]);
                }
            }

            // Xử lý xóa hình ảnh cũ
            if ($request->has('remove_images')) {
                $removeImages = $request->input('remove_images');

                // Kiểm tra nếu là mảng

                    foreach ($removeImages as $imageId) {
                        $image = Image::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->path);
                            $image->delete();
                        }
                    }
                }


            // Cập nhật thông tin hình ảnh còn lại
            if ($request->has('existing_images')) {
                $existingImages = $request->input('existing_images');
                foreach ($existingImages as $imageId) {
                    $image = Image::find($imageId);
                    if ($image) {
                        $image->is_main = false;
                        $image->save();
                    }
                }

                // Đặt ảnh đầu tiên còn lại làm ảnh chính
                $firstImage = Image::where('product_id', $product->id)->where('is_main', false)->first();
                if ($firstImage) {
                    $firstImage->is_main = true;
                    $firstImage->save();
                }
            }


            $product->save();

            DB::commit();
            flash()->success('Cập nhật bản ghi thành công');
            return redirect()->route('product.index');
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            flash()->error('Cập nhật bản ghi thất bại');
            return redirect()->route('product.edit', $id);
        }
    }

    public function destroy($id){

        $product=Product::find($id);
        if($product){
        $product->delete();
        flash()->success('Đơn hàng đã được xóa');
        return redirect()->route('product.index');
        }
        else{
            flash()->error('Đơn hàng đã xóa không thành công');
            return redirect()->route('product.index');
        }
    }

}
