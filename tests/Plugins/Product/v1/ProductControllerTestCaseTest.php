<?php

namespace App\Tests\Plugins\Product\v1;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProductControllerTestCaseTest extends ApiTestCase
{
    public function testCreate(): void
    {
        $body = [
            "name" => "test12132",
            "weight" => 122,
            "price" => 1520,
            "authors" => 111
        ];
        $response = static::createClient()->request('POST', '/v1/product/', [
            'json' => $body,
            'headers' => ['Content-Type: application/json']
        ]);

        $content = $response->getContent();
        $result = json_decode($content, true);
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('product', $result['message']);
    }
}
