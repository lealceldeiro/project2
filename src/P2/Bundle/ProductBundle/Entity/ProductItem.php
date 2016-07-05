<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductItem
 *
 * @ORM\Table(name="product_item")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\ProductItemRepository")
 */
class ProductItem
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
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $attributeName;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_value", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $attributeValue;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="attributes")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;


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
     * Set type
     *
     * @param string $type
     *
     * @return ProductItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attributeName
     *
     * @param string $attributeName
     *
     * @return ProductItem
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * Get attributeName
     *
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Set attributeValue
     *
     * @param string $attributeValue
     *
     * @return ProductItem
     */
    public function setAttributeValue($attributeValue)
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * Get attributeValue
     *
     * @return string
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * Set product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     *
     * @return ProductItem
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
     * Get attribute
     *
     * String representation of the ProductItem entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
