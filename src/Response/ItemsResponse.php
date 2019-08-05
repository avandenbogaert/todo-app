<?php
declare(strict_types=1);

namespace App\Response;

use App\Entity\Item;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemsResponse extends JsonResponse
{
    public function __construct(Item ...$items)
    {
        parent::__construct($items);
    }
}
