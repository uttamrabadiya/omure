<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use App\Jobs\FetchWeatherHistoryByCityDate;
use App\Models\WeatherHistory;
use Carbon\Carbon;

class WeatherForecastController extends Controller
{
    public function getHistoryByCity(WeatherForecastRequest $request)
    {
        $cityName = $request->get('city_name');
        $date = Carbon::parse($request->get('date'))->format('Y-m-d');
        $data = WeatherHistory::where('city', $cityName)->where('date', $date)->first();
        if($data) {
            return response(['message' => 'success', 'data' => new WeatherForecastResource($data)]);
        }

        FetchWeatherHistoryByCityDate::dispatchSync($cityName, $date);

        $data = WeatherHistory::where('city', $cityName)->where('date', $date)->first();
        if($data) {
            return response(['message' => 'success', 'data' => new WeatherForecastResource($data)]);
        }

        return response(['message' => 'Weather data not available for selected date & city!'], 422);
    }
}
