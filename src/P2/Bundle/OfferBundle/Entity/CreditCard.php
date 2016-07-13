<?php

namespace P2\Bundle\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CreditCard
 *
 * @ORM\Table(name="credit_card")
 * @ORM\Entity(repositoryClass="P2\Bundle\OfferBundle\Entity\Repository\CreditCardRepository")
 */
class CreditCard
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
     * @ORM\Column(name="credit_card_type", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"AMEX", "CHINA_UNIONPAY", "DINERS", "DISCOVER", "INSTAPAYMENT", "JCB", "LASER", "MAESTRO", "MASTERCARD", "VISA"})
     */
    private $creditCardType;

    /**
     * @var string
     *
     * @ORM\Column(name="credit_card_number", type="integer")
     * @Assert\NotBlank()
     * @Assert\CardScheme(schemes = {"AMEX", "CHINA_UNIONPAY", "DINERS", "DISCOVER", "INSTAPAYMENT", "JCB", "LASER", "MAESTRO", "MASTERCARD", "VISA"})
     */
    private $creditCardNumber;

    /**
     * @var \P2\Bundle\UserBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\UserBundle\Entity\Customer", inversedBy="creditCards")
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
     * Set creditCardType
     *
     * @param string $creditCardType
     *
     * @return CreditCard
     */
    public function setCreditCardType($creditCardType)
    {
        $this->creditCardType = $creditCardType;

        return $this;
    }

    /**
     * Get creditCardType
     *
     * @return string
     */
    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    /**
     * Set creditCardNumber
     *
     * @param integer $creditCardNumber
     *
     * @return CreditCard
     */
    public function setCreditCardNumber($creditCardNumber)
    {
        $this->creditCardNumber = $creditCardNumber;

        return $this;
    }

    /**
     * Get creditCardNumber
     *
     * @return integer
     */
    public function getCreditCardNumber()
    {
        return $this->creditCardNumber;
    }

    /**
     * Set customer
     *
     * @param \P2\Bundle\UserBundle\Entity\Customer $customer
     *
     * @return CreditCard
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
     * String representation of the CreditCard entity.
     *
     * @return string
     */
    public function __toString()
    {
        return "Credit card ". $this->creditCardType;
    }
}
