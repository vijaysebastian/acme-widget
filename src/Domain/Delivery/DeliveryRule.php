<?php
declare(strict_types=1);
namespace Acme\Domain\Delivery;

final class DeliveryRule
{
    const FREE_DELIVERY_THRESHOLD_IN_CENTS = 9000;
    public function __construct(
        public readonly int $thresholdCents,
        public readonly int $shippingCostCents
    ){}
}