<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Tag;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;
use Expando\LocoPackage\Response\Traits\PaginatorTrait;

class ListResponse implements IResponse
{
    use PaginatorTrait;

    /** @var GetResponse[]  */
    private array $tags = [];

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['tags'] ?? null) === null) {
            throw new AppException('Response not return tags');
        }
        $this->status = $data['status'];
        foreach ($data['tags'] as $translation) {
            $this->tags[$translation['identifier']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
