<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\{Province, District, User, Ward};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function index()
    {
        return view('frontend.register.register1');
    }


    public function fatchDistrict(Request $request)
    {
        $data['district'] = District::where('province_code',$request->province_code)->get(['name','code']);

        return response()->json($data);
    }
    public function fatchWard(Request $request)
    {
        $data['ward'] = Ward::where('district_code',$request->district_code)->get(['name','code']);

        return response()->json($data);
    }
    public function storeStep1(Request $request){

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        session([
            'email' => $request->input('email'),

            'password' => bcrypt($request->input('password')),

        ]);

        return redirect()->route('register.formStep2');
    }

    public function formStep2(){
        $provinces = Province::all();
        return view('frontend.register.register2',compact('provinces'));
    }
    public function storeStep2(Request $request)
    {
        $token=strtoupper(Str::random(10));
        $gender=$request->input('gender');
        if (isset($gender)) {
            switch ($gender) {
                case '1':
                    $gender = 'Nam';
                    break;
                case '2':
                    $gender = 'Nữ';
                    break;

            }
        }

        $user=User::create([
            'email'=>session('email'),
            'name'=>$request->input('name'),
            'gender'=>$gender,
            'phone'=>$request->input('phone'),
            'birthday'=>$request->input('birthday'),
            'password'=>session('password'),
            'province_id'=>$request->input('province_id'),
            'district_id'=>$request->input('district_id'),
            'ward_id'=>$request->input('ward_id'),
            'address'=>$request->input('address'),
            'token'=>$token
        ]);
        session()->forget(['email','password']);
        if($user){
            Mail::send('frontend.email.active_account_email',compact('user'),function($email) use($user){
                $email->subject('MyShopping - Xác nhận tài khảon');
                $email->to($user->email,$user->name);
            });
            auth()->login($user);
            flash()->success('Xác nhận đã được gửi đến mail của bạn. Vui lòng xác nhận tài khoản');
            return redirect()->route('index');
        }else{
            flash()->error('Tài khoản tạo không thành công');
            return redirect()->route('register.formStep2');
        }


    }
    public function active(User $user,$token){
        if($user->token===$token){
            $user->update(['status'=>1,'token'=>null]);
            flash()->success('Xác nhận thành công , bạn có thể đăng nhập');
            return redirect()->route('index');
        }else{
            flash()->error('Mã xác nhận không hợp lệ');
            return redirect()->route('index');
        }
    }

}
