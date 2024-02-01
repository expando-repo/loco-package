<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Connection;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class ListResponse implements IResponse
{
    /** @var GetResponse[]  */
    private array $connections = [];
    private string $status;

    /**
     * ListResponse constructor.
     * @param array $data
     * @throws AppException()
     */
    public function __construct(array $data)
    {
        if (($data['connections'] ?? null) === null) {
            throw new AppException('Response is empty');
        }
        $this->status = $data['status'];
        foreach ($data['connections'] as $item) {
            $this->connections[$item['connection_id']] = new GetResponse($item);
        }
    }

    /**
     * @return GetResponse[]
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}