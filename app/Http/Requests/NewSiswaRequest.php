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
            'nama' => 'required',
            'nisn' => 'required',
            'nik' => 'required',
            'tahun_masuk'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ];
    }
}
