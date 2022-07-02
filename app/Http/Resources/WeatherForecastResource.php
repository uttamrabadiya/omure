<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'city' => $this->city,
            'date' => $this->date,
            'temperature' => $this->temperature. '°C',
            'dew_point' => $this->dew_point.'°C',
            'humidity' => $this->humidity.'%',
            'wind_direction' => $this->wind_direction.'°',
            'wind_speed' => $this->wind_speed.'m/s',
            'wind_gust' =>  $this->wind_gust.'m/s',
        ];
    }
}
