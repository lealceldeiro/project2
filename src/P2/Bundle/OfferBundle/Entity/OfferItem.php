<?php

namespace P2\Bundle\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OfferItem
 *
 * @ORM\Table(name="offer_item")
 * @ORM\Entity(repositoryClass="P2\Bundle\OfferBundle\Entity\Repository\OfferItemRepository")
 */
class OfferItem
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
     * @var decimal
     *
     * @ORM\Column(name="discount", type="decimal", nullable=true)
     * @Assert\GreaterThanOrEqual(value = 0)
     */
    private $discount = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description = null;

    /**
    * @var \P2\Bundle\ProductBundle\Entity\Product
    *
    * @ORM\ManyToOne(targetEntity="P2\Bundle\ProductBundle\Entity\Product", inversedBy="offerItems")
    * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
    */
    private $product;

    /**
    * @var Offer
    *
    * @ORM\ManyToOne(targetEntity="Offer", inversedBy="offerItems")
    * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
    */
    private $offer;

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
     * @return OfferItem
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
     * Set discount
     *
     * @param string $discount
     *
     * @return OfferItem
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return OfferItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     *
     * @return OfferItem
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
     * Set offer
     *
     * @param \P2\Bundle\OfferBundle\Entity\Offer $offer
     *
     * @return OfferItem
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
     * Get attribute
     *
     * String representation of the OfferItem entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Offer Item for [". $this->product . "] [" . $this->productAmount . "]";
    }
}
