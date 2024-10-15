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
    private string $status;

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['data']['tags'] ?? null) === null) {
            throw new AppException('Response not return tags');
        }
        $this->status = $data['status'];
        foreach ($data['data']['tags'] as $translation) {
            $this->tags[$translation['tag_id']] = new GetResponse($translation);
        }
        $this->setPaginatorData($data['data']['paginator'] ?? []);
    }

    /**
     * @return GetResponse[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
