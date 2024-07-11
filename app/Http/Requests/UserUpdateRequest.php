<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->id.'|string',
            'name' => 'required|string',
            'catalogue_id'=>'gt:0',
            'gender'=>'gt:0',
            'province_id'=>'gt:0',
            'district_id'=>'gt:0',
            'ward_id'=>'gt:0',

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
            'province_id.gt'=>'Bạn chưa chọn thành phố',
            'district_id.gt'=>'Bạn chưa chọn quận/huyện',
            'ward_id.gt'=>'Bạn chưa chọn phường/xã',
            'address.required'=>'Bạn chưa nhập địa chỉ ',
            'phone.required'=>'Bạn chưa nhập số điện thoại'


        ];
    }
}
