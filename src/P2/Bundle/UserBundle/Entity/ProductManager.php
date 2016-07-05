<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductManager
 *
 * @ORM\Table(name="product_manager")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\ProductManagerRepository")
 */
class ProductManager extends User
{
    /**
     * @var P2\Bundle\UserBundle\Entity\ProductLineManager
     *
     * @ORM\ManyToOne(targetEntity="ProductLineManager", inversedBy="productManagers")
     * @ORM\JoinColumn(name="product_line_manager_id", referencedColumnName="id")
     */
    private $productLineManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\ProductBundle\Entity\Product", mappedBy="productManager")
     */
    private $products;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set productLineManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager
     *
     * @return ProductManager
     */
    public function setProductLineManager(\P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager = null)
    {
        $this->productLineManager = $productLineManager;

        return $this;
    }

    /**
     * Get productLineManager
     *
     * @return \P2\Bundle\UserBundle\Entity\ProductLineManager
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
     * @return ProductManager
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

}
