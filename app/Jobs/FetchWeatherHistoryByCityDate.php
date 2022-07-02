<?php

namespace App\Jobs;

use App\Models\WeatherHistory;
use App\Services\WeatherBitService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchWeatherHistoryByCityDate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $cityName;

    protected string $date;

    /**
     * Create a new job instance.
     * @param string|array $cityName
     * @param string $date
     * @return void
     */
    public function __construct(string|array $cityName,string $date)
    {
        if(!is_array($cityName)) {
            $cityName = [$cityName];
        }
        $this->cityName = $cityName;
        $this->date = $date;
    }

    /**
     * Fetch Weather Data from WeatherBit & Store in database.
     * @return void
     */
    public function handle()
    {
        $weatherBitService = new WeatherBitService();
        foreach($this->cityName as $cityName) {
            $response = $weatherBitService->cityHistoryByDate($cityName, $this->date);
            $response = $this->formatResponse($response);
            WeatherHistory::updateOrCreate(['city' => $cityName, 'date' => $this->date], $response);
        }
    }

    /**
     * Format API Response.
     * @param array $response
     * @return array
     */
    public function formatResponse(array $response)
    {
        return [
            'temperature' => $response['data'][0]['temp'],
            'dew_point' => $response['data'][0]['dewpt'],
            'humidity' => $response['data'][0]['rh'],
            'wind_direction' => $response['data'][0]['wind_dir'],
            'wind_speed' => $response['data'][0]['wind_spd'],
            'wind_gust' => $response['data'][0]['wind_gust_spd'],
        ];
    }
}
