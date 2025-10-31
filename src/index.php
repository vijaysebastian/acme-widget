<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
use Acme\Domain\Product;
use Acme\Domain\Catalog;
use Acme\Domain\Delivery\DeliveryCalculator;
use Acme\Domain\Delivery\DeliveryRule;
use Acme\Domain\Offer\BuyOneGetHalf;

$products = [
    new Product('R01', 'Red Widget',   32.95),
    new Product('G01', 'Green Widget', 24.95),
    new Product('B01', 'Blue Widget',   7.95),
];

$catalog = new Catalog($products);
$offers = [
    new BuyOneGetHalf('R01'),
];
$deliveryRules = [
    new DeliveryRule(5000, 495),
    new DeliveryRule(9000, 295),
];
$deliveryCalculator = new DeliveryCalculator($deliveryRules);
$cart = new Acme\Domain\Cart($catalog, $deliveryCalculator, $offers);
$argv = $_SERVER['argv'] ?? [];
array_shift($argv);
foreach ($argv as $productCode) {
    $cart->add($productCode);
}
$total = $cart->total();
echo "Total: " . number_format($total, 2) . PHP_EOL;