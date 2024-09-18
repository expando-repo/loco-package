<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Connection;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class GetResponse implements IResponse
{
    protected string $identifier;
    protected string $title;
    protected string $description;
    protected string $seo_title;
    protected string $seo_description;
    protected string $seo_keywords;

    /**
     * ProductPostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['identifier'] ?? null) === null) {
            throw new AppException('Response Tag not return identifier');
        }
        $this->identifier = $data['identifier'];
        $this->title = $data['title'];
        $this->title = $data['description'];
        $this->seo_title = $data['seo_title'];
        $this->seo_description = $data['seo_description'];
        $this->seo_keywords = $data['seo_keywords'];
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->seo_description;
    }

    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->seo_title;
    }

    /**
     * @return string
     */
    public function getSeoDescription(): string
    {
        return $this->seo_description;
    }

    /**
     * @return string
     */
    public function getSeoKeywords(): string
    {
        return $this->seo_keywords;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'connection_id' => $this->connection_id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_keywords' => $this->seo_keywords,
        ];
    }
}