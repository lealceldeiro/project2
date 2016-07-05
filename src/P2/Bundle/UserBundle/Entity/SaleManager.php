<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaleManager
 *
 * @ORM\Table(name="sale_manager")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\SaleManagerRepository")
 */
class SaleManager extends User
{
    /**
     * @var P2\Bundle\UserBundle\Entity\ProductLineManager
     *
     * @ORM\ManyToOne(targetEntity="ProductLineManager", inversedBy="saleManagers")
     * @ORM\JoinColumn(name="product_line_manager_id", referencedColumnName="id")
     */
    private $productLineManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="Seller", mappedBy="saleManager")
     */
    private $sellers;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->sellers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set productLineManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager
     *
     * @return SaleManager
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
     * Add seller
     *
     * @param \P2\Bundle\UserBundle\Entity\Seller $seller
     *
     * @return SaleManager
     */
    public function addSeller(\P2\Bundle\UserBundle\Entity\Seller $seller)
    {
        $this->sellers[] = $seller;

        return $this;
    }

    /**
     * Remove seller
     *
     * @param \P2\Bundle\UserBundle\Entity\Seller $seller
     */
    public function removeSeller(\P2\Bundle\UserBundle\Entity\Seller $seller)
    {
        $this->sellers->removeElement($seller);
    }

    /**
     * Get sellers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellers()
    {
        return $this->sellers;
    }

}
