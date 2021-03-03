<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'flag_active' => 'required|in:1,0'
            //
        ];
    }

    public function messages(){
        return[
            'id.required' => 'Terjadi Masalah',
            'title.required' => 'Judul Tidak boleh kosong',
            'title.max' => 'Panjang karakter maksimal pada judul adalah 255 karakter',
            'content.required' => 'Kontent tidak boleh kosong',
            'flag_active.required' => 'Status keaktifan blog wajib diisi',
            'flag_active.in' => 'status keaktifan blog wajib diisi'
        ];
    }
}
