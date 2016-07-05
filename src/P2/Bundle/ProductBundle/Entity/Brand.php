<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\BrandRepository")
 */
class Brand
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
     * @ORM\Column(name="_label", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $label;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="brand")
     */
    private $products;
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set label
     *
     * @param string $label
     *
     * @return Brand
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add product
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $product
     *
     * @return Brand
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
     * String representation of the Brand entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->label;
    }
}
