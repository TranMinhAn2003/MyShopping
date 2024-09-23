@include('dashboard.layout.breadcrumb' )
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('attributecatalogue.update',$attributeC->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h4>Sửa loại thuộc tính</h4>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name"  class="form-control" value="{{$attributeC->name}}">
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
    </div>

</form>





