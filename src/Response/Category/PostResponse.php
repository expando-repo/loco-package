<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Category;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private int $category_id;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['category_id'] ?? null) === null) {
            throw new AppException('Response not return category_id');
        }
        $this->category_id = $data['category_id'];
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }
}