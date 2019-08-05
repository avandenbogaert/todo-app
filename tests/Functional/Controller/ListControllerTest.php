<?php
declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Response\ItemsResponse;
use App\Tests\Functional\FunctionalTestCase;

class ListControllerTest extends FunctionalTestCase
{
    public function testCanListItems(): void
    {
        $this->client->request('GET', '/items');

        $response = $this->client->getResponse();

        $this->assertInstanceOf(ItemsResponse::class, $response, 'Response instance of ItemsResponse');
        $this->assertEquals(200, $response->getStatusCode(), 'Response should return OK status');

        $this->assertNotEmpty($this->getResponseData(), 'Item list should contain items');
        $this->assertResponseContainsItems($this->getResponseData());
    }
}