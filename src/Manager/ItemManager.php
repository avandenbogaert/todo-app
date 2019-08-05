<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Item;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectManager $objectManager, ObjectRepository $repository)
    {
        $this->objectManager = $objectManager;
        $this->repository = $repository;
    }

    public function get(string $uuid): Item
    {
        $item = $this->repository->findOneBy(['uuid' => $uuid]);

        if (!$item instanceof Item) {
            throw new NotFoundHttpException("No item with id $uuid exists");
        }

        return $item;
    }

    public function delete(string $uuid): void
    {
        $item = $this->get($uuid);
        $this->objectManager->remove($item);
        $this->objectManager->flush();
    }

    public function save(Item $item): void
    {
        $this->objectManager->persist($item);
        $this->objectManager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
