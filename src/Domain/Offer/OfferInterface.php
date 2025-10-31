<?php
declare(strict_types=1);
namespace Acme\Domain\Offer;
interface OfferInterface
{
    public function discountInCents(array $cartItems): int;
}