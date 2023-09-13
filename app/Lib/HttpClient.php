<?php

namespace App\Lib;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\RequestOptions;

use \Exception;

class HttpClient
{
    protected $client;
    protected $defaultHeaders;

    public function __construct($bearerToken = null)
    {
        $this->client = new Client();
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
        ];

        if ($bearerToken) {
            $this->setDefaultHeader('Authorization', 'Bearer ' . $bearerToken);
        }
    }

    public function setDefaultHeader($name, $value): void
    {
        $this->defaultHeaders[$name] = $value;
    }

    public function sendRequest($method, $url, $data = [], $headers = []): array
    {
        $options = [
            RequestOptions::JSON => $data,
            RequestOptions::HEADERS => array_merge($this->defaultHeaders, $headers),
        ];

        try {
            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            return [
                'success' => true,
                'status' => $statusCode,
                'data' => $responseData,
            ];
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
    }

    protected function handleException(GuzzleException | Exception $e): array
    {
        if ($e instanceof ConnectException) {
            throw new Exception('Serviço indisponível.', 503);
        }

        $response = $e->getResponse();
        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        return [
            'success' => false,
            'status' => $statusCode,
            'message' => $responseData['message'] ?? 'An error occurred.',
        ];
    }

    public function post(string $url, array $data = [], array $headers = []): array
    {
        return $this->sendRequest('POST', $url, $data, $headers);
    }

    public function get(string $url, array $query = [], array $headers = []): array
    {
        $options = [
            RequestOptions::QUERY => $query,
            RequestOptions::HEADERS => array_merge($this->defaultHeaders, $headers),
        ];

        try {
            $response = $this->client->request('GET', $url, $options);
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            return [
                'success' => true,
                'status' => $statusCode,
                'data' => $responseData,
            ];
        } catch (GuzzleException | Exception $e) {
            return $this->handleException($e);
        }
    }

    public function put(string $url, array $data = [], array $headers = []): array
    {
        return $this->sendRequest('PUT', $url, $data, $headers);
    }

    public function delete(string $url, array $data = [], array $headers = []): array
    {
        return $this->sendRequest('DELETE', $url, $data, $headers);
    }

    public function options(string $url, array $data = [], array $headers = []): array
    {
        return $this->sendRequest('OPTIONS', $url, $data, $headers);
    }
}
