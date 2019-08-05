<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Item;
use App\Manager\ItemManager;
use App\Response\ItemResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateController
{
    /**
     * @var ItemManager
     */
    private $manager;

    public function __construct(ItemManager $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $item = new Item($data['content'] ?? '', false);

        $this->manager->save($item);

        return new ItemResponse($item, 201);
    }
}
