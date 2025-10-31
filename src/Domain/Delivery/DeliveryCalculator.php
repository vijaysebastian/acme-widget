<?php
declare(strict_types=1);
namespace Acme\Domain\Delivery;

final class DeliveryCalculator
{
    /**
     * @param DeliveryRule[] $rules
     */
    public function __construct(
        private readonly array $rules
    ){}

    public function shippingCostCents(int $afterDiscountTotalCents): int
    {
        if ($afterDiscountTotalCents >= DeliveryRule::FREE_DELIVERY_THRESHOLD_IN_CENTS) {
            return 0;
        }

        foreach ($this->rules as $rule) {
            if ($afterDiscountTotalCents < $rule->thresholdCents) {
                return $rule->shippingCostCents;
            }
        }
        return 0;
    }
}
