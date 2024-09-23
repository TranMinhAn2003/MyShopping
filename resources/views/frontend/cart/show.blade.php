

<section class="bg-light my-5">
    <div class="container">
        <div class="row ">
            <!-- cart -->
            <div class="col-lg-9 setup-show-cart">
                <div class="card border shadow-0">
                    <div class="m-4">
                        <h4 class="card-title mb-4">Your shopping cart</h4>
                        <form action="{{ route('update.cart') }}" method="POST"  >
                            @csrf
                            @foreach($cartItems as $item)
                                <div class="row gy-3 mb-4">
                                    <div class="col-lg-5">
                                        <div class="me-lg-5">
                                            <div class="d-flex">
                                                <img src="{{ asset('storage/' .$item->product->mainImage->path ?? 'images/default-image.png') }}" class="border rounded me-3" style="width: 96px; height: 96px;" alt="{{$item->name}}"/>
                                                <div class="">
                                                    <a href="#" class="nav-link">{{$item->name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                        <div class="">
                                            <input type="number" class="setup-show-quantity" name="quantities[{{ $item->product_id }}]" value="{{$item->quantity}}" min="1">
                                        </div>
                                        <div class="setup-show-price">
                                            <text class="h6">{{ number_format($item->product->price*$item->quantity) }}VND</text> <br />
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                        <div class="float-md-end">
                                            <a href="{{route('remove.cart', $item->product_id)}}" class="btn btn-light border text-danger icon-hover-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(!empty($cartItems))
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Quantities</button>
                            </div>

                            @else
                                <div class="none"></div>
                            @endif

                        </form>
                    </div>

                    <div class="border-top pt-4 mx-4 mb-4">
                        <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
                        </p>
                    </div>
                </div>
            </div>
            <!-- cart -->
            <!-- summary -->
            <div class="col-lg-3 setup-show-cart">
                <div class="card mb-3 border shadow-0">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="form-label">Have coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border" placeholder="Coupon code" />
                                    <button class="btn btn-light border">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow-0 border setup-total">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total price:</p>
                            <p class="mb-2">{{number_format($totals)}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Shipping :</p>
                            <?php
                            $ship=50000;
                            ?>
                            <p class="mb-2 text-success">{{number_format($ship)}}</p>
                        </div>

                        <hr />
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total price:</p>
                            <p class="mb-2 fw-bold">{{number_format($totals+$ship)}}</p>
                        </div>

                        <div class="mt-3">
                            @if(!empty($cartItems) && count($cartItems) > 0)
                            <a href="{{route('payment.index')}}" class="btn btn-success w-100 shadow-0 mb-2">Make Purchase</a>
                                <a href="{{route('home.index')}}" class="btn btn-light w-100 border mt-2">Back to shop</a>
                            @else
                                <a href="{{route('home.index')}}" class="btn btn-light w-100 border mt-2">Back to shop</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- summary -->
        </div>
    </div>
</section>
