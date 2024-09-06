<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Section
{
    private int $section_id;
    private string $title;
    private ?string $description = null;
    private string $identifier;
    private ?string $description2 = null;
    private ?string $seo_title = null;
    private ?string $seo_description = null;

    public function __construct(array $data)
    {
        $this->section_id = (int)$data['section_id'];
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->identifier = $data['identifier'] ?? null;
        $this->description2 = $data['description2'] ?? null;
        $this->seo_description = $data['seo_description'] ?? null;
        $this->seo_title = $data['seo_title'] ?? null;
    }

    /**
     * @return int
     */
    public function getSectionId(): int
    {
        return $this->section_id;
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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
}
