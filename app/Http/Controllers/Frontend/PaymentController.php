<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    protected $attributeCService;
    protected $attributeService;
    protected $attributeRepository;
    protected $categoryRepository;
    protected $categoryService;

    public function __construct(UserService $userService, ProvinceRepository $provinceRepository, UserRepository $userRepository,AttributeCService $attributeCService, AttributeService $attributeService,AttributeRepository $attributeRepository,CategoryRepository $categoryRepository,CategoryService $categoryService)
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
        $this->attributeCService = $attributeCService;
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $province = $this->provinceRepository->all();
        $category=$this->categoryService->all();
        $product=$request->input('product_id');
        $totals=0;

        $products=Product::with('mainImage','category','attributes')->where('id',$product)->first();

        if($products){
            $totals=$products->price;
        }
        else{
            $totals=0;
        }
        $cartItems = Cart::where('user_id', Auth::id())->with('product','product.mainImage')->get();
       if($cartItems){
           foreach ($cartItems as $cartItem) {
               $totals += $cartItem->product->price * $cartItem->quantity;
           }
       }else{
           $totals=0;
       }
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"'
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',


            ]];
        $template='frontend.payment.index';
        return view('frontend.index',compact('template','config','province','category','cartItems','products','totals'));
    }
    public function store(Request $request){
        $request->validate([
            'recipient_name' => 'required',
            'phone' => 'required',
            'payment' => 'required',
            'address' => 'required',
        ]);
        $user=Auth::user();

        $productIds =$request->input('product_id');
        $nameProducts=$request->input('nameProduct');
        $quantities = $request->input('quantity');
        $orderItems = [];
        if (is_array($productIds) && is_array($quantities) ) {
            // Nếu là mảng, xử lý nhiều sản phẩm
            $totalOrder = 0;
            foreach($productIds as $index => $productId){
                $product = Product::find($productId);

                $totalOrder += $product->price * $quantities[$index];
            }
        } else {
            // Nếu không phải mảng, chỉ xử lý một sản phẩm
            $product = Product::find($productIds); // $productIds và $quantities chỉ là giá trị đơn lẻ
            $totalOrder = $product->price * $quantities;
        }


        $orders=Order::Create([
            'recipient_name' => $request->recipient_name,
            'phone' => $request->phone,
            'totals' => $totalOrder,
            'payments' => $request->payment,
            'address' => $request->address,
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);


        $totals=0;
        if (is_array($productIds) && is_array($quantities) && is_array($nameProducts) ) {
            // Nếu là mảng, xử lý nhiều sản phẩm
            $totals = 0;
            foreach($productIds as $index => $productId){
                $nameProduct=$nameProducts[$index];
                $quantity = $quantities[$index];
                $products = Product::find($productId);
                $totals+=$products->price*$quantity;
                $orderItem=OrderItem::create([
                    'order_id' => $orders->id,  // ID của order mới tạo
                    'product_id' => $products->id,
                    'nameProduct'=>$nameProduct,
                    'quantity' => $quantity,
                    'totals'=>$totals

                ]);
                $orderItems[]=$orderItem;
            }
        } else {
            // Nếu không phải mảng, chỉ xử lý một sản phẩm
            $product = Product::find($productIds); // $productIds và $quantities chỉ là giá trị đơn lẻ
            $totals = $product->price * $quantities;
            $orderItem=OrderItem::create([
                'order_id' => $orders->id,  // ID của order mới tạo
                'product_id' => $productIds,
                'nameProduct'=>$nameProducts,
                'quantity' => $quantities,
                'totals'=>$totals

            ]);
            $orderItems[]=$orderItem;
        }

        Mail::send('frontend.email.orderEmail',compact('user','orders','orderItems'),function($email) use ($user){
            $email->subject('MyShopping_ Xác nhận đơn hàng');
            $email->to($user->email,$user->name);
        });
        Cart::where('user_id', Auth::id())->delete();
        flash()->success('Đặt hàng thành công');
        return redirect()->route('home.index');
    }

}
