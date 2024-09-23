<!DOCTYPE html>
<html>
<head>
    @include('dashboard.layout.head')
</head>
<body>
<div id="wrapper">
    @include('dashboard.layout.sidebar')
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('dashboard.layout.navbar')
        </div>
        @include($template)
    </div>
</div>
@include('dashboard.layout.right_sidebar')
@include('dashboard.layout.script')
</body>
</html>
