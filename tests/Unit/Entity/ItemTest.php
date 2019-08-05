<?php
declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testCanConstruct(): void
    {
        $item = new Item('content', false);

        $this->assertInstanceOf(Item::class, $item, 'Item is constructed');
        $this->assertNotEmpty($item->getUuid(), 'Item has uuid');
        $this->assertEquals('content', $item->getContent(), 'Item returns content');
        $this->assertFalse($item->isChecked(), 'Item is not checked');
    }

    public function testCanCheckItem(): void
    {
        $item = new Item('content', false);
        $this->assertFalse($item->isChecked(), 'Item is not checked');
        $item->check();
        $this->assertTrue($item->isChecked(), 'Item is checked');
    }

    public function testCanUncheckItem(): void
    {
        $item = new Item('content', true);
        $this->assertTrue($item->isChecked(), 'Item is checked');
        $item->uncheck();
        $this->assertFalse($item->isChecked(), 'Item is not checked');
    }

    public function testCanSerialize(): void
    {
        $item = new Item('content', true);
        $array = $item->jsonSerialize();

        $this->assertArrayHasKey('uuid', $array, 'Serialized has uuid');
        $this->assertArrayHasKey('content', $array, 'Serialized has content');
        $this->assertEquals('content', $array['content'], 'Serialized has correct content');
        $this->assertArrayHasKey('checked', $array, 'Serialized has checked');
        $this->assertEquals(true, $array['checked'], 'Serialized has correct checked value');
    }
}