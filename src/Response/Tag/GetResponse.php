<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Tag;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class GetResponse implements IResponse
{
    protected int $tag_id;
    protected string $identifier;
    protected string $title;
    protected ?string $description = null;
    protected ?string $seo_title = null;
    protected ?string $seo_description = null;
    protected ?string $seo_keywords = null;
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

        if (($data['tag_id'] ?? null) === null) {
            throw new AppException('Response Tag not return tag_id');
        }
        
        $this->tag_id = $data['tag_id'];
        $this->identifier = $data['identifier'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->seo_title = $data['seo_title'];
        $this->seo_description = $data['seo_description'];
        $this->seo_keywords = $data['seo_keywords'];
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
            'tag_id' => $this->tag_id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_keywords' => $this->seo_keywords,
        ];
    }
}