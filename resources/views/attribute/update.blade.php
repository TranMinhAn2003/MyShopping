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
<form action="{{route('attribute.update',$attribute->id)}}" method="post">
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
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name"  class="form-control" value="{{$attribute->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Loại thuộc tính<span class="text-danger">(*)</span></label>
                                    <select name="attribute_catalogue_id" class="form-control setupSelect2">
                                        <option value="0">[Chọn loại thuộc tính]</option>
                                        @foreach($attributeC as $attributes)
                                            <option value="{{ $attributes->id }}"
                                                    @if($attribute->attribute_catalogue_id == $attributes->id) selected @endif>
                                                {{ $attributes->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                        <div class="text-right ">
                            <button class="btn btn-primary mt-3" type="submit" >Lưu lại </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<script>
    var attribute_catalogue_id = '{{(isset($attributeC->id)) ? $attributeC->id : old('attribute_catalogue_id') }}';
</script>



