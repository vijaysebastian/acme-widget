<?php
declare(strict_types=1);
namespace Acme\Domain;
use _PHPStan_b22655c3f\Nette\Neon\Exception;
use Acme\Domain\Product;
final class Catalog
{
    /** @var Product[] */
    private array $products = [];

    /**
     * @param Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = [];
        foreach ($products as $product) {
            $this->products[$product->getCode()] = $product;
        }
    }

    public function hasProductCode(string $code): bool
    {
        return isset($this->products[$code]);
    }
    public function getProductByCode(string $code): ?Product
    {
        if (!$this->hasProductCode($code)) {
            throw new \InvalidArgumentException("Product with code '$code' does not exist.");
        }
        return $this->products[$code];
    }
}
