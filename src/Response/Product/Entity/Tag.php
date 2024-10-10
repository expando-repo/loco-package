<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Tag
{
    private string $identifier;
    private string $title;
    private ?string $description = null;
    private ?string $seo_title = null;
    private ?string $seo_description = null;
    private ?string $seo_keywords = null;

    public function __construct(array $data)
    {
        $this->identifier = $data['identifier'];
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->seo_title = $data['seo_title'] ?? null;
        $this->seo_description = $data['seo_description'] ?? null;
        $this->seo_keywords = $data['seo_keywords'] ?? null;
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
    public function getDescription(): string
    {
        return $this->description;
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

    /**
     * @return string|null
     */
    public function getSeoKeywords(): ?string
    {
        return $this->seo_keywords;
    }
}
