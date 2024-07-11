@include('dashboard.layout.breadcrumb')

<form action="{{route('user.destroy', $users->id)}}" method="post">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="row hh">
                    <span class="text-danger">* Chú ý : Sau khi xóa sẽ không thể khôi phục</span>
                </div>
                <div class="row h">
                    <span class="text-danger">* Hãy kiểm tra lại chính xác bản ghi muốn xóa </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Thông tin chung </h4>
                    </div>
                    <div class="ibox-content">

                            <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{(isset($users->email) ? $users->email : '')}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ tên </label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{(isset($users->name) ? $users->name : '')}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb10 mr10">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giới tính</label>
                                </div>
                                <?php
                                $genders=[
                                    '[Giới tính]','Nam','Nữ'
                                ]
                                ?>
                                <select name="gender"  class="form-control"  disabled>
                                    @foreach($genders as $key=>$val)
                                        <option value="{{ $key }}" {{ (isset($users->gender) && $users->gender == $val) ? 'selected' : '' }} readonly>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhóm thành viên </label>
                                </div>
                                <select name="user_agent"  class="form-control" disabled>
                                    <?php
                                    $user_agent=[
                                        '[Chọn nhóm thành viên]',
                                        'Quản trị viên',
                                        'Cộng tác viên'
                                    ]
                                    ?>
                                    @foreach($user_agent as $key => $val)
                                        <option value="{{ $key }}" {{ (isset($users->user_agent) && $users->user_agent == $val) ? 'selected' : '' }}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb10 mr10">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right"> Số điện thoại </label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{(isset($users->phone) ? $users->phone : old('phone'))}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right"> Ngày sinh  </label>
                                    <input type="date" name="birthday"  id="birthday" class="form-control" value="{{(isset($users->birthday) ? $users->birthday : old('birthday'))}}" readonly>
                                </div>
                            </div>
                        </div>
                    <div class="text-right mr10">
                        <a href="{{route('user.index')}}" class="btn btn-primary"  >Quay lại </a>
                        <button class="btn btn-danger" type="submit" > Xác nhận </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>





