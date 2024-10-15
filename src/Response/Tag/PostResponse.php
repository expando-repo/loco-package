<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Tag;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private int $tag_id;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['tag_id'] ?? null) === null) {
            throw new AppException('Response not return tag_id');
        }
        $this->tag_id = $data['tag_id'];
    }

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tag_id;
    }
}