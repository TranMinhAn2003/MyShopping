<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{route('register.storeStep2')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h4>Register</h4>
                        </div>
                        <div class="ibox-content">
                            <div class="row ">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right">Họ tên <span class="text-danger">(*)</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row setup-register ">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right">Giới tính<span class="text-danger">(*)</span></label>

                                        <?php
                                        $genders=[
                                            '[Giới tính]','Nam','Nữ'
                                        ]
                                        ?>
                                        <select name="gender"  class="form-control" >
                                            @foreach($genders as $key=>$val)
                                                <option {{$key == (old('gender'))? 'selected' : ''}} value="{{$key}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right"> Số điện thoại <span class="text-danger">(*)</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right"> Ngày sinh  <span class="text-danger">(*)</span></label>
                                        <input type="date" name="birthday"  id="birthday" class="form-control" value="{{ old('birthday')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right">Thành phố <span class="text-danger">(*)</span></label>
                                        <select id="province_id" name="province_id" class="form-control">
                                            <option value="">[Chọn tỉnh/Thành phố]</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->code}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right">Quận/ huyện  <span class="text-danger">(*)</span></label>
                                        <select name="district_id" id="district_id" class="form-control">
                                            <option value="">[Chọn Quận/Huyện]</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right ">Phường/Xã<span class="text-danger">(*)</span></label>

                                        <select id="ward_id" name="ward_id" class="form-control">
                                            <option value="">[Chọn Phường/Xã]</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="" class="control-label text-right">Địa chỉ  <span class="text-danger">(*)</span></label>

                                        <input type="text" name="address"  class="form-control" value="{{old('address')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-register">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <button class="btn btn-primary" type="submit" >Lưu lại </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#province_id').change(function() {
            var idProvince = $(this).val();  // Lấy giá trị của tỉnh
            $('#state-dd').html('');

            $.ajax({
                url: "/api/fetch-district",
                type: 'POST',
                dataType: 'json',
                data: {province_code: idProvince,_token:"{{ csrf_token() }}"},
                success:function(response){
                    $('#district_id').html('<option value="">[Chọn Quận/Huyện]</option>');
                    $.each(response.district,function(index, val){
                        $('#district_id').append('<option value="'+val.code+'"> '+val.name+' </option>')
                    });
                    $('#ward_id').html('<option value="">[Chọn Phường/Xã]</option>');
                }
            })
        });
    });
    $('#district_id').change(function(event) {
        var idWard = this.value;
        $('#ward_id').html('');
        $.ajax({
            url: "/api/fetch-ward",
            type: 'POST',
            dataType: 'json',
            data: {district_code: idWard,_token:"{{ csrf_token() }}"},
            success:function(response){
                $('#ward_id').html('<option value="">[Chọn Phường/Xã]</option>');
                $.each(response.ward,function(index, val){
                    $('#ward_id').append('<option value="'+val.code+'"> '+val.name+' </option>')
                });
            }
        })
    });

</script>
</body>
</html>
