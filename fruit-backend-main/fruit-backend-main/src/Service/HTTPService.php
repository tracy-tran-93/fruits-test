<?php
namespace App\Service;

use App\Entity\HTTPCodeEnum;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HTTPService
{
    public function __construct(
        private readonly HttpClientInterface $client,
    )
    {
    }

    public function fetchFruitsFromAPI(): array
    {
        try {
            $response = $this->client->request('GET', $_SERVER['API_FRUIT_URL']);
            $content = $response->toArray();
            return [
                'error' => null,
                'content' => $content
            ];
        } catch (\Exception $exception) {
            $error = 'API ' . $_SERVER['API_FRUIT_URL'] . ' return error code: ' . $exception->getCode();
            return [
                'error' => $error,
                'content' => []
            ];
        }

    }
}