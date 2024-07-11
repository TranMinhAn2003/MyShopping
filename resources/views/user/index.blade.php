@include('dashboard.layout.breadcrumb' )
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách thành viên </h5>
                    <div class="ibox-tools">
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <form action="{{route('user.index')}} " method="GET">
                    <div class="ibox-content">
                        <div class="filter">
                            <div class="row">
                                <div class="col-lg-6 hr ">
                                    <div class="form-row hf">
                                        <select name="user_agent" class="form-control">
                                            <?php
                                            $user_agent = [
                                                '[Chọn nhóm thành viên]',
                                                'Quản trị viên',
                                                'Cộng tác viên'
                                            ];
                                            ?>
                                            @foreach($user_agent as $key => $val)
                                                <option value="{{ $key }}" {{ $key == old('user_agent', request('user_agent')) ? 'selected' : '' }}>
                                                    {{ $val }}
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
                            <a  href="{{route('user.create')}}" class="btn btn-primary mb-5 "> <i class="fa fa-plus" ></i> Thêm mới thành viên </a>
                        </div>
                    </div>
                </form>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Họ tên </th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Giới tính</th>
                            <th class="text-center ">Tình trạng</th>
                            <th class="text-center" colspan="2">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                       @foreach($user as $index => $use)
                            <tr>

                                <td class="text-center"> {{ ($user->currentPage() - 1) * $user->perPage() + $loop->iteration }}</td>
                                <td class="text-center">{{$use->name}}</td>
                                <td class="text-center">{{$use->email}}</td>
                                <td class="text-center address_user">{{$use->address}}</td>
                                <td class="text-center">{{$use->phone}}</td>
                                <td class="text-center">{{$use->gender}}</td>
                                <td class="text-center js-switch-{{$use->id}}"           >
                                    <input type="checkbox" value="{{$use->publish}}" class="js-switch status " data-field="publish" data-model="User" {{($use->publish==1) ? 'checked':''}} data-modelId="{{$use->id}}"/>
                                </td>
                                <td class="text-center ">
                                    <a href="{{route('user.edit',$use->id)}}" class=" btn btn-success btnedit "><i class="fa fa-edit"></i></a>
                                </td>

                                <td class="text-center ">
                                    <a href="{{route('user.delete',$use->id)}}" class=" btn btn-danger btnedit "><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                    {{ $user->links('dashboard.layout.pagination') }}
                </div>
            </div>
        </div>
    </div>

