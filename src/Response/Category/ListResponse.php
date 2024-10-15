<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Category;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;
use Expando\LocoPackage\Response\Traits\PaginatorTrait;

class ListResponse implements IResponse
{
    use PaginatorTrait;

    /** @var GetResponse[]  */
    private array $categories = [];
    private string $status;

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['data']['categories'] ?? null) === null) {
            throw new AppException('Response not return categories');
        }
        $this->status = $data['status'];
        foreach ($data['data']['categories'] as $translation) {
            $this->categories[$translation['category_id']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['data']['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
