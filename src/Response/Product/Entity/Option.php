<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Response\Product\Entity;

class Option
{
    private int $option_id;
    private int $option_value_id;
    private string $name;
    private string $value;
    private int $variant;
    private int $identifierName;
    private int $identifierValue;

    public function __construct(array $data)
    {
        $this->option_id = (int) $data['option_id'];
        $this->option_value_id = (int) $data['option_value_id'];
        $this->name = $data['name'];
        $this->value = $data['value'];
        $this->variant = (int) $data['variant'];
        $this->identifierName = $data['identifier'];
        $this->identifierValue = $data['value_identifier'];
    }

    /**
     * @return int
     */
    public function getOptionId(): int
    {
        return $this->option_id;
    }

    /**
     * @return int
     */
    public function getOptionValueId(): int
    {
        return $this->option_value_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getVariant(): int
    {
        return $this->variant;
    }

    public function getIdentifierName(): int
    {
        return $this->identifierName;
    }

    public function getIdentifierValue(): int
    {
        return $this->identifierValue;
    }
}