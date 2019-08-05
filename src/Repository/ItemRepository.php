<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Item;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemRepository extends EntityRepository
{
    public function getByUuid(string $uuid)
    {
        $item = $this->findOneBy(['uuid' => $uuid]);

        if (!$item instanceof Item) {
            throw new NotFoundHttpException("No item with id $uuid exists");
        }

        return $item;
    }
}
