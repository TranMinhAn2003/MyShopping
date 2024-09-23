<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\AttributteUpdateRequest;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use Illuminate\Support\Facades\Log;

;;;


class AttributeController extends Controller
{
    protected $attributeCService;
    protected $attributeService;
    protected $attributeRepository;
    public function __construct(AttributeCService $attributeCService,AttributeService $attributeService,AttributeRepository $attributeRepository)
    {
        $this->attributeCService = $attributeCService;
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
    }
    public function index()
    {
        $attributes = $this->attributeRepository->allAttribute(['*'], ['attribute_catalogue']);
        $template  = 'attribute.index';
        $title='Danh sách thuộc tính';
        return view('dashboard.index',compact('template','title','attributes'));
    }
    public function create(){
        $attributeC=$this->attributeCService->all();
        $title='Thêm thuộc tính';
        $template  = 'attribute.create';

        return view ('dashboard.index',compact('template','title','attributeC'));
    }
    public function store(AttributteUpdateRequest $request)
    {
        try {
            $result = $this->attributeService->create($request);

            if ($result) {
                flash()->success('Tạo thuộc tính thành công');
                return redirect()->route('attribute.index');
            } else {
                flash()->error('Tạo thuộc tính không thành công');
                return redirect()->route('attribute.create')->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo thuộc tính: ' . $e->getMessage());
            flash()->error('Đã xảy ra lỗi: ' . $e->getMessage());
            return redirect()->route('attribute.create')->withInput()->withErrors(['error' => 'Không thể tạo thuộc tính']);
        }
    }
    public function edit($id)
    {
        $attribute = $this->attributeRepository->findById($id);
        $attributeC=$this->attributeCService->all();
        $title='Sửa lại thuộc tính';
        $template  = 'attribute.update';
        return view ('dashboard.index',compact('template','title','attribute','attributeC'));
    }
    public function update($id,AttributteUpdateRequest $request)
    {
        if($this->attributeService->update($id,$request)){
            flash()->success('Sửa lại thuộc tính thành công');
            return redirect()->route('attribute.index');
        }else{
            flash()->error('Sửa lại thuộc tính không thành công');
            return redirect()->route('attribute.update');
        }
    }
    public function destroy($id)
    {
        if($this->attributeRepository->delete($id)){
            flash()->success('Xóa thuộc tính thành công');
            return redirect()->route('attribute.index');
        }else{
            flash()->error('Xóa thuộc tính không thành công');
            return redirect()->route('attribute.index');
        }


    }
}
