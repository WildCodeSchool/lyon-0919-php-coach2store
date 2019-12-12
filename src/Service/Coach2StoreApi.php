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

    public function getProductsByBrand($brand)
    {
        $client = HttpClient::create(['headers' => [
            'api_key' => $this->apiKey
        ]]);

        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/search?criteria=velo&brand=' . $brand);
        $content = $response->toArray();

        var_dump($content);
        $products = $content['result']['hits']['hit'];

        foreach ($products as $product ) {
            var_dump($product['fields']['brand']);
        }

        return $products;
    }

//    public function getSupplier()
//    {
//        $client = HttpClient::create(['headers' => [
//            'api_key' => $this->apiKey
//        ]]);
//
//    }
}