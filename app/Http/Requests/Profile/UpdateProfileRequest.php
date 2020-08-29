<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'photo' => ['mimes:jpeg,jpg,png', 'max:3000'],
            'bio' => ['required', 'min:20'],
            'name' => 'required',
            'city' => 'required',
            'birthday' => 'required',
            'password' => 'confirmed'
        ];
    }

    public function messages()
    {
        return [
            'photo.mimes' => 'Yüklediğiniz fotoğraf formatı jpeg, jpg veya png olmak zorundadır.',
            'photo.max' => 'Yüklediğiniz fotoğrafın boyutu 3mb üzeri olamaz.',
            'bio.required' => 'Kendinizi tanımlayan bir hakkında yazısı yazmanız gerekiyor.',
            'bio.min' => 'Hakkında yazısı 20 karakterden az olamaz.',
            'name.required' => 'İsim ve Soyisim alanı boş bırakılamaz.',
            'city.required' => 'Şehir alanı boş bırakılamaz.',
            'birthday.required' => 'Doğum tarihi alanı boş bırakılamaz.',
            'password:confirm' => 'Şifreleriniz eşleşmiyor.'
        ];
    }
}
