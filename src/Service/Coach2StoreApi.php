<?php


namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $content = $response->toArray();
        $products = $content['result']['facets'];

        foreach ($products as $product) {
            $product['buckets'];
        }
        return $products;
    }

    public function getProductsBySupplier($criteria)
    {
        $client = $this->client();
        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/search?criteria=' . $criteria);

        $content = $response->toArray();
        $products = $content['result']['facets']['supplier_name'];

        return $products;
    }
}