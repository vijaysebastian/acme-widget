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
$code = 'G01';
try {
    $product = $catalog->getProductByCode($code);
    echo "Product Code: " . $product->getCode() . PHP_EOL;
    echo "Product Name: " . $product->getName() . PHP_EOL;
    echo "Product Price (cents): " . $product->getPriceCents() . PHP_EOL;
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$rules = [
    new DeliveryRule(5000, 495), // if total < $50, shipping = $4.95
    new DeliveryRule(9000, 295), // if total < $90, shipping = $2.95
];

$delivery = new DeliveryCalculator($rules);
echo "Delivery cost: " . $delivery->shippingCostCents(4999) . PHP_EOL;


$cartItems = [
    new Product('R01', 'Red Widget',   32.95),
    new Product('R01', 'Red Widget',   32.95),
];

$offer = new BuyOneGetHalf('R01');
$discount = $offer->discountInCents($cartItems);
echo "Discount from offer: " . $discount . PHP_EOL;
