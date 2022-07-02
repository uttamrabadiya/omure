<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ForecastDataTest extends TestCase
{
    /**
     * A basic test feature.
     *
     * @return void
     */
    public function test_standard_api_call()
    {
        $cityNames = config('weather.city_names');
        $cityKey = array_rand($cityNames);
        $cityName = $cityNames[$cityKey];
        $date = now()->subDays(random_int(1, 20))->format('Y-m-d');

        $response = $this->get('/weather-data?city_name='.$cityName.'&date='.$date, ['Accept' => 'application/json']);

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('data.city', 'data.date', 'data.dew_point', 'data.humidity', 'data.temperature', 'data.wind_direction', 'data.wind_gust', 'data.wind_speed')->etc()
        );
    }

    public function test_invalid_city_name()
    {
        $cityName = 'Random String';
        $date = now()->subDays(random_int(1, 20))->format('Y-m-d');

        $response = $this->get('/weather-data?city_name='.$cityName.'&date='.$date, ['Accept' => 'application/json']);

        $response->assertStatus(422)->assertJson(fn (AssertableJson $json) =>
        $json->has('errors.city_name')->etc()
        );
    }

    public function test_try_with_future_date()
    {
        $cityNames = config('weather.city_names');
        $cityKey = array_rand($cityNames);
        $cityName = $cityNames[$cityKey];
        $date = now()->addDays(random_int(1, 20))->format('Y-m-d');

        $response = $this->get('/weather-data?city_name='.$cityName.'&date='.$date, ['Accept' => 'application/json']);
        $response->assertStatus(422)->assertJson(fn (AssertableJson $json) =>
        $json->has('errors.date')->etc()
        );
    }

    public function test_try_without_city_and_date()
    {
        $response = $this->get('/weather-data', ['Accept' => 'application/json']);
        $response->assertStatus(422)->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('errors.date', 'errors.city_name')->etc()
        );
    }
}
