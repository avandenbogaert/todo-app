<?php
declare(strict_types=1);

namespace App\Response;

use App\Entity\Item;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemResponse extends JsonResponse
{
    public function __construct(Item $item, int $statusCode = 200)
    {
        parent::__construct($item, $statusCode);
    }
}
