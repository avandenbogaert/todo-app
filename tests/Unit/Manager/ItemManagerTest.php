<?php
declare(strict_types=1);

namespace App\Tests\Unit\Manager;

use App\Entity\Item;
use App\Manager\ItemManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemManagerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var ItemManager
     */
    private $manager;

    /**
     * @var ObjectRepository|MockInterface
     */
    private $repository;

    /**
     * @var ObjectManager|MockInterface
     */
    private $objectManager;

    protected function setUp()
    {
        $this->repository = \Mockery::mock(ObjectRepository::class);
        $this->objectManager = \Mockery::mock(ObjectManager::class);

        $this->manager = new ItemManager($this->objectManager, $this->repository);
    }

    public function testCanConstruct(): void
    {
        $this->assertInstanceOf(ItemManager::class, $this->manager, 'The item manager can construct');
    }

    public function testThrowsExceptionWhenItemDoesNotExist(): void
    {
        $uuid = Uuid::uuid4()->toString();
        $this->repository->shouldReceive('findOneBy')->with(['uuid' => $uuid])->andReturnNull();

        $this->expectException(NotFoundHttpException::class);

        $this->manager->get($uuid);
    }

    public function testCanGetItem(): void
    {
        $uuid = Uuid::uuid4()->toString();
        
        $this->repository
            ->shouldReceive('findOneBy')
            ->with(['uuid' => $uuid])
            ->andReturn(new Item('some', true))
            ->once();

        $item = $this->manager->get($uuid);
    }

    public function testCanDeleteItem(): void
    {
        $uuid = Uuid::uuid4()->toString();
        $item = new Item('some', true);

        $this->repository->shouldReceive('findOneBy')->with(['uuid' => $uuid])->andReturn($item);
        $this->objectManager->shouldReceive('remove')->with($item)->once();
        $this->objectManager->shouldReceive('flush')->withNoArgs()->once();

        $this->manager->delete($uuid);
    }

    public function testCanSaveItem(): void
    {
        $item = new Item('some', true);

        $this->objectManager->shouldReceive('persist')->with($item)->once();
        $this->objectManager->shouldReceive('flush')->withNoArgs()->once();

        $this->manager->save($item);
    }

    public function testCanFindAll(): void
    {
        $this->repository->shouldReceive('findAll')->andReturn([])->once();
        $this->manager->findAll();
    }
}