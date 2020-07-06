<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:75', 'min:5'],
            'location' => 'required',
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'limit' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Kamp etkinliğinize bir isim verin.',
            'title.min' => 'Etkinlik başlığı en az 10 karakter olmalıdır.',
            'title.max' => 'Etkinlik başlığı 75 karakteri geçemez',
            'location.required' => 'Kamp etkinliğiniz için konum bildiriniz.',
            'description.required' => 'Diğer kampdaşları bilgilendirmek için kamp etkinliğiniz hakkında bir açıklama yazısı girin.',
            'description.min' => 'Açıklama yazısı en az 10 karakter olmalıdır.',
            'description.max' => 'Açıklama yazısı en fazla 1000 karakter olabilir.',
            'limit.required' => 'Katılım kontenjanını belirleyiniz.',
            'start_date.required' => 'Etkinlik başlangıç tarihini giriniz.',
            'end_date.required' => 'Etkinlik bitiş tarihini giriniz.'
        ];
    }
}
