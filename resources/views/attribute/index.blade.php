@include('dashboard.layout.breadcrumb' )
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách thuộc tính </h5>
                    <div class="ibox-tools">
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <form action=" " method="GET">
                    <div class="ibox-content">
                        <div class="filter">
                            <div class="row">
                                <div class="col-lg-6 hr ">
                                    <div class="form-row hf">
                                        <div class="create">
                                            <a  href="{{route('attribute.create')}}" class="btn btn-primary mb-5 "> <i class="fa fa-plus" ></i> Thêm mới thuộc tính </a>
                                        </div>
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

                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên thuộc tính</th>
                        <th class="text-center">Loại thuộc tính</th>
                        <th class="text-center" colspan="2">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach($attributes as $index => $attribute)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }} </td>
                            <td class="text-center">{{$attribute->name}}</td>
                            <td class="text-center">{{$attribute->attribute_catalogue->name}}</td>
                            <td class="text-center ">
                                <a href="{{route('attribute.edit',$attribute->id)}}" class=" btn btn-success btnedit "><i class="fa fa-edit"></i></a>
                            </td>
                            <form action="{{route('attribute.destroy',$attribute->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            <td class="text-center ">
                                <button type="submit" class=" btn btn-danger btnedit " onclick=" return confirm('Bạn có muốn xóa không ?')" ><i class="fa fa-trash"></i></button>

                            </td>
                            </form>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


