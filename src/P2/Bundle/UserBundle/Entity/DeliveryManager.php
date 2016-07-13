<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeliveryManager
 *
 * @ORM\Table(name="delivery_manager")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\DeliveryManagerRepository")
 */
class DeliveryManager extends User
{
    /**
     * @var \P2\Bundle\UserBundle\Entity\ProductLineManager
     *
     * @ORM\ManyToOne(targetEntity="ProductLineManager", inversedBy="deliveryManagers")
     * @ORM\JoinColumn(name="product_line_manager_id", referencedColumnName="id")
     */
    private $productLineManager;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="DeliveryMan", mappedBy="deliveryManager")
     */
    private $deliveryMen;

    /**
     * Constructor
     */
    public function __construct()
    {        
        parent::__construct();
        $this->deliveryMen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set productLineManager
     *
     * @param \P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager
     *
     * @return DeliveryManager
     */
    public function setProductLineManager(\P2\Bundle\UserBundle\Entity\ProductLineManager $productLineManager = null)
    {
        $this->productLineManager = $productLineManager;

        return $this;
    }

    /**
     * Get productLineManager
     *
     * @return \P2\Bundle\UserBundle\Entity\ProductLineManager
     */
    public function getProductLineManager()
    {
        return $this->productLineManager;
    }

    /**
     * Add deliveryMan
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan
     *
     * @return DeliveryManager
     */
    public function addDeliveryMan(\P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan)
    {
        $this->deliveryMen[] = $deliveryMan;

        return $this;
    }

    /**
     * Remove deliveryMan
     *
     * @param \P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan
     */
    public function removeDeliveryMan(\P2\Bundle\UserBundle\Entity\DeliveryMan $deliveryMan)
    {
        $this->deliveryMen->removeElement($deliveryMan);
    }

    /**
     * Get deliveryMen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveryMen()
    {
        return $this->deliveryMen;
    }

}
