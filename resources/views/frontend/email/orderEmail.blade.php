<div style="width:600px; margin: 0 auto ">
    <div style="text-align: center">
        <h2>Xin chào {{$user->name}}</h2>
        <p>Bạn đã đặt hàng taị hệ thống của chúng tôi, vui lòng kiểm tra lại thông tin đơn hàng của bạn </p>

    </div>
    <h3>Người đặt hàng</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
        <tr>
            <th>Người đặt hàng</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{$user->phone}}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{$user->address}}</td>
        </tr>
    </table>

    <h3>Người nhận hàng</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
        <tr>
            <th>Tên người nhận hàng</th>
            <td>{{$orders->recipient_name}}</td>

        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{$orders->phone}}</td>
        </tr>
        <tr>
            <th>Địa chỉ nhận hàng</th>
            <td>{{$orders->address}}</td>
        </tr>
    </table>
    <h3>Thông tin sản phẩm</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderItems  as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nameProduct}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->totals}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

</div>
