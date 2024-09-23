<div style="width:600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{$user->name}}</h2>
        <p>Bạn đã đăng ký tài khoản tại MyShopping hệ thống cuả chúng tôi</p>
        <p>Để có thể tiếp tục sử dụng các dịch vụ của chúng tôi bạn vui lòng nhấn vào nút kích hoạt bên dưới để kích hoạt tài khoản </p>
        <p>
            <a href="{{route('register.active',['user'=>$user->id,'token'=>$user->token])}}"
             style="display:inline-block;background: green;color: #fff;padding: 7px 25px;
              font-weight: bold">Kích hoạt tài khoản</a>
        </p>
    </div>
</div>
