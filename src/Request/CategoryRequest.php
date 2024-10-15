<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Request;

use Expando\LocoPackage\IRequest;

class CategoryRequest extends Base implements IRequest
{
    private int $connectionId;
    private ?int $categoryId = null;
    private ?string $identifier = null;

    private string $title;
    private ?string $description = null;
    private ?string $description2 = null;
    private ?string $seoTitle = null;
    private ?string $seoDescription = null;
    private ?string $seoKeywords = null;
    private ?string $menuTitle = null;

    public function __construct(int $connectionId)
    {
        $this->connectionId = $connectionId;
    }

    /**
     * @return int
     */
    public function getConnectionId(): int
    {
        return $this->connectionId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @param string|null $identifier
     */
    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription2(?string $description2): void
    {
        $this->description2 = $description2;
    }

    /**
     * @param string|null $description
     */
    public function setMenuTitle(?string $menuTitle): void
    {
        $this->menuTitle = $menuTitle;
    }

    /**
     * @param string|null $seoTitle
     */
    public function setSeoTitle(?string $seoTitle): void
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @param string|null $seoDescription
     */
    public function setSeoDescription(?string $seoDescription): void
    {
        $this->seoDescription = $seoDescription;
    }

    /**
     * @param string|null $seoKeywords
     */
    public function setSeoKeywords(?string $seoKeywords): void
    {
        $this->seoKeywords = $seoKeywords;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'connection_id' => $this->connectionId,
            'identifier' => $this->identifier,
            'category_id' => $this->categoryId,
            'title' => $this->title,
            'description' => $this->description,
            'description2' => $this->description2,
            'seo_description' => $this->seoDescription,
            'seo_title' => $this->seoTitle,
            'seo_keywords' => $this->seoKeywords,
            'menu_title' => $this->menuTitle,
        ];
    }
}
