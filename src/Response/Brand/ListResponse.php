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
    private string $status;

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['data']['brands'] ?? null) === null) {
            throw new AppException('Response not return brands');
        }
        $this->status = $data['status'];
        foreach ($data['data']['brands'] as $translation) {
            $this->brands[$translation['brand_id']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['data']['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getBrands(): array
    {
        return $this->brands;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
