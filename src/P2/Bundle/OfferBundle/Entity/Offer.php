<?php

namespace P2\Bundle\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="P2\Bundle\OfferBundle\Entity\Repository\OfferRepository")
 */
class Offer
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description = null;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_route", type="string", length=255, nullable=true)
     * @Assert\Image()
     */
    private $photoRoute = null;

    /**
     * @var P2\Bundle\UserBundle\Entity\Seller
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Seller", inversedBy="offers")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="CustomerOffer", mappedBy="offer")
     */
    protected $customerOffers;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="OfferItem", mappedBy="offer")
     */
    protected $offerItems;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customerOffers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     *
     * @return Offer
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
     * Set photoRoute
     *
     * @param string $photoRoute
     *
     * @return Offer
     */
    public function setPhotoRoute($photoRoute)
    {
        $this->photoRoute = $photoRoute;

        return $this;
    }

    /**
     * Get photoRoute
     *
     * @return string
     */
    public function getPhotoRoute()
    {
        return $this->photoRoute;
    }

    /**
     * Set seller
     *
     * @param \P2\Bundle\UserBundle\Entity\Seller $seller
     *
     * @return Offer
     */
    public function setSeller(\P2\Bundle\UserBundle\Entity\Seller $seller = null)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return \P2\Bundle\UserBundle\Entity\Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Add customerOffer
     *
     * @param \P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer
     *
     * @return Offer
     */
    public function addCustomerOffer(\P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer)
    {
        $this->customerOffers[] = $customerOffer;

        return $this;
    }

    /**
     * Remove customerOffer
     *
     * @param \P2\Bundle\OfferBundle\Entity\Customer_Offer $customerOffer
     */
    public function removeCustomerOffer(\P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer)
    {
        $this->customerOffers->removeElement($customerOffer);
    }

    /**
     * Get customerOffers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomerOffers()
    {
        return $this->customerOffers;
    }

    /**
     * Add offerItem
     *
     * @param \P2\Bundle\OfferBundle\Entity\OfferItem $offerItem
     *
     * @return Offer
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
     * Get attribute
     *
     * String representation of the Offer entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->description;
    }
}
