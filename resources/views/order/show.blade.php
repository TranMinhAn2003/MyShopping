@include('dashboard.layout.breadcrumb')

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="setup-order text-center" >Product ID</th>
                            <th class="text-center">Tên sản phẩm </th>
                            <th class="text-center">Số lương</th>
                            <th class="text-center">Tổng giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItems as $orderItem)
                            <tr>
                                <td class="setup-order text-center">
                                    {{$orderItem->product_id}}
                                </td>
                                <td class="text-center">
                                    {{$orderItem->nameProduct}}
                                </td>
                                <td class="text-center">
                                    {{$orderItem->quantity}}
                                </td>
                                <td class="text-center">
                                    {{$orderItem->totals}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
