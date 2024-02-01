<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Traits;

use Expando\LocoPackage\Exceptions\TranslatorException;
use Expando\LocoPackage\IResponse;

Trait PaginatorTrait
{
    private int $currentPage;
    private int $onPage;
    private int $total;

    /**
     * @param array $data
     */
    public function setPaginatorData(array $data): void
    {
        $this->currentPage = $data['currentPage'] ?? 0;
        $this->onPage = $data['onPage'] ?? 0;
        $this->total = $data['total'] ?? 0;
    }
    
    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getOnPage(): int
    {
        return $this->onPage;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
