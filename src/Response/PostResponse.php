<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private string $hash;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['hash'] ?? null) === null) {
            throw new AppException('Response not return hash');
        }
        $this->hash = $data['hash'];
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}