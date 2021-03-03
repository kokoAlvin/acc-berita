<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BlogStoreRequest extends FormRequest
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
            //
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }

    public function messages(){
        return[
            'title.required' => 'Judul Tidak boleh kosong',
            'title.max' => 'Panjang karakter maksimal pada judul adalah 255 karakter',
            'content.required' => 'Kontent tidak boleh kosong'
        ];
    }
}
