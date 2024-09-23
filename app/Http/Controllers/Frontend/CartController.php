<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Services\Interfaces\AttributeCServiceInterface as AttributeCService;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
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
    public function addCart(Request $request)
    {
        if(!Auth::check()){
            flash('error','Vui lòng đăng nhập để sử dụng chức năng này');
            return redirect()->route('index');
        }else{
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            $product = Product::findOrFail($request->product_id);

            $cart = Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                ],
                [
                    'name' => $product->name,
                    'quantity' => DB::raw('quantity + ' . $request->quantity)
                ]
            );
            flash()->success('Sản phẩm đã được thêm với gian hàng');
            return redirect()->route('home.index');
        }



    }
    public function showCart(Request $request)
    {

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
        $cartItems = Cart::where('user_id', Auth::id())->with('product','product.mainImage')->get();
        $totals=0;
        foreach ($cartItems as $cartItem) {
            $totals+=$cartItem->quantity*$cartItem->product->price;
        }
        $template='frontend.cart.show';
        return view('frontend.index', compact('cartItems','template','category','totals','products'));
    }
    public function updateQuantityCart(Request $request){
        $quantities = $request->input('quantities');

        foreach ($quantities as $productId => $quantity) {
            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        flash()->success('Sản phẩm đã được cập nhật trong gian hàng');
        return redirect()->route('show.cart');
    }
    public function deleteCart($id)
    {
        $cart = Cart::where('product_id',$id);
        $cart->delete();
        flash()->success('Sản phẩm đã được xoá khỏi gian hàng');
        return redirect()->route('show.cart');
    }
}
