<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 */
class Item implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=36)
     *
     * @var string
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=512, nullable=false)
     * @var string
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var bool
     */
    private $checked;

    public function __construct(string $content, bool $checked)
    {
        $this->content = $content;
        $this->checked = $checked;
        $this->uuid = (string)Uuid::uuid4();
    }

    public function check(): void
    {
        $this->checked = true;
    }

    public function uncheck(): void
    {
        $this->checked = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isChecked(): bool
    {
        return $this->checked;
    }

    public function jsonSerialize()
    {
        return [
            'uuid' => $this->uuid,
            'content' => $this->content,
            'checked' => $this->checked
        ];
    }
}
