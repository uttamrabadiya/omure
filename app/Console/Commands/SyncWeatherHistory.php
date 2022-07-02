<?php

namespace App\Console\Commands;

use App\Jobs\FetchWeatherHistoryByCityDate;
use App\Services\WeatherBitService;
use Illuminate\Console\Command;

class SyncWeatherHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:weather:history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cityNames = config('weather.city_names');
        $date = now()->format('Y-m-d');
        FetchWeatherHistoryByCityDate::dispatch($cityNames, $date);
        return 0;
    }
}
