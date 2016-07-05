<?php

namespace P2\Bundle\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as Assert2;

/**
 * Store
 *
 * @ORM\Table(name="store")
 * @ORM\Entity(repositoryClass="P2\Bundle\StoreBundle\Entity\Repository\StoreRepository")
 */
class Store
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="store_user", type="string", length=255)
     * @Assert\NotBlank()
     * Regex(pattern="^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$")
     */
    private $storeUser;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     * FIXME -- UserPassword()
     */
    private $password;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="P2\Bundle\UserBundle\Entity\User", mappedBy="store")
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
     * Set name
     *
     * @param string $name
     *
     * @return Store
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set storeUser
     *
     * @param string $storeUser
     *
     * @return Store
     */
    public function setStoreUser($storeUser)
    {
        $this->storeUser = $storeUser;

        return $this;
    }

    /**
     * Get storeUser
     *
     * @return string
     */
    public function getStoreUser()
    {
        return $this->storeUser;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Store
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add user
     *
     * @param \P2\Bundle\UserBundle\Entity\User $user
     *
     * @return Store
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

    /**
     * @var Get \P2\Bundle\StoreBundle\Entity\Store
     *
     * Returns an instance of this class
     * This method is useful when retrieving entities of
     * this type for showing them (i.e.: in <select> tags) making usage of the EntityChoiceList class.
     */
    public function getStore()
    {
        return $this;
    }

    /**
     * Get attribute
     *
     * String representation of the Store entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
