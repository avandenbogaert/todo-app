<?php
namespace App\Tests\Functional\Controller;

use App\Response\SuccessResponse;
use App\Tests\Functional\FunctionalTestCase;

class DeleteControllerTest extends FunctionalTestCase
{
    public function testCanDeleteItem(): void
    {
        $this->client->request('POST', '/item/create', [], [], [], json_encode(['content' => 'some-content']));
        $response = $this->getResponseData();

        $uuid = $response['uuid'];

        $this->client->request('DELETE', sprintf('/item/%s/delete', $uuid));
        $response = $this->client->getResponse();

        $this->assertInstanceOf(SuccessResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode(), 'Assert response returns OK http status');
    }

    public function testCantDeleteNonExistingItem(): void
    {
        $this->client->request('PATCH', '/item/dont-exist/delete');
        $response = $this->client->getResponse();
        $this->assertEquals(405, $response->getStatusCode());
    }
}
