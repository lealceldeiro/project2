<?php

namespace P2\Bundle\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="P2\Bundle\OfferBundle\Entity\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\Column(name="payment_type", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"Credit card", "Cash", "Check"})
     */
    private $paymentType;

    /**
     * @var decimal
     *
     * @ORM\Column(name="amount_deposited", type="decimal")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     */
    private $amountDeposited;

    /**
     * @var decimal
     *
     * @ORM\Column(name="_change", type="decimal", nullable=true)
     * @Assert\GreaterThanOrEqual(value = 0)
     */
    private $change = 0;

    /**
     * @var P2\Bundle\UserBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Customer", inversedBy="payments")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;


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
     * Set paymentType
     *
     * @param string $paymentType
     *
     * @return Payment
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set amountDeposited
     *
     * @param string $amountDeposited
     *
     * @return Payment
     */
    public function setAmountDeposited($amountDeposited)
    {
        $this->amountDeposited = $amountDeposited;

        return $this;
    }

    /**
     * Get amountDeposited
     *
     * @return string
     */
    public function getAmountDeposited()
    {
        return $this->amountDeposited;
    }

    /**
     * Set change
     *
     * @param string $change
     *
     * @return Payment
     */
    public function setChange($change)
    {
        $this->change = $change;

        return $this;
    }

    /**
     * Get change
     *
     * @return string
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * Set customer
     *
     * @param \P2\Bundle\UserBundle\Entity\Customer $customer
     *
     * @return Payment
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
     * Get attribute
     *
     * String representation of the payment entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Payment [". $this->paymentType . "] by " . $this->customer;
    }
}
