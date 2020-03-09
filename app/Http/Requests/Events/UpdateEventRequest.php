<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'description' => ['required', 'string', 'min:10'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Başlık gerekli',
            'title.min' => 'En az 10 karakterden olusmak zorunda',
            'title.max' => '255 karakteri gecemez',
            'location.required' => 'Konum Gerekli',
            'description.required' => 'Aciklama gerekli',
            'description.min' => 'En az 10 karakterden olusmak zorunda',
        ];
    }
}
