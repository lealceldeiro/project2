<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\CustomerRepository")
 */
class Customer extends User
{
    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=true)
     */
    private $occupation = null;

    /**
     * @var decimal
     *
     * @ORM\Column(name="salary", type="decimal", nullable=true)
     */
    private $salary = null;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_type", type="string", length=255, nullable=true)
     * @Assert\Choice(choices = {"PREMIUM","GOLDEN", "SILVER", "BRONZE", "BASIC"})
     */
    private $customerType = "BASIC";

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\ProductBundle\Entity\ProductReservation", mappedBy="customer")
     */
    private $reservations;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\Payment", mappedBy="customer")
     */
    private $payments;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\CustomerOffer", mappedBy="customer")
     */
    protected $customerOffers;

    /**
     * @var collection
     *
     * @ORM\ManyToMany(targetEntity="P2\Bundle\ProductBundle\Entity\Product")
     */
    private $favoriteProducts;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\OfferBundle\Entity\CreditCard", mappedBy="customer")
     */
    protected $creditCards;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customerOffers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favoriteProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creditCards = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return Customer
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return Customer
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set customerType
     *
     * @param string $customerType
     *
     * @return Customer
     */
    public function setCustomerType($customerType)
    {
        $this->customerType = $customerType;

        return $this;
    }

    /**
     * Get customerType
     *
     * @return string
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * Add reservation
     *
     * @param \P2\Bundle\ProductBundle\Entity\ProductReservation $reservation
     *
     * @return Customer
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
     * Add payment
     *
     * @param \P2\Bundle\OfferBundle\Entity\Payment $payment
     *
     * @return Customer
     */
    public function addPayment(\P2\Bundle\OfferBundle\Entity\Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \P2\Bundle\OfferBundle\Entity\Payment $payment
     */
    public function removePayment(\P2\Bundle\OfferBundle\Entity\Payment $payment)
    {
        $this->payments->removeElement($payment);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Add customerOffer
     *
     * @param \P2\Bundle\OfferBundle\Entity\CustomerOffer $customerOffer
     *
     * @return Customer
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
     * Add favoriteProduct
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $favoriteProduct
     *
     * @return Customer
     */
    public function addFavoriteProduct(\P2\Bundle\ProductBundle\Entity\Product $favoriteProduct)
    {
        $this->favoriteProducts[] = $favoriteProduct;

        return $this;
    }

    /**
     * Remove favoriteProduct
     *
     * @param \P2\Bundle\ProductBundle\Entity\Product $favoriteProduct
     */
    public function removeFavoriteProduct(\P2\Bundle\ProductBundle\Entity\Product $favoriteProduct)
    {
        $this->favoriteProducts->removeElement($favoriteProduct);
    }

    /**
     * Get favoriteProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteProducts()
    {
        return $this->favoriteProducts;
    }

    /**
     * Add creditCard
     *
     * @param \P2\Bundle\OfferBundle\Entity\CreditCard $creditCard
     *
     * @return Customer
     */
    public function addCreditCard(\P2\Bundle\OfferBundle\Entity\CreditCard $creditCard)
    {
        $this->creditCards[] = $creditCard;

        return $this;
    }

    /**
     * Remove creditCard
     *
     * @param \P2\Bundle\OfferBundle\Entity\CreditCard $creditCard
     */
    public function removeCreditCard(\P2\Bundle\OfferBundle\Entity\CreditCard $creditCard)
    {
        $this->creditCards->removeElement($creditCard);
    }

    /**
     * Get creditCards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreditCards()
    {
        return $this->creditCards;
    }

}
