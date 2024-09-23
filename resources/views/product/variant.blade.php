<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="ibox">
        <div class="ibox-title">
            <div class="row">
                <div class="col-lg-6">
                <label for="" class="control-label text-right">Tên sản phẩm <span class="text-danger">(*)</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                </div>
                <div class="col-lg-6">
                    <label for="" class="control-label text-right">Nhóm sản phẩm <span class="text-danger">(*)</span></label>
                    <select name="category_id" id="" class="form-control">
                        <option value="-1">--Chọn nhóm sản phẩm--</option>
                        @foreach($category as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>

        <div class="ibox-title">
            <div class="form-row">
                <label for="" class="control-label text-right">Mô tả sản phẩm <span class="text-danger">(*)</span></label>
                <textarea type="text" name="description" id="description" class="form-control" value="{{old('description')}}"></textarea>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">Giá <span class="text-danger">(*)</span></label>
                        <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">SKU <span class="text-danger">(*)</span></label>
                        <input type="text" name="sku" id="sku" class="form-control" value="{{old('sku')}}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-row">
                        <label for="" class="control-label text-right">Tồn kho <span class="text-danger">(*)</span></label>
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{old('quantity')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-row">
                        <label for="" class="control-label text-right">Sản phầm nổi bật  <span class="text-danger">(*)</span></label>
                        <input type="checkbox" name="is_featured" id="is_featured"  value="1" >
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox-title">
            <h4>Thêm hình ảnh sản phẩm</h4>
            <button type="button" id="select-images">Chọn hình ảnh</button>
            <input type="file" name="images[]" id="images" multiple="multiple" accept="image/*" style="display: none;">
            <div id="image-preview"></div>
        </div>
        <div class="ibox-title">
            <h4>Sản phẩm có nhiều thuộc tính</h4>
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
                <div class=" col-lg-3">
                    <button type="button" class=" addAttribute btn btn-primary "><i class="fa fa-plus"></i></button>
                </div>
                    <div class="text-right saveproduct ">
                    <button class="btn btn-primary" type="submit" >Lưu lại </button>
                </div>
            </div>
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

                    var removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = 'X';
                    removeBtn.onclick = function() {
                        preview.removeChild(div);
                        selectedFiles = selectedFiles.filter(f => f !== file);
                        updateFileList();
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

        // Update the button text
        var selectButton = document.getElementById('select-images');
        if (selectedFiles.length > 0) {
            selectButton.textContent = `${selectedFiles.length} file(s) selected`;
        } else {
            selectButton.textContent = 'Chọn hình ảnh';
        }
    }
</script>
