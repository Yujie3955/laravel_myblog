<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBulletinRequest extends FormRequest
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
            'Bulletin_Title' => 'required|string|max:255',
            'Bulletin_StartDate' => 'required|date',
            'Bulletin_EndDate' => 'required|date',
            'Bulletin_Content' => 'required|string',
            'main_cate_id' => 'required|exists:main_cates,id', // 確保它存在於 main_cates 表中
        ];
    }
}
