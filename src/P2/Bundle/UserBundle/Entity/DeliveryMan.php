<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeliveryMan
 *
 * @ORM\Table(name="delivery_man")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\DeliveryManRepository")
 */
class DeliveryMan extends User
{
    /**
     * @var \P2\Bundle\UserBundle\Entity\DeliveryManager
     *
     * @ORM\ManyToOne(targetEntity="DeliveryManager", inversedBy="deliveryMen")
     * @ORM\JoinColumn(name="delivery_manager_id", referencedColumnName="id")
     */
    private $deliveryManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\ProductBundle\Entity\Delivery", mappedBy="deliveryMan")
     */
    private $deliveries;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->deliveries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set deliveryManager
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager
     *
     * @return DeliveryMan
     */
    public function setDeliveryManager(\P2\Bundle\UserBundle\Entity\DeliveryManager $deliveryManager = null)
    {
        $this->deliveryManager = $deliveryManager;

        return $this;
    }

    /**
     * Get deliveryManager
     *
     * @return \P2\Bundle\UserBundle\Entity\DeliveryManager
     */
    public function getDeliveryManager()
    {
        return $this->deliveryManager;
    }

    /**
     * Add delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     *
     * @return DeliveryMan
     */
    public function addDelivery(\P2\Bundle\ProductBundle\Entity\Delivery $delivery)
    {
        $this->deliveries[] = $delivery;

        return $this;
    }

    /**
     * Remove delivery
     *
     * @param \P2\Bundle\ProductBundle\Entity\Delivery $delivery
     */
    public function removeDelivery(\P2\Bundle\ProductBundle\Entity\Delivery $delivery)
    {
        $this->deliveries->removeElement($delivery);
    }

    /**
     * Get deliveries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveries()
    {
        return $this->deliveries;
    }

}
