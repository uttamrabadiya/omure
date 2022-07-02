<?php

namespace App\Services;

use App\Exceptions\WeatherBitException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class WeatherBitService
{
    /**
     * @var Http
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.weatherbit.io/v2.0/');
        $this->apiKey = env('WEATHER_BIT_API_KEY');
    }

    /**
     * Get Weather History by given date & city name.
     * @param string $cityName
     * @param string $date
     *
     * @throws WeatherBitException
     * @return array
     */
    public function cityHistoryByDate(string $cityName, string $date)
    {
        $queryParams = [
            'key' => $this->apiKey,
            'start_date' => $date,
            'end_date' => Carbon::parse($date)->addDay()->format('Y-m-d'),
            'city' => $cityName,
        ];
        $response = $this->client->get('history/daily', $queryParams);

        if($response->status() !== 200) {
            //throw error.
            throw new WeatherBitException($response->json());
        }
        return $response->json();
    }
}
