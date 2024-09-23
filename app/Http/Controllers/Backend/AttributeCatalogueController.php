<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AttributeCCreateRequest;
use App\Http\Requests\AttributeCUpdateRequest;
use App\Repositories\Interfaces\AttributeCRepositoryInterface as AttributeCRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;

;;

class AttributeCatalogueController extends Controller
{
    protected $attributeCRepository;
    protected $attributeCService;
    public function __construct(AttributeCService $attributeCService,AttributeCRepository $attributeCRepository){
         $this->attributeCService =$attributeCService;
         $this->attributeCRepository=$attributeCRepository;
    }
    public function index()
    {

        $attributeC=$this->attributeCService->all();
        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css'),
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js')
            ]];
        $template  = 'attributecatalogue.index';
        $title='Danh sách thuộc tính';
        return view('dashboard.index', compact('template','title','config','attributeC','config'));
    }
    public function create()
    {
        $title='Thêm thuộc tính';
        $template  = 'attributecatalogue.create';
        return view ('dashboard.index',compact('template','title'));
    }
    public function store(AttributeCCreateRequest $request)
    {
        if($this->attributeCService->create($request)){
            flash()->success('Thêm thuộc tính thành công');
            return redirect()->route('attributecatalogue.index');
        }else{
            flash()->error('Thêm thuộc tính không thành công');

            return redirect()->route('attributecatalogue.create');
        }
    }
    public function edit($id)
    {
        $attributeC=$this->attributeCRepository->findById($id);
        $title='Sửa loại thuộc tính';
        $template  = 'attributecatalogue.update';
        return view ('dashboard.index',compact('template','title','attributeC'));

    }
    public function update($id,AttributeCUpdateRequest $request)
    {
        if($this->attributeCService->update($id, $request)){
            flash()->success('Sửa loại thuộc tính thành công');
            return redirect()->route('attributecatalogue.index');
        }else{
            flash()->error('Sửa loại thuộc tính không thành công');
            return redirect()->route('attributecatalogue.edit');
        }
    }

    public function destroy($id)
    {
        if($this->attributeCRepository->delete($id)){
            flash()->success('Xóa thuộc tính thành công');
            return redirect()->route('attributecatalogue.index');
        }else{
            flash()->error('Xóa thuộc tính không thành công');
            return redirect()->route('attributecatalogue.index');
        }


    }

}
