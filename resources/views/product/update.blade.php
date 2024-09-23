<form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="ibox">
        <div class="ibox-title">
            <div class="row">
                <div class="col-lg-6">
                    <label for="" class="control-label text-right">Tên sản phẩm <span class="text-danger">(*)</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="col-lg-6">
                    <label for="" class="control-label text-right">Nhóm sản phẩm <span class="text-danger">(*)</span></label>
                    <select name="category_id" id="" class="form-control">
                        <option value="-1">--Chọn nhóm sản phẩm--</option>
                        @foreach($category as $cate)
                            <option value="{{$cate->id}}" {{ $cate->id == $product->category_id ? 'selected' : '' }}>{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="ibox-title">
            <div class="form-row">
                <label for="" class="control-label text-right">Mô tả sản phẩm <span class="text-danger">(*)</span></label>
                <textarea type="text" name="description" id="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">Giá <span class="text-danger">(*)</span></label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">SKU <span class="text-danger">(*)</span></label>
                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">Tồn kho <span class="text-danger">(*)</span></label>
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-row">
                        <label for="is_featured" class="control-label text-right">Sản phẩm nổi bật <span class="text-danger">(*)</span></label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                            {{ $product->is_featured == 1 ? 'checked' : '' }}>
                    </div>


                </div>
            </div>
        </div>

        <div class="ibox-title">
            <h4>Hình ảnh sản phẩm</h4>
            <button type="button" id="select-images">Chọn hình ảnh</button>
            <span class="text-danger">(* Ảnh chính là ảnh đầu tiên mà chọn tải lên!!!)</span>

            <div id="image-preview">
                @foreach($product->images as $image)
                        <div class="image-item" data-image-id="{{ $image->id }}">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" width="100px" height="100px">
                            <button type="button" class="remove-image" data-image-id="{{ $image->id }}">X</button>
                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                        </div>
                @endforeach
            </div>

            <input type="file" name="images[]" id="images" multiple="multiple" accept="image/*" style="display: none;">
            <input type="hidden" name="remove_images[]" id="remove_images" value="">
        </div>
        <div class="ibox-title">
            <h4>Sản phẩm có nhiều thuộc tính</h4>
        </div>

        <div class="ibox-content">
            <p class="text-danger">Các thuộc tính cũ đã tồn tại ! Vui lòng chọn lại từ đầu các loại thuộc tính và thuộc tính sản phẩm</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Loại thuộc tính</th>
                    <th scope="col">Giá trị thuộc tính</th>

                </tr>
                </thead>
                <tbody>
                @foreach($product->attributes as $attribute)
                <tr>

                        <th scope="row">{{$attribute->attribute_catalogue->name}}</th>
                        <td colspan="row">{{$attribute->name}}</td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ibox-content">
            <div class="row mtp10">
                <div class="col-lg-3 ">
                    <div class="variant-title">
                        Chọn loại thuộc tính
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="variant-select">
                        Chọn giá trị thuộc tính
                    </div>
                </div>
            </div>
            <div class="variant-body ">
                <div class="row variant-item">
                </div>
            </div>
            <div class="row variant-foot">
                <div class="col-lg-3">
                    <button type="button" class="addAttribute btn btn-primary"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox-footer">
        <div class="text-right saveproduct ">
            <button class="btn btn-primary" type="submit" >Lưu lại </button>
        </div>
    </div>
</form>
<script>
    var attributeCatalogue = @json($attributeCatalogue->map(function($item){
        return [
            'id' => $item->id,
'name' => $item->name        ];
    })->values());
</script>
<script>
    let selectedFiles = [];
    let imagesToRemove = []; // Mảng lưu các ảnh cũ cần xóa

    document.getElementById('select-images').addEventListener('click', function() {
        document.getElementById('images').click();
    });

    document.getElementById('images').addEventListener('change', function(event) {
        var preview = document.getElementById('image-preview');
        var files = event.target.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            selectedFiles.push(file);

            var reader = new FileReader();

            reader.onload = (function(file) {
                return function(e) {
                    var div = document.createElement('div');
                    div.className = 'image-item';

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100; // Kích thước ảnh preview
                    img.height = 100;

                    var removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = 'X';
                    removeBtn.onclick = function() {
                        // Gọi hàm xóa ảnh
                        removeImage(div, file);
                    };

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    preview.appendChild(div);
                };
            })(file);

            reader.readAsDataURL(file);
        }

        updateFileList();
    });

    function updateFileList() {
        var input = document.getElementById('images');
        var dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;

        // Cập nhật nút chọn ảnh
        var selectButton = document.getElementById('select-images');
        if (selectedFiles.length > 0) {
            selectButton.textContent = `${selectedFiles.length} file(s) selected`;
        } else {
            selectButton.textContent = 'Chọn hình ảnh';
        }
    }

    // Hàm xóa ảnh
    function removeImage(imageItem, file) {
        var imageId = imageItem.getAttribute('data-image-id'); // Lấy ID ảnh nếu có
        if (imageId) {
            // Thêm ID ảnh vào mảng cần xóa nếu chưa có
            if (!imagesToRemove.includes(imageId)) {
                imagesToRemove.push(imageId);
            }
            // Cập nhật input hidden
            document.getElementById('remove_images').value = imagesToRemove.join(',');
        }

        // Xóa ảnh khỏi giao diện
        imageItem.remove();

        // Cập nhật danh sách file đã chọn
        selectedFiles = selectedFiles.filter(f => f !== file);
        updateFileList();
    }

    // Xử lý xóa ảnh cũ
    document.querySelectorAll('.remove-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var imageItem = this.closest('.image-item');

            // Gọi hàm xóa ảnh
            removeImage(imageItem);
        });
    });

</script>
