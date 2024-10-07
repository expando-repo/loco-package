<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Request;

use Expando\LocoPackage\IRequest;

class BrandRequest extends Base implements IRequest
{
    private int $connectionId;
    private ?string $identifier = null;

    private string $title;
    private ?string $description = null;

    private ?string $seoTitle = null;
    private ?string $seoDescription = null;
    private ?string $seoKeywords = null;

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
    public function setDescription(?string $description): void
    {
        $this->description = $description;
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
            'title' => $this->title,
            'description' => $this->description,
            'seo_title' => $this->seoTitle,
            'seo_description' => $this->seoDescription,
            'seo_keywords' => $this->seoKeywords,
        ];
    }
}
