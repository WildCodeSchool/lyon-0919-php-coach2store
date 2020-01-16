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

    public function getProductsByCriteria($criteria, $brand = null,  $supplier = null)
    {
        $client = $this->client();
        $url = 'https://dev-api.coach2store.com/api/search?criteria=' . urlencode($criteria);
        if ($brand)
            $url .= '&brand='. urlencode($brand);
        if ($supplier)
            $url .= '&supplier_name='. urlencode($supplier);
        $response = $client->request('GET',  $url);
        $contents = $response->toArray();
        $products = $contents['result'];
        return $products;
    }

    public function getProductsTop(): array
    {
        $client = $this->client();
        $response = $client->request('GET', 'https://dev-api.coach2store.com/api/top_products');
        $products = $response->toArray();
        return $products;
    }

    public static function simplifyProduct(array $product)
    {
        return $product['fields'];
    }

    public static function simplifyBrand(array $brand)
    {
        return $brand['value'];
    }

    public static function simplifySupplier(array $supplier)
    {
        return $supplier['value'];
    }
}
