<?php
declare(strict_types=1);
namespace Acme\Domain\Offer;
use Acme\Domain\Product;

final class BuyOneGetHalf implements OfferInterface
{
    public function __construct(
        private readonly string $productCode
    ) {}

    /** $params Product[] $cartItems */
    public function discountInCents(array $cartItems): int
    {
        $targetProductCount = 0;
        $targetProductPriceCents = 0;

        foreach ($cartItems as $item) {
            if ($item->getCode() === $this->productCode) {
                $targetProductCount++;
                $targetProductPriceCents = $item->getPriceCents();
            }
        }

        if ($targetProductCount < 2 || $targetProductPriceCents === 0) {
            return 0;
        }

        $eligiblePairs = intdiv($targetProductCount, 2);
        return (int) ($eligiblePairs * ($targetProductPriceCents / 2));
    }
}
