<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Brand
{
    private int $brand_id;
    private string $title;

    private string $identifier;

    public function __construct(array $data)
    {
        $this->brand_id = (int) $data['brand_id'];
        $this->title = $data['title'];
        $this->identifier = $data['identifier'] ?? null;
    }

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tag_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}