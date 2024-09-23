@include('dashboard.layout.breadcrumb' )
@if ($errors->any())
    @csrf
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('attribute.store')}}" method="post">
        @csrf

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Tạo mới thuộc tính</h4>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name"  class="form-control" value="{{ old('name')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div    class="form-row">
                                    <label for="" class="control-label text-right">Loại thuộc tính <span class="text-danger">(*)</span></label>
                                <select name="attribute_catalogue_id" class=" form-control setupSelect2 " >
                                    <option  value="-1" >[Chọn loại thuộc tính]</option>
                                    @foreach($attributeC as $attribute)
                                        <option  value="{{$attribute->id}}" >{{$attribute->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        </div>

                        <div class="text-right create_attribute">
                            <button class="btn btn-primary" type="submit" >Lưu lại </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>





