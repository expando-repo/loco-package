<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;
use Expando\LocoPackage\Response\Traits\PaginatorTrait;

class ListResponse implements IResponse
{
    use PaginatorTrait;

    /** @var GetResponse[]  */
    private array $products = [];
    private string $status;

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['products'] ?? null) === null) {
            throw new AppException('Response not return products');
        }
        $this->status = $data['status'];
        foreach ($data['products'] as $translation) {
            $this->products[$translation['product_id']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
