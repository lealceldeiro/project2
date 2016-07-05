<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="state_province", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $stateProvince;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="avenue", type="string", length=255, nullable=true)
     */
    private $avenue = null;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255, nullable=true)
     */
    private $town = null;

    /**
     * @var string
     *
     * @ORM\Column(name="search", type="string", length=255, nullable=true)
     */
    private $search = '';

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="address")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set country
     *
     * @param string $country
     *
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set stateProvince
     *
     * @param string $stateProvince
     *
     * @return Address
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get stateProvince
     *
     * @return string
     */
    public function getStateProvince()
    {
        return $this->stateProvince;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     *
     * @return Address
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set avenue
     *
     * @param string $avenue
     *
     * @return Address
     */
    public function setAvenue($avenue)
    {
        $this->avenue = $avenue;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get avenue
     *
     * @return string
     */
    public function getAvenue()
    {
        return $this->avenue;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Address
     */
    public function setTown($town)
    {
        $this->town = $town;

        $this->updateSearch();

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Add user
     *
     * @param \P2\Bundle\UserBundle\Entity\User $user
     *
     * @return Address
     */
    public function addUser(\P2\Bundle\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \P2\Bundle\UserBundle\Entity\User $user
     */
    public function removeUser(\P2\Bundle\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __toString()
    {
        return $this->search;
    }

    /**
     * Set search
     *
     * @param string $search
     *
     * @return Address
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    private function updateSearch()
    {
        $ts = $this->street.' '.$this->houseNumber;
        if ($this->avenue){
            $ts .= ', '.$this->avenue;
        }
        if ($this->town){
            $ts .= ', '.$this->town;
        }

        $ts .= ', '.$this->stateProvince.', '.$this->country;

        return $ts;
    }
}
