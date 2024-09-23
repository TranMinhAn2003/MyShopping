<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
//use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
//use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Backend\Controller;
use Illuminate\Support\Str;

class HomeController extends Controller

{
    protected $attributeCService;
    protected $attributeService;
    protected $attributeRepository;
    protected $categoryRepository;
    protected $categoryService;

    public function __construct( AttributeCService $attributeCService, AttributeService $attributeService,AttributeRepository $attributeRepository,CategoryRepository $categoryRepository,CategoryService $categoryService)
    {
        $this->attributeCService = $attributeCService;
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;

    }
    public function index(Request $request)
    {
        $category=$this->categoryService->all();
        $featuredProduct=Product::where('is_featured',1)->get();
        $categoryId = $request->input('category_id');
        $keyword = $request->input('keyword');
        $products = Product::with(['category', 'attributes', 'mainImage'])
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($keyword, function($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })->orderBy('created_at','desc')
            ->paginate(9);

        $template = 'frontend.home.index';
        return view('frontend.index',compact('template','products','category','featuredProduct'));
    }
    public function show($id,Request $request)
    {
        $product=Product::with(['category', 'attributes.attribute_catalogue', 'mainImage'])->findOrFail($id);
        $randomProducts = Product::with(['category', 'attributes.attribute_catalogue', 'mainImage'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $category=$this->categoryService->all();
        $categoryId = $request->input('category_id');
        $keyword = $request->input('keyword');
        $products = Product::with(['category', 'attributes', 'mainImage'])
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($keyword, function($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(9);
        $template ='frontend.home.show';
        return view('frontend.index',compact('products','template','category','product','randomProducts'));
    }
    public function forgetPass(){
        return view('frontend.password.forgetpass');
    }
    public function postforgetPass(Request $request){
        $request->validate([
            'email'=>'required|exists:users,email'
        ],[
            'email.required'=>'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists'=>'Email không tồn tại trong hệ thống',
        ]);
        $user=User::where('email',$request->email)->first();

        $token=strtoupper(Str::random(10));
        $user->update(['token' => $token]);
        Mail::send('frontend.email.emailForget',compact('user'),function($email) use($user) {
                $email->subject('MyShopping - Lấy lại mật khẩu tài khoản');
                $email->to($user->email, $user->name);

        });
        flash()->success('Vui lòng check Email để thực hiện thay đổi mật khẩu');
        return redirect()->route('forget-password');
    }
    public function getPass(User $user,$token){
        if($user->token===$token) {
            return view('frontend.password.getPass');
        }else
        {
            return abort(404);
        }

    }
    public function postPass(User $user ,$token,Request $request)
    {
        $request->validate([
            'password'=>'required',
            're_password'=>'required|same:password'
        ]);
        $password_h=bcrypt($request->input('password'));
        $user->update(['password'=>$password_h,'token'=>null]);
        flash()->success('Đặt lại mật khẩu thành công');
        return redirect()->route('index');
    }
}
