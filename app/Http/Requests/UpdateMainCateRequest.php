<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainCateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
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
            'MainCate_Name' => 'required|string|max:255',
            'Module_Name' => 'required|string|max:255'
        ];   

    }
    public function messages(): array
    {
        return [
            'MainCate_Name.required' => '名稱為必填項目。',
            'MainCate_Name.max' => '名稱不能超過 255 個字元。',
            'Module_Name.required' => '模組名稱為必填項目。',
            'Module_Name.max'=> '模組名稱不能超過 255 個字元。',
        ];
    }
}
