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

<form action="{{route('user.update', $users->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Thông tin chung </h4>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{(isset($users->email) ? $users->email : '')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{(isset($users->name) ? $users->name : '')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb10 mr10">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giới tính<span class="text-danger">(*)</span></label>
                                </div>
                                <?php
                                $genders=[
                                    '[Giới tính]','Nam','Nữ'
                                ]
                                ?>
                                <select name="gender"  class="form-control" >
                                    @foreach($genders as $key=>$val)
                                        <option value="{{ $key }}" {{ (isset($users->gender) && $users->gender == $val) ? 'selected' : '' }}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhóm thành viên <span class="text-danger">(*)</span></label>
                                </div>
                                <select name="user_agent"  class="form-control" >
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
                                    <label for="" class="control-label text-right"> Số điện thoại <span class="text-danger">(*)</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{(isset($users->phone) ? $users->phone : old('phone'))}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right"> Ngày sinh  <span class="text-danger">(*)</span></label>
                                    <input type="date" name="birthday"  id="birthday" class="form-control" value="{{(isset($users->birthday) ? $users->birthday : old('birthday'))}}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb10 mr10">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Thành phố <span class="text-danger">(*)</span></label>
                                    <select name="province_id" class="  form-control setupSelect2  location province" data-target="districts" >
                                        <option  value="0" >[Chọn tỉnh/thành phố]</option>
                                        @foreach($province as $provinc)
                                            <option @if(old('province_id') == $provinc->code ) selected @endif value="{{$provinc->code}}" >{{$provinc->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Quận/ huyện  <span class="text-danger">(*)</span></label>
                                    <select name="district_id" class="form-control setupSelect2 location districts" data-target="wards" >
                                        <option value="0">[Chọn quận/huyện]</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb10 mr10">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right ">Phường/Xã<span class="text-danger">(*)</span></label>
                                </div>
                                <select name="ward_id"  class="form-control setupSelect2 wards ">
                                    <option value="0">[Chọn Phường/Xã]</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Địa chỉ  <span class="text-danger">(*)</span></label>
                                    <input type="text" name="address"  class="form-control" value="{{(isset($users->address) ? $users->address : old('address'))}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-right ">
                        <button class="btn btn-primary" type="submit" >Lưu lại </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var province_id = '{{(isset($users->province_id)) ? $users->province_id : old('province_id')}}'
    var district_id = '{{(isset($users->district_id)) ? $users-> district_id : old('district_id')}}'
    var ward_id = '{{(isset($users->ward_id)) ? $users->ward_id :old('ward_id')}}'
</script>




