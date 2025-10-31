<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
use Acme\Domain\Product;
use Acme\Domain\Catalog;

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

