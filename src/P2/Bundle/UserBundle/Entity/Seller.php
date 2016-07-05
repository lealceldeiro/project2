<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seller
 *
 * @ORM\Table(name="seller")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\SellerRepository")
 */
class Seller extends User
{
    /**
     * @var P2\Bundle\UserBundle\Entity\SaleManager
     *
     * @ORM\ManyToOne(targetEntity="SaleManager", inversedBy="sellers")
     * @ORM\JoinColumn(name="sale_manager_id", referencedColumnName="id")
     */
    private $saleManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\Offer", mappedBy="seller")
     */
    private $offers;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\ProductBundle\Entity\Delivery", mappedBy="seller")
     */
    private $deliveries;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deliveries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set saleManager
     *
     * @param \P2\Bundle\UserBundle\Entity\SaleManager $saleManager
     *
     * @return Seller
     */
    public function setSaleManager(\P2\Bundle\UserBundle\Entity\SaleManager $saleManager = null)
    {
        $this->saleManager = $saleManager;

        return $this;
    }

    /**
     * Get saleManager
     *
     * @return \P2\Bundle\UserBundle\Entity\SaleManager
     */
    public function getSaleManager()
    {
        return $this->saleManager;
    }

    /**
     * Add offer
     *
     * @param \P2\Bundle\OfferBundle\Entity\Offer $offer
     *
     * @return Seller
     */
    public function addOffer(\P2\Bundle\OfferBundle\Entity\Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \P2\Bundle\OfferBundle\Entity\Offer $offer
     */
    public function removeOffer(\P2\Bundle\OfferBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Add delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     *
     * @return Seller
     */
    public function addDelivery(\P2\Bundle\ProductBundle\Entity\Delivery $delivery)
    {
        $this->deliveries[] = $delivery;

        return $this;
    }

    /**
     * Remove delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     */
    public function removeDelivery(\P2\Bundle\ProductBundle\Entity\Delivery $delivery)
    {
        $this->deliveries->removeElement($delivery);
    }

    /**
     * Get deliveries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveries()
    {
        return $this->deliveries;
    }

}
