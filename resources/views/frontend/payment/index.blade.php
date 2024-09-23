
<section class="bg-light my-5">

    <div class="container-fluid">
        <form action="{{route('payment.store')}}" method="post">
            @csrf
        <div class="row ">
            <!-- cart -->
            <div class="col-lg-8 setup-show-cart">
                <div class="card border shadow-0">
                    <div class="m-4">

                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h4>Thông tin nhận hàng </h4>
                                            </div>

                                            <div class="ibox-content">

                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-right">Họ tên người nhận <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="recipient_name"  class="form-control" value="{{ old('recipient_name')}}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb10 mr10">
                                                    <div class="col-lg-10">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-right">Số điện thoại  <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="phone"  class="form-control" value="{{old('phone')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb10 mr10">

                                                    <div class="col-lg-10">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-right">Phương thức thanh toán<span class="text-danger">(*)</span></label>
                                                        </div>
                                                        <select name="payment" id="" class="form-control">
                                                            <option value="">[Chọn phương thức thanh toán]</option>
                                                            <option value="1">Thanh toán khi nhận hàng</option>
                                                            <option value="2">Chuyển khoản ngân hàng</option>
                                                            <option value="3">Thẻ nội địa NAPAS</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row mb10 mr10">
                                                    <div class="col-lg-10">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-right">Địa chỉ  <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="address"  class="form-control" value="{{old('address')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb10 mr10">
                                                    <div class="col-lg-10">
                                                        <div class="form-row">
                                                            <label for="" class="control-label text-right">Ghi chú  </label>
                                                            <input type="text" name="note"  class="form-control" value="{{old('note')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                        <div class="text-right setup-payment-button ">--}}
{{--                                            <button class="btn btn-primary" type="submit" >Lưu lại </button>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>


                </div>
                </div>
            </div>
            <div class="col-lg-3 setup-show-cart">
                <div class="card border shadow-0">
                    @if(!empty($products))
                        <div class="row gy-3 mb-4">
                            <div class="col-lg-7">
                                <div class="me-lg-5 setup-payment-img">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' .$products->mainImage->path  ?? 'images/default-image.png') }}" class="border rounded me-3" style="width: 96px; height: 96px;" alt="{{$products->name}}"/>
                                        <div class="">
                                            <a href="#" class="nav-link">{{$products->name}}</a>
                                            <input type="text" name="product_id"  class="form-control" value="{{$products->id}}" hidden>
                                            <input type="text" name="nameProduct"  class="form-control" value="{{$products->name}}" hidden>
                                            <input type="text" name="quantity"  class="form-control" value="1" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 ">

                                <div class="setup-payment-price">
                                    <text class="h6">${{ $products->price }}</text> <br />
                                </div>
                            </div>

                        </div>
                    @else
                @foreach($cartItems as $item)
                    <div class="row gy-3 mb-4">
                        <div class="col-lg-7">
                            <div class="me-lg-5 setup-payment-img">
                                <div class="d-flex">
                                    <img src="{{ asset('storage/' .$item->product->mainImage->path ?? 'images/default-image.png') }}" class="border rounded me-3" style="width: 96px; height: 96px;" alt="{{$item->name}}"/>
                                    <div class="">
                                        <a href="#" class="nav-link">{{$item->name}}</a>
                                        <input type="text" name="product_id[]"  class="form-control" value="{{$item->product->id}}" hidden>
                                        <input type="text" name="nameProduct[]" class="form-control" value="{{$item->product->name}}" hidden>
                                        <input type="text" name="quantity[]"  class="form-control" value="{{$item->quantity}}" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 ">

                            <div class="setup-payment-price">
                                <text class="h6">${{ $item->product->price }}</text> <br />
                            </div>
                        </div>

                    </div>
                @endforeach
                    @endif
                    <hr />
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Shipping :</p>
                        <?php
                        $ship=50000;
                        ?>
                        <p class="mb-2 text-success">{{number_format($ship)}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Total price:</p>
                        <p class="mb-2 fw-bold">{{number_format($totals+$ship)}}</p>
                    </div>
                    <div class="text-right setup-payment-button ">
                        <button class="btn btn-primary  setup-payment-text" type="submit" >Đặt hàng </button>
                    </div>
            </div>

            </div>
        </div>
        </form>
    </div>

</section>





