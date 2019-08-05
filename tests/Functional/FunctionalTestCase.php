<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalTestCase extends WebTestCase
{
    /**
     * @var KernelBrowser
     */
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function getResponseData(): array
    {
        $response = $this->client->getResponse();
        return json_decode($response->getContent(), true);
    }

    public function assertDataIsItem(array $data): void
    {
        $this->assertArrayHasKey('uuid', $data, 'Item contains UUID property');
        $this->assertArrayHasKey('content', $data, 'Item contains content property');
        $this->assertArrayHasKey('checked', $data, 'Item contains checked property');
    }

    public function assertResponseContainsItems(array $data): void
    {
        foreach($data as $responseData) {
            $this->assertDataIsItem($responseData);
        }
    }
}