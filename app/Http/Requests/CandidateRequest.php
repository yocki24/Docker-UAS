<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'user_id' => 'required|unique:candidates,user_id',
                'order' => 'required|unique:candidates,order',
                'vision' => 'required',
                'mision' => 'required',
                'photo' => 'required|mimes:png,jpg|max:3072',
            ];
        } else {
            return [
                'user_id' => 'required',
                'order' => 'required',
                'vision' => 'required',
                'mision' => 'required',
                'photo' => 'mimes:png,jpg|max:3072',
            ];
        }
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Siswa harus diisi',
            'user_id.unique' => 'Siswa sudah terdaftar sebagai kandidat',
            'order.required' => 'Nomor urut harus diisi',
            'order.unique' => 'Nomor urut tersebut sudah terdaftar',
            'vision.required' => 'Visi harus diisi',
            'mision.required' => 'Misi harus diisi',
            'photo.required' => 'Foto harus diisi',
            'photo.mimes' => 'Foto harus berupa JPG|PNG',
            'photo.max' => 'Ukuran foto maksimal 3MB',
        ];
    }
}