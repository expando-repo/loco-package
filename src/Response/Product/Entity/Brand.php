<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Brand
{
    private int $brand_id;
    private string $title;
    private string $identifier;
    private ?string $description = null;
    private ?string $seo_title = null;
    private ?string $seo_description = null;
    private ?string $seo_keywords = null;

    public function __construct(array $data)
    {
        $this->brand_id = (int) $data['brand_id'];
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->identifier = $data['identifier'] ?? null;
        $this->seo_title = $data['seo_title'] ?? null;
        $this->seo_description = $data['seo_description'] ?? null;
        $this->seo_keywords = $data['seo_keywords'] ?? null;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
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

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
