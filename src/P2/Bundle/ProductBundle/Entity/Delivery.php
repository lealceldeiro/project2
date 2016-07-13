<?php

namespace P2\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity(repositoryClass="P2\Bundle\ProductBundle\Entity\Repository\DeliveryRepository")
 */
class Delivery
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
     * @var \DateTime
     *
     * @ORM\Column(name="reservation_date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $reservationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desired_delivery_date", type="datetime", nullable=true)
     * @Assert\Date()
     */
    private $desiredDeliveryDate = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean", nullable=true)
     */
    private $done = false;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="ProductReservation", mappedBy="delivery")
     */
    private $reservations;

    /**
     * @var \P2\Bundle\UserBundle\Entity\Seller
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Seller", inversedBy="deliveries")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * @var \P2\Bundle\UserBundle\Entity\DeliveryMan
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\DeliveryMan", inversedBy="deliveries")
     * @ORM\JoinColumn(name="delivery_man_id", referencedColumnName="id")
     */
    private $deliveryMan;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\CustomerOffer", mappedBy="delivery")
     */
    protected $customerOffers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customerOffers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set reservationDate
     *
     * @param \DateTime $reservationDate
     *
     * @return Delivery
     */
    public function setReservationDate($reservationDate)
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    /**
     * Get reservationDate
     *
     * @return \DateTime
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    /**
     * Set desiredDeliveryDate
     *
     * @param \DateTime $desiredDeliveryDate
     *
     * @return Delivery
     */
    public function setDesiredDeliveryDate($desiredDeliveryDate)
    {
        $this->desiredDeliveryDate = $desiredDeliveryDate;

        return $this;
    }

    /**
     * Get desiredDeliveryDate
     *
     * @return \DateTime
     */
    public function getDesiredDeliveryDate()
    {
        return $this->desiredDeliveryDate;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return Delivery
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Add reservation
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductReservation $reservation
     *
     * @return Delivery
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
     * Set seller
     *
     * @param \P2\Bundle\UserBundle\Entity\Seller $seller
     *
     * @return Delivery
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
     * Set deliveryMan
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan
     *
     * @return Delivery
     */
    public function setDeliveryMan(\P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan = null)
    {
        $this->deliveryMan = $deliveryMan;

        return $this;
    }

    /**
     * Get deliveryMan
     *
     * @return \P2\Bundle\UserBundle\Entity\DeliveryMan
     */
    public function getDeliveryMan()
    {
        return $this->deliveryMan;
    }

    /**
     * Add customerOffer
     *
     * @param \P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer
     *
     * @return Delivery
     */
    public function addCustomerOffer(\P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer)
    {
        $this->customerOffers[] = $customerOffer;

        return $this;
    }

    /**
     * Remove customerOffer
     *
     * @param \P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer
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
     * Get attribute
     *
     * String representation of the Delivery entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Delivery [date_". $this->reservationDate . "]";
    }
}
