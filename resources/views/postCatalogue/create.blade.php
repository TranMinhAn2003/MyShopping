@include('dashboard.layout.breadcrumb')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="" method="post">
    @csrf

    <div class="wrapper wrapper-content animated fadeInRight ">
        <div class="row">
            <div class="col-lg-3 write">
                <div class="ibox">
                    <div class="ibox-title">
                        <label for="" class="control-label text-right">
                            Danh mục bài viết
                        </label>
                        <select name="" id="" class="form-control">
                            <option value="0">Chọn danh mục cha</option>
                            <option value="1">Root</option>
                        </select>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Chọn ảnh đại diện</h4>
                    </div>
                    <div class="ibox-content">
                        <div class="form-row imge">
                            <span class="image img-cover"><img src="{{asset('userfiles/image/3.jpg')}}" alt=""></span>
                            <input type="hidden" name="image" value="">
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Chọn tình trạng</h4>
                    </div>
                    <?php
                    $publish=[
                        '[Chọn tình trạng]','Xuất bản','Không xuất bản'
                    ]
                    ?>
                    <div class="ibox-content">
                        <div class="form-row ">
                            <select name="" id="" class="form-control">
                                @foreach($publish as $key=>$val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>  `
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Thông tin bài viết </h4>
                    </div>
                    <div class="ibox-content">
                                <div class="form-row mr10">
                                    <label for="" class="control-label text-right">Tiêu đề bài viết  <span class="text-danger">(*)</span></label>
                                    <input type="text" name="title"  class="form-control" value="{{ old('title')}}">
                                </div>
                                <div class="form-row mr10">
                                    <label for="" class="control-label text-right">Mô tả <span class="text-danger">(*)</span></label>
                                    <textarea  name="description"  class="form-control ck_editor" value="{{ old('description')}}" id="description"></textarea>
                                </div>
                        <div class="form-row mr10">
                            <label for="" class="control-label text-right">Nội dung  <span class="text-danger">(*)</span></label>
                            <textarea  name="content"  class="form-control ck_editor" value="{{ old('content')}}" id="content" autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="ibox SEO">
                        <div class="ibox-title">
                            <h4>Thông tin SEO </h4>
                        </div>
                        <div class="ibox-content">
                            <div class="form-row">
                                <div class="meta_title">
                                    <h3>Kamen rider - Giá Tốt, Miễn Phí Vận Chuyển, Đủ Loại</h3>
                                    <div class="urllink">
                                        <h5>http://gundamshop.vn/kamen-rider</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row ">
                            <div class="meta_description">
                                Mua kamen rider giao tận nơi và tham khảo thêm nhiều sản phẩm khác. Miễn phí vận chuyển toàn quốc cho mọi đơn hàng . Đổi trả dễ dàng. Thanh toán bảo mật.
                            </div>
                            </div>
                            <div class="form-row mr10">
                                <label for="" class="control-label text-right">Tiêu đề SEO</label>
                                <input type="text" name="meta_title"  class="form-control" value="{{ old('meta_title')}}">
                            </div>
                            <div class="form-row mr10">
                                <label for="" class="control-label text-right">Từ khóa SEO  </label>
                                <input type="text" name="meta_keyword"  class="form-control" value="{{ old('meta_keyword')}}">
                            </div>
                            <div class="form-row mr10">
                                <label for="" class="control-label text-right">Mô tả SEO  </label>
                                <textarea name="meta_description" class="form-control meta_description ck_editor" id="meta_description" value="{{ old('meta_description') }}"></textarea>

                            </div>

                            <div class="form-row mr10">
                                <label for="" class="control-label text-right">Đường dẫn SEO  </label>
                                <input type="text" name="url_link"  class="form-control" value="{{ old('url_link')}}">
                            </div>

                    </div>
                    <div class="text-right mr10 ">
                        <button class="btn btn-primary" type="submit" >Lưu lại </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>





