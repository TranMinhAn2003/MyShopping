<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $categoryService;

    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css'),
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js')
            ]];
        $category = $this->categoryRepository->all();
        $template = 'category.index';
        $title = 'Danh sách nhóm sản phẩm';
        return view('dashboard.index', compact('template', 'title', 'category', 'config'));
    }


    public function create()
    {
        $template = 'category.create';
        $title = 'Thêm nhóm sản phẩm';
        return view('dashboard.index', compact( 'template', 'title'));
    }

    public function store(Request $request)
    {
        if($this->categoryService->create($request)){
            flash()->success('Thêm nhóm sản phẩm thành công');
            return redirect()->route('category.index');
        }else{
            flash()->error('Thêm nhóm sản phẩm không thành công');

            return redirect()->route('category.create');
        }
    }
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $template = 'category.update';
        $title = 'Sửa nhóm sản phẩm';
        return view('dashboard.index', compact('category', 'template', 'title'));
    }
    public function update($id, Request $request)
    {
        if($this->categoryService->update($id, $request)){
            flash()->success('Sửa nhóm sản phẩm thành công');
            return redirect()->route('category.index');
        }else{
            flash()->error('Sửa nhóm sản phẩm không thành công');
            return redirect()->route('category.edit');
        }
    }
    public function destroy($id)
    {
        if($this->categoryService->destroy($id)){
            flash()->success('Xóa nhóm sản phẩm thành công');
            return redirect()->route('category.index');
        }else{
            flash()->error('Xóa nhóm sản phẩm không thành công');
            return redirect()->route('category.index');
        }
    }
}
