<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nisn' => 'required|string',
            'name' => 'required|string',
            'date_of_birth' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nisn.required' => 'NISN/NIP harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'status.required' => 'Status harus diisi.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
        ];
    }
}