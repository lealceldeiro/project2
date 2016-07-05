<?php

namespace P2\Bundle\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer_Offer
 *
 * @ORM\Table(name="customer_offer")
 * @ORM\Entity
 */
class CustomerOffer
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
     * @var P2\Bundle\UserBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Customer", inversedBy="customerOffers")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var Offer
     *
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="customerOffers")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     */
    private $offer;

    /**
     * @var P2\Bundle\ProductBundle\Entity\Delivery
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\ProductBundle\Entity\Delivery", inversedBy="customerOffers")
     * @ORM\JoinColumn(name="delivery_id", referencedColumnName="id")
     */
    private $delivery;

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
     * Set customer
     *
     * @param \P2\Bundle\UserBundle\Entity\Customer $customer
     *
     * @return CustomerOffer
     */
    public function setCustomer(\P2\Bundle\UserBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \P2\Bundle\UserBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set offer
     *
     * @param \P2\Bundle\OfferBundle\Entity\Offer $offer
     *
     * @return CustomerOffer
     */
    public function setOffer(\P2\Bundle\OfferBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \P2\Bundle\OfferBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     *
     * @return CustomerOffer
     */
    public function setDelivery(\P2\Bundle\ProductBundle\Entity\Delivery $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \P2\Bundle\ProductBundle\Entity\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Get attribute
     *
     * String representation of the CustomerOffer entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Reservation of offer [". $this->offer . "] by [" . $this->customer . "]";
    }
}
