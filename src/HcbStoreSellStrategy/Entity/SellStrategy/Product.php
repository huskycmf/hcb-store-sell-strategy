<?php
namespace HcbStoreSellStrategy\Entity\SellStrategy;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="store_sell_strategy_product")
 * @ORM\Entity
 */
class Product implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="HcbStoreSellStrategy\Entity\SellStrategy", inversedBy="product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_sell_strategy_id", referencedColumnName="id")
     * })
     */
    private $sellStrategy;

    /**
     * @var Product
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_sell_product_id", referencedColumnName="id")
     * })
     */
    private $sellProduct;

    /**
     * @var integer
     *
     * @ORM\Column(name="store_product_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $productId;

    /**
     * @var Product
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * Set productId
     *
     * @param integer $productId
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set sellStrategy
     *
     * @param \HcbStoreSellStrategy\Entity\SellStrategy $sellStrategy
     * @return Product
     */
    public function setSellStrategy(\HcbStoreSellStrategy\Entity\SellStrategy $sellStrategy)
    {
        $this->sellStrategy = $sellStrategy;

        return $this;
    }

    /**
     * Get sellStrategy
     *
     * @return \HcbStoreSellStrategy\Entity\SellStrategy 
     */
    public function getSellStrategy()
    {
        return $this->sellStrategy;
    }

    /**
     * Set sellProduct
     *
     * @param \HcbStoreProduct\Entity\Product $sellProduct
     * @return Product
     */
    public function setSellProduct(\HcbStoreProduct\Entity\Product $sellProduct)
    {
        $this->sellProduct = $sellProduct;

        return $this;
    }

    /**
     * Get sellProduct
     *
     * @return \HcbStoreProduct\Entity\Product 
     */
    public function getSellProduct()
    {
        return $this->sellProduct;
    }

    /**
     * Set product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Product
     */
    public function setProduct(\HcbStoreProduct\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \HcbStoreProduct\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
