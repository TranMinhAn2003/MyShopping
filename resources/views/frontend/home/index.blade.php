
    <div class="product-section">
        <div class="product-slide">
            <div class="product-inner">
                <div id="featuredProductsCarousel" class="carousel slide" data-ride="carousel">
                    <h1 class="fashion_taital">Sản phẩm nổi bật</h1>
                    <div class="carousel-inner">
                        @foreach($featuredProduct->chunk(4) as $featuredChunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach($featuredChunk as $featured)
                                        <div class="featured_iteam">
                                            <div class="featured_main">
                                                <h4 class="shirt_text">{{ $featured->name }}</h4>
                                                <p class="price_text">Price <span style="color: #262626;"> {{ number_format($featured->price) }}VND</span></p>
                                                <div class="tshirt_img">
                                                    <img src="{{ asset('storage/' .$featured->mainImage->path ?? 'images/default-image.png') }}" alt="{{ $featured->name }}" class="img-fluid">
                                                </div>
                                                <div class="btn_main">
                                                    <form action="{{route('payment.index')}}" method="GET">
                                                        @csrf
                                                        <input type="text" value="{{$featured->id}}" name="product_id" hidden>

                                                        <input type="submit" class="btn btn-primary" value="Buy now">
                                                    </form>
                                                    <form action="{{route('cart.add')}}" method="POST" class="setup-add-cart">
                                                        @csrf
                                                        <div class="add_bt">
                                                            <input type="text" value="{{$featured->id}}" name="product_id" hidden>
                                                            <input type="text" value="{{$featured->name}}" name="name" hidden>
                                                            <input type="number" value="1" min="1" name="quantity" hidden>
                                                            <input type="submit"  class="btn btn-primary" value="Add Cart">
                                                        </div>
                                                    </form>
                                                    <div class="seemore_bt "><a href="{{ route('home.show', $featured->id) }}" class="btn btn-primary">See More</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#featuredProductsCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#featuredProductsCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-setup" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<div class="fashion">
    <div class="new-slide" >
        <div class="new-inner">
            <div class="new-item active">
                <div class="container">
                                <h1 class="new_taital">{{ request('category_id') ? $category->firstWhere('id', request('category_id'))->name : 'Sản phẩm mới nhất' }}</h1>
                    @foreach($products->chunk(9) as $productChunk)
                        <div class="new-item {{ $loop->first ? 'active' : '' }}">
                            <div class="fashion_section_2">
                                <div class="row">
                                    @foreach($productChunk as $product)
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="box_main">
                                                <h4 class="shirt_text">{{ $product->name }}</h4>
                                                <p class="price_text">Price <span style="color: #262626;">{{ number_format($product->price)  }}VND</span></p>
                                                <div class="tshirt_img">
                                                    <img src="{{ asset('storage/' .$product->mainImage->path ?? 'images/default-image.png') }}" alt="{{ $product->name }}">
                                                </div>
                                                <div class="btn_main">
                                                    <form action="{{route('payment.index')}}" method="GET">
                                                        @csrf
                                                        <input type="text" value="{{$product->id}}" name="product_id" hidden>

                                                        <input type="submit" class="btn btn-primary" value="Buy now">
                                                    </form>

                                                    <form action="{{route('cart.add')}}" method="POST" class="setup-add-cart">
                                                        @csrf
                                                        <div class="add_bt">
                                                            <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                                            <input type="text" value="{{$product->name}}"  name="name" hidden>
                                                            <input type="number" value="1" min="1"  name="quantity" hidden>
                                                            <input type="submit"  class="btn btn-primary" value="Add Cart">
                                                        </div>
                                                    </form>

                                                    <div class="seemore_bt "><a href="{{ route('home.show', $product->id) }}" class="btn btn-primary">See More</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->appends(request()->all())->links('dashboard.layout.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>


{{--<script>--}}
{{--    document.getElementById('category_id').addEventListener('change', function () {--}}
{{--        // Lấy tên của danh mục được chọn--}}
{{--        var selectedText = this.options[this.selectedIndex].text;--}}

{{--        // Cập nhật nội dung của thẻ h1--}}
{{--        document.getElementById('category-title').innerText = selectedText;--}}

{{--        // Nếu muốn submit form sau khi thay đổi (như trong onchange="this.form.submit()"):--}}
{{--        document.getElementById('categoryForm').submit();--}}
{{--    });--}}
{{--</script>--}}

