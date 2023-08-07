<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HukdisRequest extends FormRequest
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
            'id_hukdis' => 'required|not_in:0',
            'id_grouping' => 'required|not_in:0',
        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id_hukdis.not_in:0' => 'Hukdis harus diisi!',
            'id_grouping.not_in:0' => 'Siswa harus dipilih!',
        ];
    }
}
