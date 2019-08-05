<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class IndexController
{
    /**
     * @var EngineInterface
     */
    private $renderer;

    public function __construct(EngineInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke()
    {
        return $this->renderer->renderResponse('base.html.twig');
    }
}
