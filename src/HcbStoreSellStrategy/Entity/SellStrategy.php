<?php
namespace HcbStoreSellStrategy\Entity;

use HcbStoreSellStrategy\Entity\SellStrategy\Product;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * SellStrategy
 *
 * @ORM\Table(name="store_sell_strategy")
 * @ORM\Entity
 */
class SellStrategy implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var Product
     *
     * @ORM\Id
     * @ORM\OneToMany(targetEntity="HcbStoreSellStrategy\Entity\SellStrategy\Product", mappedBy="sellStrategy")
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SellStrategy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add product
     *
     * @param \HcbStoreSellStrategy\Entity\SellStrategy\Product $product
     * @return SellStrategy
     */
    public function addProduct(\HcbStoreSellStrategy\Entity\SellStrategy\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \HcbStoreSellStrategy\Entity\SellStrategy\Product $product
     */
    public function removeProduct(\HcbStoreSellStrategy\Entity\SellStrategy\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
