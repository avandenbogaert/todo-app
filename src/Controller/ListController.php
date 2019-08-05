<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\ItemManager;
use App\Response\ItemsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListController
{
    /**
     * @var ItemManager
     */
    private $manager;

    public function __construct(ItemManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(): JsonResponse
    {
        return new ItemsResponse(...$this->manager->findAll());
    }
}
