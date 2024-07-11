<meta charset="utf-8">
<base href="{{config('app.url')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>INSPINIA | Dashboard</title>
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
@if(isset($config['css'])&& is_array($config['css']))
    @foreach($config['css'] as $key =>$val)
        {!! '<link rel="stylesheet" href="'.$val.'"> ' !!}
    @endforeach
@endif
<!-- Morris -->
<link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/setup.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script>
    var BASE_URL="{{config('app.url')}}";
</script>


