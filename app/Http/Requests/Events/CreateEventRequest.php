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
            'title' => ['required', 'string', 'max:255', 'min:10'],
            'location' => 'required',
            'county' => 'min:5',
            'description' => ['required', 'string', 'min:10'],
            'limit' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Başlık gerekli',
            'title.min' => 'En az 10 karakterden olusmak zorunda',
            'title.max' => '255 karakteri gecemez',
            'location.required' => 'Konum Gerekli',
            'county.min' => 'Sizinle birlikte kamp yapacak kampdaşların kamp yerini daha kolay bulabilmesi için lütfen daha ayrıntılı bir adres giriniz.<br/>
            Ör. Akvaryum Koyu, Bozcaada/Çanakkale, Türkiye&emsp;&emsp;&emsp;<strike>Bozcaada/Çanakkale, Türkiye</strike>',
            'description.required' => 'Aciklama gerekli',
            'description.min' => 'En az 10 karakterden olusmak zorunda',
            'limit.required' => 'Kontejyan gerekli',
            'start_date.required' => 'Baslangic tarihi gerekli',
            'end_date.required' => 'Bitis tarihi gerekli'
        ];
    }
}
