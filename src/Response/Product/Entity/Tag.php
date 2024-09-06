<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Tag
{
    private int $tag_id;
    private string $title;
    private string $identifier;
    private ?string $seo_title = null;
    private ?string $seo_description = null;

    public function __construct(array $data)
    {
        $this->tag_id = (int) $data['tag_id'];
        $this->title = $data['title'];
        $this->identifier = $data['identifier'];
        $this->seo_title = $data['seo_title'] ?? null;
        $this->seo_description = $data['seo_description'] ?? null;
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

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string|null
     */
    public function getSeoTitle(): ?string
    {
        return $this->seo_title;
    }

    /**
     * @return string|null
     */
    public function getSeoDescription(): ?string
    {
        return $this->seo_description;
    }
}
