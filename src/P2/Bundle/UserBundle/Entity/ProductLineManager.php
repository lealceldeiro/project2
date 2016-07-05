<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductLineManager
 *
 * @ORM\Table(name="product_line_manager")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\ProductLineManagerRepository")
 */
class ProductLineManager extends User
{
    /**
     * @var collection
     *
     * @ORM\ManyToMany(targetEntity="P2\Bundle\ProductBundle\Entity\ProductLine", mappedBy="productLineManager")
     */
    private $productLines;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="SaleManager", mappedBy="productLineManager")
     */
    private $saleManagers;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="DeliveryManager", mappedBy="productLineManager")
     */
    private $deliveryManagers;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="ProductManager", mappedBy="productLineManager")
     */
    private $productManagers;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->productLines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->saleManagers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deliveryManagers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productManagers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productLine
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductLine $productLine
     *
     * @return ProductLineManager
     */
    public function addProductLine(\P2\Bundle\ProductBundle\Entity\ProductLine $productLine)
    {
        $this->productLines[] = $productLine;

        return $this;
    }

    /**
     * Remove productLine
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductLine $productLine
     */
    public function removeProductLine(\P2\Bundle\ProductBundle\Entity\ProductLine $productLine)
    {
        $this->productLines->removeElement($productLine);
    }

    /**
     * Get productLines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductLines()
    {
        return $this->productLines;
    }

    /**
     * Add saleManager
     *
     * @param \P2\Bundle\UserBundle\Entity\SaleManager $saleManager
     *
     * @return ProductLineManager
     */
    public function addSaleManager(\P2\Bundle\UserBundle\Entity\SaleManager $saleManager)
    {
        $this->saleManagers[] = $saleManager;

        return $this;
    }

    /**
     * Remove saleManager
     *
     * @param \P2\Bundle\UserBundle\Entity\SaleManager $saleManager
     */
    public function removeSaleManager(\P2\Bundle\UserBundle\Entity\SaleManager $saleManager)
    {
        $this->saleManagers->removeElement($saleManager);
    }

    /**
     * Get saleManagers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSaleManagers()
    {
        return $this->saleManagers;
    }

    /**
     * Add deliveryManager
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager
     *
     * @return ProductLineManager
     */
    public function addDeliveryManager(\P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager)
    {
        $this->deliveryManagers[] = $deliveryManager;

        return $this;
    }

    /**
     * Remove deliveryManager
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager
     */
    public function removeDeliveryManager(\P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager)
    {
        $this->deliveryManagers->removeElement($deliveryManager);
    }

    /**
     * Get deliveryManagers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveryManagers()
    {
        return $this->deliveryManagers;
    }

    /**
     * Add productManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductManager $productManager
     *
     * @return ProductLineManager
     */
    public function addProductManager(\P2\Bundle\UserBundle\Entity\ProductManager $productManager)
    {
        $this->productManagers[] = $productManager;

        return $this;
    }

    /**
     * Remove productManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductManager $productManager
     */
    public function removeProductManager(\P2\Bundle\UserBundle\Entity\ProductManager $productManager)
    {
        $this->productManagers->removeElement($productManager);
    }

    /**
     * Get productManagers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductManagers()
    {
        return $this->productManagers;
    }
}
