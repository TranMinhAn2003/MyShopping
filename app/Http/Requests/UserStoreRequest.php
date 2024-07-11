<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users|string',
            'name' => 'required|string',

            'birthday'=>'required|date',
            'gender'=>'gt:0',
            'user_agent'=>'gt:0',
            'password'=>'required|string|min:8',
            're_password'=>'required|string|same:password',
            'province_id'=>'gt:0',
            'district_id'=>'gt:0',
            'ward_id'=>'gt:0',
            'address'=>'required|string',
            'phone'=>'required'
        ];
    }
    public function messages():array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email chưa đúng định dạng. Ví dụ abc@gmail.com',
            'email.unique' => 'Email đã tồn tại',
            'email.string'=>'Email phải là dạng ký tự ',
            'name.required'=>'Bạn chưa nhập họ tên',
            'name.string'=>'Họ tên phải là dạng ký tự',
            'user_agent.gt'=>'Bạn chưa chọn nhóm thành viên',
            'birthday.required'=>'Bạn chưa nhập ngày sinh',
            'birthday.date'=>'Ngày sinh phải có dạng dd/mm/yyyy',
            'gender.gt'=>'Bạn chưa chọn giới tính',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min'=>'Độ dài mật khẩu ít nhất là 8 ký tự',
            're_password.required'=>'Bạn chưa nhập lại mật khẩu',
            're_password.same'=>'Mật khẩu không trùng khớp',
            'province_id.gt'=>'Bạn chưa chọn thành phố',
            'district_id.gt'=>'Bạn chưa chọn quận/huyện',
            'ward_id.gt'=>'Bạn chưa chọn phường/xã',
            'address.required'=>'Bạn chưa nhập địa chỉ ',
            'phone.required'=>'Bạn chưa nhập số điện thoại'

        ];
    }
}
