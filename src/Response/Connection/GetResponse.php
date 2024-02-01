<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Connection;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class GetResponse implements IResponse
{
    protected int $connection_id;
    protected string $title;
    protected string $language;
    protected string $type;

    /**
     * ProductPostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['connection_id'] ?? null) === null) {
            throw new AppException('Response product not return hash');
        }
        $this->connection_id = $data['connection_id'];
        $this->title = $data['title'];
        $this->language = $data['language'];
        $this->type = $data['type'];
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
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}