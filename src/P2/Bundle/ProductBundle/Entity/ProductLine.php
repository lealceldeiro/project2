<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductLine
 *
 * @ORM\Table(name="product_line")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\ProductLineRepository")
 */
class ProductLine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var collection
     *
     * @ORM\ManyToMany(targetEntity="P2\Bundle\UserBundle\Entity\ProductLineManager", inversedBy="productLines")
     */
    private $productLineManager;

    /**
    * @var collection
    *
    * @ORM\OneToMany(targetEntity="Product", mappedBy="productLine")
    */
    private $products;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productLineManager = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return ProductLine
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
     * Add productLineManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager
     *
     * @return ProductLine
     */
    public function addProductLineManager(\P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager)
    {
        $this->productLineManager[] = $productLineManager;

        return $this;
    }

    /**
     * Remove productLineManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager
     */
    public function removeProductLineManager(\P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager)
    {
        $this->productLineManager->removeElement($productLineManager);
    }

    /**
     * Get productLineManager
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductLineManager()
    {
        return $this->productLineManager;
    }

    /**
     * Add product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     *
     * @return ProductLine
     */
    public function addProduct(\P2\Bundle\ProductBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     */
    public function removeProduct(\P2\Bundle\ProductBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Get attribute
     *
     * String representation of the ProductLine entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
