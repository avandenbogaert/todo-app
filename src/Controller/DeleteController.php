<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\ItemManager;
use App\Response\SuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteController
{
    /**
     * @var ItemManager
     */
    private $manager;

    public function __construct(ItemManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(string $uuid): JsonResponse
    {
        $this->manager->delete($uuid);

        return new SuccessResponse;
    }
}
