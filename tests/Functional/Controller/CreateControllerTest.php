<?php
declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Response\ItemResponse;
use App\Tests\Functional\FunctionalTestCase;

class CreateControllerTest extends FunctionalTestCase
{
    public function testCanCreateItem(): void
    {
        $this->client->request('GET', '/items');
        $count = count($this->getResponseData());

        $this->client->request('POST', '/item/create', [], [], [], json_encode(['content' => 'some-content']));
        $response = $this->client->getResponse();

        $this->assertInstanceOf(ItemResponse::class, $response, 'Response should be instance of ItemResponse');
        $this->assertEquals(201, $response->getStatusCode(), 'Response should give CREATED http status');

        $responseData = $this->getResponseData();

        $this->assertDataIsItem($responseData);

        $this->assertEquals('some-content', $responseData['content'], 'Item should contain correct content');
        $this->assertEquals(false, $responseData['checked'], 'Item is unchecked by default');

        $this->client->request('GET', '/items');
        $this->assertCount($count + 1, $this->getResponseData(), 'New item is present in list');
    }
}
