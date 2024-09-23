<section class="py-5">
    <div class="container px-4 px-lg-5 my-5 show-product">
        <div class="row gx-4 gx-lg-5 ">
            <div class="col-md-6">
                <div class="main-image">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" />
                </div>
                <div class="thumbnail-images mt-3">
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-3">
                                <img class="img-thumbnail" src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" onclick="changeMainImage('{{ asset('storage/' . $image->path) }}')" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: {{$product->sku}}</div>
                <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">{{number_format($product->price)}}VND</span>
                </div>

                <div id="descriptionContainer" style="overflow: hidden; transition: max-height 0.3s ease;">
                    <p class="lead" id="productDescription">
                        {{ mb_substr($product->description, 0, 200) }} <!-- Hiển thị 200 ký tự đầu tiên -->
                        <span id="moreText" style="display: none;">{{ mb_substr($product->description, 200) }}</span> <!-- Phần mô tả ẩn -->
                    </p>
                </div>

                <button id="toggleDescription" class="btn btn-link p-0">Show more</button>
                <form action="{{route('cart.add')}}" method="POST">
                    @csrf
                    <div class="d-flex mt-3">
                        <input class="form-control text-center me-3" name="quantity" type="number"  style="max-width: 3rem" />
                        <input type="text" name="product_id" value="{{$product->id}}" hidden>
                        <input type="text" name="name" value="{{$product->name}}" hidden>
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Sản phẩm ngẫu nhiên</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($randomProducts as $random)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img src="{{ asset('storage/' . ($random->mainImage->path ?? 'images/default-image.png')) }}" alt="{{ $random->name }}">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ Str::limit($random->name, 20, '...') }}</h5>
                                {{ number_format($random->price) }} VND
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="{{ route('home.show', $random->id) }}">View options</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<script>
    document.getElementById('toggleDescription').addEventListener('click', function() {
        var moreText = document.getElementById('moreText');
        var btn = document.getElementById('toggleDescription');
        var descriptionContainer = document.getElementById('descriptionContainer');

        if (moreText.style.display === 'none') {
            moreText.style.display = 'inline'; // Hiện phần mô tả ẩn
            btn.textContent = 'Show less'; // Đổi văn bản nút
            descriptionContainer.style.maxHeight = descriptionContainer.scrollHeight + 'px'; // Mở rộng chiều cao phù hợp
        } else {
            moreText.style.display = 'none'; // Ẩn phần mô tả
            btn.textContent = 'Show more'; // Đổi về văn bản cũ
            descriptionContainer.style.maxHeight = '100px'; // Giới hạn chiều cao
        }
    });
</script>
<script>
    function changeMainImage(src) {
        document.querySelector('.main-image img').src = src;
    }
</script>
