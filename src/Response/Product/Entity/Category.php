<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Category
{
    private int $category_id;
    private string $title;
    private ?string $description = null;
    private string $identifier;
    private ?string $description2 = null;
    private ?string $seo_title = null;
    private ?string $seo_description = null;
    private ?string $seo_keywords = null;
    private ?string $menu_title= null;

    public function __construct(array $data)
    {
        $this->category_id = (int)$data['category_id'];
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->identifier = $data['identifier'] ?? null;
        $this->description2 = $data['description2'] ?? null;
        $this->seo_description = $data['seo_description'] ?? null;
        $this->seo_title = $data['seo_title'] ?? null;
        $this->seo_keywords = $data['seo_keywords'] ?? null;
        $this->menu_title = $data['$menu_title'] ?? null;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getDescription2(): ?string
    {
        return $this->description2;
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
    public function getSeoTitle(): ?string
    {
        return $this->seo_title;
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
    public function getMenuTitle(): ?string
    {
        return $this->menu_title;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
}
