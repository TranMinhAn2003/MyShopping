<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::orderBy('created_at','desc')->paginate(10);
        $title='Danh sách đơn hàng';
        $template='order.index';
        return view('dashboard.index',compact('template','orders','title'));
    }
    public function accept($id){
        $order=Order::find($id);
        if($order->status=='pending'){
            $order->status = 'accepted';
            flash()->success('Đơn hàng đã được phê duyệt');
        }else{
            $order->status = 'pending';
            flash()->success('Đơn hàng đã được hủy');
        }

        $order->save();

        return redirect()->route('order.index');
    }
    public function detail($id)
    {
        $orderItems=OrderItem::where('order_id',$id)->get();
        $title='Chi tiết đơn hàng';
        $template='order.show';
        return view('dashboard.index',compact('template','orderItems','title'));

    }
    public function destroy($id){

        $order=Order::find($id);
        if($order){
            $order->delete();
            flash()->success('Đơn hàng đã được xóa');
            return redirect()->route('order.index');
        }
        else{
            flash()->error('Đơn hàng đã xóa không có');
            return redirect()->route('order.index');
        }

    }

}
