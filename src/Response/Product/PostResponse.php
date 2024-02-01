<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private int $product_id;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['product_id'] ?? null) === null) {
            throw new AppException('Response not return product_id');
        }
        $this->product_id = $data['product_id'];
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }
}