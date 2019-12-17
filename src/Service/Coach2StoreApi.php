<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class Coach2StoreApi
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    private function client()
    {
        return HttpClient::create(['headers' => [
            'api_key' => $this->apiKey
        ]]);
    }

    public function getProductsByBrand($criteria)
    {
        $client = $this->client();

        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/search?criteria=' . $criteria);

        $contents = $response->toArray();
        $products = $contents['result']['facets'];

        return $products;
    }

    public function getProductsBySupplier($criteria)
    {
        $client = $this->client();
        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/search?criteria=' . $criteria);

        $contents = $response->toArray();
        $products = $contents['result']['facets']['supplier_name'];

        return $products;
    }

    public function getProductsTop()
    {
        $client = $this->client();
        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/top_products');

        $products = $response->toArray();

        return $products;
    }
}
