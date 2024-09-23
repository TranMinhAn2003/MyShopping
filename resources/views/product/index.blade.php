@include('dashboard.layout.breadcrumb' )
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
</script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách sản phẩm </h5>
                    <div class="ibox-tools">
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <form action="{{route('product.index')}} " method="GET">
                    <div class="ibox-content">
                        <div class="filter">
                            <div class="row">
                                <div class="col-lg-6 hr ">
                                    <div class="form-row hf">
{{--                                        onchange="this.form.submit()"--}}
                                        <select name="category_id" id="category_id" class="form-control"  >
                                            <option value="">Chọn nhóm sản phẩm</option>
                                            @foreach($category as $cate)
                                                <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                                                    {{ $cate->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 hf ">
                                    <div class="form-row ">
                                        <input type="text" name="keyword" value="{{request('keyword') ?:old('keyword')}}" placeholder="Nhập từ khóa" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2 hf">
                                    <div class=form-row">
                                        <button type="submit" name="search" value="search" class="btn btn-primary ">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="create">
                            <a  href="{{route('product.create')}}" class="btn btn-primary mb-5 "> <i class="fa fa-plus" ></i> Thêm mới sản phẩm </a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tiêu đề</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Tồn kho</th>
                        <th class="text-center" colspan="2">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $products as $index => $product)
                        <tr>
                            <td class="text-center"> {{ $loop->iteration }}</td>
                            <td class="product-info">
                                <div class="col-lg-2">
                                    <img src="{{ asset('storage/' . $product->mainImage->path) }}" alt="{{ $product->name }}" width="60" height="60">
                                </div>
                                <div class="css">
                                    <h3 class="product-title ">{{ $product->name }}</h3>
                                    <p>
                                        <span  style="color: red;">Nhóm hiển thị:</span>
                                        <span style="color: black;">{{ $product->category->name }}</span>
                                    </p>

                                </div>
                            </td>
                            <td class="text-center">{{ $product->price }}<sup>đ</sup></td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <td class="text-center ">
                                <a href="{{route('product.edit',$product->id)}}" class=" btn btn-success btnedit "><i class="fa fa-edit"></i></a>
                            </td>

                            <td class="text-center ">
                                <form action="{{route('product.destroy',$product->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" btn btn-danger btnedit " onclick=" return confirm('Bạn có muốn xóa không ?')" ><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->appends(request()->all())->links('dashboard.layout.pagination') }}
            </div>
        </div>
    </div>
</div>

