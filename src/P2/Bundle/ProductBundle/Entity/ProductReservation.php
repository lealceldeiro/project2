<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductReservation
 *
 * @ORM\Table(name="product_reservation")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\ProductReservationRepository")
 */
class ProductReservation
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
     * @var integer
     *
     * @ORM\Column(name="product_amount", type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     */
    private $productAmount;

    /**
     * @var \P2\Bundle\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="reservations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var \P2\Bundle\UserBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Customer", inversedBy="reservations")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var Delivery
     *
     * @ORM\ManyToOne(targetEntity="Delivery", inversedBy="reservations")
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
     * Set productAmount
     *
     * @param integer $productAmount
     *
     * @return ProductReservation
     */
    public function setProductAmount($productAmount)
    {
        $this->productAmount = $productAmount;

        return $this;
    }

    /**
     * Get productAmount
     *
     * @return integer
     */
    public function getProductAmount()
    {
        return $this->productAmount;
    }

    /**
     * Set product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     *
     * @return ProductReservation
     */
    public function setProduct(\P2\Bundle\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \P2\Bundle\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set customer
     *
     * @param \P2\Bundle\UserBundle\Entity\Customer $customer
     *
     * @return ProductReservation
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
     * Set delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     *
     * @return ProductReservation
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
     * String representation of the ProductReservation entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Reservation ". $this->product."-".$this->customer;
    }
}
