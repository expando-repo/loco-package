<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Brand;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private int $brand_id;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['brand_id'] ?? null) === null) {
            throw new AppException('Response not return brand_id');
        }
        $this->brand_id = $data['brand_id'];
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
    }
}