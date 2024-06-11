<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Tag
{
    private int $tag_id;
    private string $title;
    private string $identifier;

    public function __construct(array $data)
    {
        $this->tag_id = (int) $data['tag_id'];
        $this->title = $data['title'];
        $this->identifier = $data['identifier'];
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