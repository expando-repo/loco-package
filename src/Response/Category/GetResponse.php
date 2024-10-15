<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Category;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class GetResponse implements IResponse
{
    protected int $category_id;
    protected string $identifier;
    protected string $title;
    protected ?string $description = null;
    protected ?string $description2 = null;
    protected ?string $seo_title = null;
    protected ?string $seo_description = null;
    protected ?string $seo_keywords = null;
    protected ?string $menu_title = null;
    protected ?string $status = null;

    /**
     * ProductPostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if(isset($data['data'])) {
            $this->status = $data['status'];
            $data = $data['data'];
        }

        if (($data['category_id'] ?? null) === null) {
            throw new AppException('Response not return category_id');
        }
        $this->category_id = $data['category_id'];
        $this->identifier = $data['identifier'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->description2 = $data['description2'];
        $this->seo_title = $data['seo_title'];
        $this->seo_description = $data['seo_description'];
        $this->seo_keywords = $data['seo_keywords'];
        $this->menu_title = $data['menu_title'];
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
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return int
     */
    public function getConnectionId(): int
    {
        return $this->connection_id;
    }

    /**
     * @return string|null
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
    public function getMenuTitle(): ?string
    {
        return $this->menu_title;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'connection_id' => $this->connection_id,
            'category_id' => $this->category_id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'description2' => $this->description2,
            'seo_description' => $this->seo_description,
            'seo_title' => $this->seo_title,
            'seo_keywords' => $this->seo_keywords,
            'menu_title' => $this->menu_title,
        ];
    }
}