<?php
declare(strict_types=1);
namespace Acme\Domain;
final class Product
{
    public function __construct(
        private readonly string $code,
        private readonly string $name,
        private readonly float $price
    ){}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPriceCents(): int
    {
        return (int) ($this->price * 100);
    }
}