<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\ProductRepository")
 */
class Product
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
     * @var boolean
     * 
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = true;

    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $productName;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     */
    private $amount;

    /**
     * @var ProductLine
     *
     * @ORM\ManyToOne(targetEntity="ProductLine", inversedBy="products")
     * @ORM\JoinColumn(name="product_line_id", referencedColumnName="id")
     */
    private $productLine;

    /**
     * @var \P2\Bundle\UserBundle\Entity\ProductManager
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\ProductManager", inversedBy="products")
     * @ORM\JoinColumn(name="product_manager_id", referencedColumnName="id")
     */
    private $productManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="ProductItem", mappedBy="product")
     */
    private $attributes;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="ProductReservation", mappedBy="product")
     */
    private $reservations;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\OfferItem", mappedBy="product")
     */
    private $offerItems;
    
    /**
     * @var collection
     *
     * @ORM\ManyToMany(targetEntity="ProductCategory")
     */
    protected $categories;

    /**
     * @var Brand
     *
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="products")
     */
    private $brand;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Product
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set productLine
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductLine $productLine
     *
     * @return Product
     */
    public function setProductLine(\P2\Bundle\ProductBundle\Entity\ProductLine $productLine = null)
    {
        $this->productLine = $productLine;

        return $this;
    }

    /**
     * Get productLine
     *
     * @return \P2\Bundle\ProductBundle\Entity\ProductLine
     */
    public function getProductLine()
    {
        return $this->productLine;
    }

    /**
     * Set productManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductManager $productManager
     *
     * @return Product
     */
    public function setProductManager(\P2\Bundle\UserBundle\Entity\ProductManager $productManager = null)
    {
        $this->productManager = $productManager;

        return $this;
    }

    /**
     * Get productManager
     *
     * @return \P2\Bundle\UserBundle\Entity\ProductManager
     */
    public function getProductManager()
    {
        return $this->productManager;
    }

    /**
     * Add attribute
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductItem $attribute
     *
     * @return Product
     */
    public function addAttribute(\P2\Bundle\ProductBundle\Entity\ProductItem $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductItem $attribute
     */
    public function removeAttribute(\P2\Bundle\ProductBundle\Entity\ProductItem $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add reservation
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductReservation $reservation
     *
     * @return Product
     */
    public function addReservation(\P2\Bundle\ProductBundle\Entity\ProductReservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductReservation $reservation
     */
    public function removeReservation(\P2\Bundle\ProductBundle\Entity\ProductReservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Add offerItem
     *
     * @param \P2\Bundle\OfferBundle\Entity\OfferItem $offerItem
     *
     * @return Product
     */
    public function addOfferItem(\P2\Bundle\OfferBundle\Entity\OfferItem $offerItem)
    {
        $this->offerItems[] = $offerItem;

        return $this;
    }

    /**
     * Remove offerItem
     *
     * @param \P2\Bundle\OfferBundle\Entity\OfferItem $offerItem
     */
    public function removeOfferItem(\P2\Bundle\OfferBundle\Entity\OfferItem $offerItem)
    {
        $this->offerItems->removeElement($offerItem);
    }

    /**
     * Get offerItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfferItems()
    {
        return $this->offerItems;
    }

    /**
     * Add category
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductCategory $category
     *
     * @return Product
     */
    public function addCategory(\P2\Bundle\ProductBundle\Entity\ProductCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductCategory $category
     */
    public function removeCategory(\P2\Bundle\ProductBundle\Entity\ProductCategory $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set brand
     *
     * @param \P2\Bundle\ProductBundle\Entity\Brand $brand
     *
     * @return Product
     */
    public function setBrand(\P2\Bundle\ProductBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \P2\Bundle\ProductBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get attribute
     *
     * String representation of the Product entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->productName . " [" . $this->brand . "]";
    }
}
