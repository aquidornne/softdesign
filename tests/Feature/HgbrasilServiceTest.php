<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\Services\HgbrasilService;

use App\Lib\HttpClient;

use App\Domain\DTO\TempoDTO;

class HgbrasilServiceTest extends TestCase
{
    public function testGetWeather()
    {
        $httpClientMock = $this->createMock(HttpClient::class);
        $httpClientMock->method('get')->willReturn([
            'success' => true,
            'data' => json_decode('{"by":"default","valid_key":false,"results":{"temp":29,"date":"2023-09-13","time":"09:11","condition_code":"29","description":"Night partly cloudy","currently":"day","cid":"","city":"Miami, Florida","img_id":"29","humidity":78,"cloudiness":20.0,"rain":0.0,"wind_speedy":"2.68 km/h","wind_direction":320,"wind_cardinal":"NW","sunrise":"08:05 am","sunset":"08:28 pm","moon_phase":"waning_crescent","condition_slug":"cloudly_day","city_name":"Miami","timezone":"-04:00","forecast":[{"date":"09-12","weekday":"Tue","max":31,"min":28,"cloudiness":39.0,"rain":1.75,"rain_probability":52,"wind_speedy":"6.31 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-13","weekday":"Wed","max":31,"min":28,"cloudiness":11.0,"rain":1.15,"rain_probability":50,"wind_speedy":"6.48 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-14","weekday":"Thu","max":31,"min":28,"cloudiness":16.0,"rain":6.91,"rain_probability":72,"wind_speedy":"5.5 km/h","description":"Thundershowers","condition":"rain"},{"date":"09-15","weekday":"Fri","max":30,"min":28,"cloudiness":14.0,"rain":0.4,"rain_probability":69,"wind_speedy":"4.8 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-16","weekday":"Sat","max":30,"min":28,"cloudiness":28.0,"rain":0.25,"rain_probability":51,"wind_speedy":"5.26 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-17","weekday":"Sun","max":31,"min":28,"cloudiness":30.0,"rain":7.01,"rain_probability":72,"wind_speedy":"5.35 km/h","description":"Thundershowers","condition":"rain"},{"date":"09-18","weekday":"Mon","max":30,"min":28,"cloudiness":100.0,"rain":5.86,"rain_probability":82,"wind_speedy":"4.2 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-19","weekday":"Tue","max":30,"min":27,"cloudiness":29.0,"rain":7.92,"rain_probability":99,"wind_speedy":"4.34 km/h","description":"Thundershowers","condition":"rain"},{"date":"09-20","weekday":"Wed","max":31,"min":28,"cloudiness":8.0,"rain":3.44,"rain_probability":86,"wind_speedy":"5.05 km/h","description":"Scattered showers","condition":"rain"},{"date":"09-21","weekday":"Thu","max":30,"min":28,"cloudiness":19.0,"rain":3.44,"rain_probability":74,"wind_speedy":"4.95 km/h","description":"Scattered showers","condition":"rain"}]},"execution_time":0.0,"from_cache":true}', true),
        ]);

        $service = new HgbrasilService($httpClientMock, 'base_url', 'api_token', 'api_code');

        $weather = $service->getWeather();

        $this->assertInstanceOf(TempoDTO::class, $weather);
    }
}
