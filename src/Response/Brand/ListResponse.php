<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Brand;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;
use Expando\LocoPackage\Response\Traits\PaginatorTrait;

class ListResponse implements IResponse
{
    use PaginatorTrait;

    /** @var GetResponse[]  */
    private array $brands = [];

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['brands'] ?? null) === null) {
            throw new AppException('Response not return brands');
        }
        $this->status = $data['status'];
        foreach ($data['brands'] as $translation) {
            $this->tags[$translation['identifier']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getBrands(): array
    {
        return $this->brands;
    }
}
