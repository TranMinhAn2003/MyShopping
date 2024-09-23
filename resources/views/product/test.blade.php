<form action="{{route('product.add')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="ibox-title">
        <h4>Thêm hình ảnh sản phẩm</h4>
        <input type="file" name="images[]" id="images" multiple="multiple" accept="image/*">
        <div id="image-preview" ></div>
    </div>
    <div class="text-right ">
        <button class="btn btn-primary" type="submit" >Lưu lại </button>
    </div>
</form>
<script>
    const input = document.getElementById('images');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', () => {
        const files = input.files;
        if (files) {
            preview.innerHTML = '';
            Array.from(files).forEach(file => {
                if (!file.type.match('image.*')) {
                    alert('Vui lòng chọn file ảnh!');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;

                    // Đảm bảo ảnh đã tải hoàn toàn trước khi resize
                    img.onload = () => {
                        resizeImages(img, 100, 100); // Thay đổi kích thước theo ý muốn
                    };

                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });

    function resizeImages(img, maxWidth, maxHeight) {
        // Kiểm tra kích thước gốc của ảnh
        const originalWidth = img.naturalWidth;
        const originalHeight = img.naturalHeight;

        // Tính toán tỷ lệ chiều rộng và chiều cao
        let widthRatio = maxWidth / originalWidth;
        let heightRatio = maxHeight / originalHeight;

        // Lấy tỷ lệ nhỏ nhất để đảm bảo ảnh không bị bó méo
        const ratio = Math.min(widthRatio, heightRatio);

        // Áp dụng tỷ lệ mới cho ảnh
        img.style.width = originalWidth * ratio + 'px';
        img.style.height = originalHeight * ratio + 'px';
    }
</script>
