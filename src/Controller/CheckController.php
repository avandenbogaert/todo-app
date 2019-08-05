<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\ItemManager;
use App\Response\ItemResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckController
{
    /**
     * @var ItemManager
     */
    private $manager;

    public function __construct(ItemManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(string $uuid, bool $isChecked): JsonResponse
    {
        $item = $this->manager->get($uuid);
        $isChecked ? $item->check() : $item->uncheck();
        $this->manager->save($item);

        return new ItemResponse($item);
    }
}
