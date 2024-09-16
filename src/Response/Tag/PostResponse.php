<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Tag;

use Expando\LocoPackage\Exceptions\AppException;
use Expando\LocoPackage\IResponse;

class PostResponse implements IResponse
{
    private string $identifier;

    /**
     * PostResponse constructor.
     * @param array $data
     * @throws AppException
     */
    public function __construct(array $data)
    {
        if (($data['identifier'] ?? null) === null) {
            throw new AppException('Response not return identifier');
        }
        $this->identifier = $data['identifier'];
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}