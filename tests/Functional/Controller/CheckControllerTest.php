<?php
namespace App\Tests\Functional\Controller;

use App\Tests\Functional\FunctionalTestCase;

class CheckControllerTest extends FunctionalTestCase
{
    public function testCanCheckItem(): string
    {
        $this->client->request('POST', '/item/create', [], [], [], json_encode(['content' => 'some-content']));
        $this->assertDataIsItem($data = $this->getResponseData());

        $uuid = $data['uuid'];
        $checked = $data['checked'];

        $this->assertFalse($checked, 'Item is unchecked by default');

        $this->client->request('PATCH', sprintf('/item/%s/check', $uuid));

        $this->assertDataIsItem($data = $this->getResponseData());
        $this->assertTrue($data['checked'], 'Item should be Checked');

        return $uuid;
    }

    /** @depends testCanCheckItem  */
    public function testCanUncheckItem(string $uuid): void
    {
        $this->client->request('PATCH', sprintf('/item/%s/uncheck', $uuid));
        $this->assertDataIsItem($data = $this->getResponseData());
        $this->assertFalse($data['checked'], 'Item should be unchecked');
    }

    public function testCantCheckNonExistingItem(): void
    {
        $this->client->request('PATCH', '/item/dont-exist/check');
        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testCantUnCheckNonExistingItem(): void
    {
        $this->client->request('PATCH', '/item/dont-exist/uncheck');
        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }
}