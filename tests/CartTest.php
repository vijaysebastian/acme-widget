<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Domain\Cart;

final class CartTest extends TestCase
{
    public function makeCartWithItems(): Cart
    {
        $catalog = new Acme\Domain\Catalog([
            new Acme\Domain\Product('R01', 'Red Widget', 32.95),
            new Acme\Domain\Product('G01', 'Green Widget', 24.95),
            new Acme\Domain\Product('B01', 'Blue Widget', 7.95),
        ]);

        $offers = [
            new Acme\Domain\Offer\BuyOneGetHalf('R01'),
        ];

        $delivery = new Acme\Domain\Delivery\DeliveryCalculator([
            new Acme\Domain\Delivery\DeliveryRule(5000, 495),
            new Acme\Domain\Delivery\DeliveryRule(9000, 295),
        ]);
        return new Acme\Domain\Cart($catalog, $delivery, $offers);
    }

    /**
     * @return array<array{0: string[], 1: float}>
     */
    public static function items(): array
    {
        return [
            [[ 'B01', 'G01' ], 37.85],
            [[ 'R01', 'R01' ], 54.37],
            [[ 'R01', 'G01' ], 60.85],
            [[ 'B01', 'B01', 'R01', 'R01', 'R01' ], 98.27],
        ];
    }

    /**
     * @dataProvider items
     * @param string[] $productCodes
     */
    public function testCart(array $productCodes, float $expectedTotal): void
    {
        $cart = $this->makeCartWithItems();
        foreach ($productCodes as $code) {
            $cart->add($code);
        }
        $this->assertEquals($expectedTotal, $cart->total());
    }
}
