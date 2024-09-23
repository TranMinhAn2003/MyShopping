<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeCreateRequest extends FormRequest
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
            'name' => 'required',
            'attribute_catalogue'=>'gt:0'
        ];
    }
    public function messages():array
    {
        return [
            'name.required' => 'Yêu cầu nhập tên thuộc tính',
            'attribute_catalogue.gt' => 'Vui lòng chọn loại thuộc tính',

        ];
    }
}
