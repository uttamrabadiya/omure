<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherForecastRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validCityNames = config('weather.city_names');
        return [
            'city_name' => 'required|in:'.implode(',',$validCityNames),
            'date' => 'required|date_format:Y-m-d|before:tomorrow',
        ];
    }
}
