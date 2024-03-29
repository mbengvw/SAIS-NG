<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'no_daftar' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'jk' => 'required|in:L,P',
            'angkatan' => 'required',
            'jalur' => 'required|in:PRESTASI,REGULER,PINDAHAN',
            'asal_sltp' => 'required',
        ];
    }
}
