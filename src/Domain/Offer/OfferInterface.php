<?php
declare(strict_types=1);
namespace Acme\Domain\Offer;
interface OfferInterface
{
    /**
     * @param array<\Acme\Domain\Product> $cartItems
     * @return int
     */
    public function discountInCents(array $cartItems): int;
}