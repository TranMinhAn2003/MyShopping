@include('dashboard.layout.breadcrumb')


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="order_id">Order ID</label>
                    <input type="text" id="order_id" name="order_id" value="" placeholder="Order ID" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Order status</label>
                    <input type="text" id="status" name="status" value="" placeholder="Status" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Customer</label>
                    <input type="text" id="customer" name="customer" value="" placeholder="Customer" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_added">Date added</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added" type="text" class="form-control" value="03/04/2014">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_modified">Date modified</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified" type="text" class="form-control" value="03/06/2014">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="setup-order text-center" >Order ID</th>
                            <th class="text-center">Họ tên</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Địa chỉ </th>
                            <th class="text-center">Note</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" colspan="3">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($orders as $order)
                        <tr>
                            <td class="setup-order text-center">
                                {{$order->id}}
                            </td>
                            <td class="text-center">
                                {{$order->recipient_name}}
                            </td>
                            <td class="text-center">
                                {{$order->phone}}
                            </td>
                            <td class="text-center">
                                {{$order->totals}}
                            </td>
                            <td class="text-center">
                                {{$order->address}}
                            </td>
                            <td class="text-center">
                                {{$order->note ?? 'NULL'}}
                            </td>
                            <td>
                                <input type="text" value="{{ $order->status }}" hidden>
                                @if($order->status === 'pending')
                                    <form action="{{ route('order.accept', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Pending</button>
                                    </form>
                                @else
                                    <form action="{{route('order.accept',$order->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Accept</button>
                                    </form>
                                @endif

                            </td>
                            <td class="text-center">
                                <a href="{{route('order.detail',$order->id)}}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            </td>
                               <td class="text-center">
                                   <form action="{{route('order.destroy',$order->id)}}" method="post">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class=" btn btn-danger  " onclick=" return confirm('Bạn có muốn xóa không ?')" ><i class="fa fa-trash"></i></button>
                                   </form>

                            </td>
                        </tr>
@endforeach
                        </tbody>
                    </table>
                    {{$orders->links('dashboard.layout.pagination')}}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd; /* Đặt viền cho các ô */
        padding: 8px; /* Thêm khoảng đệm giữa nội dung và viền */
        text-align: center; /* Căn giữa nội dung */
    }
    th:nth-child(1), td:nth-child(1) {
        width: 5%; /* Cột Order ID */
    }
    th:nth-child(2), td:nth-child(2) {
        width: 15%; /* Cột Hoàn tên */
    }
    th:nth-child(3), td:nth-child(3) {
        width: 10%; /* Cột Số điện thoại */
    }
    th:nth-child(4), td:nth-child(4) {
        width: 10%;
    }
    th:nth-child(5), td:nth-child(5) {
        width: 22.5%;
    }
    th:nth-child(6), td:nth-child(6) {
        width: 22.5%;
    }
</style>
