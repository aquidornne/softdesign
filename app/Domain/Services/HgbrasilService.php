<?php 

namespace App\Domain\Services;

use App\Lib\HttpClient;
use App\Domain\DTO\TempoDTO;

class HgbrasilService
{
    protected $httpClient;

    private static $baseUrl;
    private static $token;
    private static $code;

    public function __construct(
        HttpClient $httpClient, 
        string $baseUrl, 
        string $token,
        string $code
    )
    {
        $this->httpClient = $httpClient;
        self::$baseUrl = $baseUrl;
        self::$token = $token;
        self::$code = $code;
    }

    public function getWeather(): TempoDTO
    {
        $data = $this->httpClient->get(self::$baseUrl, [
            'woeid' => self::$code,
            'key' => self::$token
        ]);

        if($this->checkValidResult($data) === false) 
            throw new \Exception('Ocorreu erro na comunicação entre serviços.');

        return $this->prepareResult($data['data']);
    }

    private function checkValidResult(array $data): bool
    {
        return $data['success'] === true && $data['data'] && $data['data']['results'];
    }

    private function prepareResult(array $data): TempoDTO
    {
        return new TempoDTO(
            $data['results']['description'],
            $data['results']['city'],
            $data['results']['city_name'],
            $data['results']['condition_slug'],
        );
    }
}
