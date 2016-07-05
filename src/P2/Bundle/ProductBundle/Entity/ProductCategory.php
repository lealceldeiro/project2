<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductCategory
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\ProductCategoryRepository")
 */
class ProductCategory
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
     * @ORM\OneToMany(targetEntity="ProductCategory", mappedBy="parent")
     **/
    private $children;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ProductCategory
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
     * Add child
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductCategory $child
     *
     * @return ProductCategory
     */
    public function addChild(\P2\Bundle\ProductBundle\Entity\ProductCategory $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductCategory $child
     */
    public function removeChild(\P2\Bundle\ProductBundle\Entity\ProductCategory $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductCategory $parent
     *
     * @return ProductCategory
     */
    public function setParent(\P2\Bundle\ProductBundle\Entity\ProductCategory $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \P2\Bundle\ProductBundle\Entity\ProductCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get attribute
     *
     * String representation of the ProductCategory entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->label;
    }
}
