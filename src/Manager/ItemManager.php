<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\Common\Persistence\ObjectManager;

class ItemManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ItemRepository
     */
    private $repository;

    public function __construct(ObjectManager $objectManager, ItemRepository $repository)
    {
        $this->objectManager = $objectManager;
        $this->repository = $repository;
    }

    public function get(string $uuid): Item
    {
        return $this->repository->getByUuid($uuid);
    }

    public function delete(string $uuid): void
    {
        $item = $this->repository->getByUuid($uuid);
        $this->objectManager->remove($item);
        $this->objectManager->flush();
    }

    public function save(Item $item): void
    {
        $this->objectManager->persist($item);
        $this->objectManager->flush();
    }

    public function fetchAll(): array
    {
        return $this->repository->findAll();
    }
}
