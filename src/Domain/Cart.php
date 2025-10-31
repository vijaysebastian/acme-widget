<?php
declare(strict_types=1);
namespace Acme\Domain;
use Acme\Domain\Catalog;
use Acme\Domain\Delivery\DeliveryCalculator;

final class Cart
{
    private array $items = [];

    /* @param OfferInterface[] $offers */
    public function __construct(
        private readonly Catalog $catalog,
        private readonly DeliveryCalculator $deliveryCalculator,
        private readonly array $offers = []
    ){}

    public function add(string $productCode): void
    {
        $product = $this->catalog->getProductByCode($productCode);
        $this->items[] = $product;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function totalInCents(): int
    {
        $totalCents = 0;
        foreach ($this->items as $item) {
            $totalCents += $item->getPriceCents();
        }

        $totalDiscountCents = 0;
        foreach ($this->offers as $offer) {
            $totalDiscountCents += $offer->discountInCents($this->items);
        }

        $afterDiscountTotalCents = max(0, $totalCents - $totalDiscountCents);
        $shippingCostCents = $this->deliveryCalculator->shippingCostCents($afterDiscountTotalCents);

        return $afterDiscountTotalCents + $shippingCostCents;
    }

    public function total(): float
    {
        return $this->totalInCents() / 100;
    }
}
