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
            'files' => 'file|mimes:jpg,jpeg,png,gif|max:2048', // 允許的檔案格式和大小限制
        ];
    }
    public function messages(): array
    {
        return [
            'Bulletin_Title.required' => '公告標題是必填的。',
            'Bulletin_StartDate.required' => '開始日期是必填的。',
            'Bulletin_EndDate.required' => '結束日期是必填的。',
            'Bulletin_Content.required' => '公告內容是必填的。',
            'main_cate_id.required' => '請選擇一個分類。',
            'files.*.file' => '上傳的檔案必須是一個有效的文件。',
            'files.*.mimes' => '檔案格式必須是 jpg、jpeg、png 或 gif。',
            'files.*.max' => '檔案大小不能超過 2MB。',
        ];
    }
}
