<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as Assert2;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use P2\Bundle\GeneralBundle\Util\Util;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user"="User", "administrator"="Administrator", "customer"="Customer", "product_line_manager"="ProductLineManager", "sale_manager"="SaleManager", "delivery_manager"="DeliveryManager", "product_manager"="ProductManager", "seller"="Seller", "delivery_man"="DeliveryMan"})
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var string
     *
     * USERNAME IS 3-20 characters long AND no _ or . at the begining AND no __ or _. or ._ or .. inside AND a-zA-Z0-9._ are allowed AND no _ or . at the end
     * # is the delimiter into the regular expression
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="#^(?=.{3,20}$)(?![_.])(?![0-9])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$#",
     * message="This username has an invalid structure")
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="middle_name", type="string", length=255, nullable=true)
     */
    protected $middleName='';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=255, nullable=true)
     */
    protected $dni = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="date", nullable=true)
     */
    protected $dateOfBirth = null;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\File(maxSize="100k")
     * @Assert\Image(mimeTypesMessage="Please, upload a valid image.")
     */
    protected $pictureFile;

    // for temporary storage
    private $tempPicturePath;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_path", type="string", length=255, nullable=true)
     */
    protected $picturePath;

    /**
    * @var boolean
    *
    * @ORM\Column(name="active", type="boolean", nullable=true)
    */
    protected  $active = true;
    
    /**
     * @var collection
     *
     * @ORM\ManyToMany(targetEntity="P2\Bundle\RoleBundle\Entity\Role")
     */
    protected $roles;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="users")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

    /**
     * @var \P2\Bundle\StoreBundle\Entity\Store
     *
     * @ORM\ManyToOne(targetEntity="P2\Bundle\StoreBundle\Entity\Store", inversedBy="users")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     */
    protected $store;

    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="Notification", mappedBy="user")
     */
    protected $notifications;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notifications = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get specific user type
     */
    public function getType()
    {
        return 'User';
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return User
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
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
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add role
     *
     * @param \P2\Bundle\RoleBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\P2\Bundle\RoleBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \P2\Bundle\RoleBundle\Entity\Role $role
     */
    public function removeRole(\P2\Bundle\RoleBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Set roles
     *
     * @return User
     */
    public function setRoles(\Doctrine\Common\Collections\ArrayCollection $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get hasRole
     *
     * @return boolean
     */
    public function hasRole(\P2\Bundle\RoleBundle\Entity\Role $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * Set address
     *
     * @param \P2\Bundle\UserBundle\Entity\Address $address
     *
     * @return User
     */
    public function setAddress(\P2\Bundle\UserBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \P2\Bundle\UserBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set store
     *
     * @param \P2\Bundle\StoreBundle\Entity\Store $store
     *
     * @return User
     */
    public function setStore(\P2\Bundle\StoreBundle\Entity\Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \P2\Bundle\StoreBundle\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Add notification
     *
     * @param \P2\Bundle\UserBundle\Entity\Notification $notification
     *
     * @return User
     */
    public function addNotification(\P2\Bundle\UserBundle\Entity\Notification $notification)
    {
        $this->notifications[] = $notification;

        return $this;
    }

    /**
     * Remove notification
     *
     * @param \P2\Bundle\UserBundle\Entity\Notification $notification
     */
    public function removeNotification(\P2\Bundle\UserBundle\Entity\Notification $notification)
    {
        $this->notifications->removeElement($notification);
    }

    /**
     * Get notifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /****************************************************************/
    /*                  PROFILE PICTURE TREATMENT                   */
    /****************************************************************/
    /**
     * Set picturePath
     *
     * @param string $picturePathParam
     * @return User
     */
    public function setPicturePath($picturePathParam)
    {
        $this->picturePath = $picturePathParam;

        return $this;
    }

    /**
     * Get picturePath
     *
     * @return string 
     */
    public function getPicturePath()
    {
        return $this->picturePath;
    }

    /**
     * Get the absolute path of the picturePath
     */
    public function getPictureAbsolutePath()
    {
        return null === $this->picturePath
            ? null
            : $this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->picturePath;
    }

    /**
     * Get the web path for the user
     * 
     * @return string
     */
    public function getPictureWebPath()
    {

        return null === $this->picturePath
        ? null
        : $this->getUploadDir().'/'.$this->picturePath; 
    }

    /**
     * Get root directory for file uploads
     * 
     * @return string
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // files should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDir(); // /../ five times for getting back to the app root irectory
    }

    /**
     * Specifies where in the /web directory profile pic uploads are stored
     * 
     * @return string
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/user/profilepics';
    }

    /**
     * Sets the file used for profile picture uploads
     * 
     * @param UploadedFile $file
     * @return object
     */
    public function setPictureFile(UploadedFile $file = null) {
        // set the value of the holder
        $this->pictureFile = $file;

        // check if there is an old image path
        if (isset($this->picturePath)) {
            // store the old name to delete it after the update
            $this->tempPicturePath = $this->picturePath;
            $this->picturePath = null;
        } else {
            $this->picturePath = 'initial';
        }

        return $this;
    }

    /**
     * Get the file used for profile picture uploads
     * 
     * @return UploadedFile
     */
    public function getPictureFile() {

        return $this->pictureFile;
    }

    /**
     * Persist image profile before persisting/updating user information
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadPicture() {
        if (null !== $this->getPictureFile()) {
            // a file was uploaded
            //filename is some random string plus the user's identifier (so it's guaranteed that it's unique in the filesystem)
            $filename = 'pp'.Util::getSalt();
            $this->picturePath = $filename.'.'.$this->getPictureFile()->guessExtension();
        }
    }

    /**
     * 
     * Upload the profile picture
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     * 
     * @return mixed
     */
    public function uploadPicture() {
        // check there is a profile pic to upload
        if (null === $this-> getPictureFile()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getPictureFile()->move($this->getUploadRootDir(), $this->picturePath);

        // check if there is an old image
        if (isset($this->tempPicturePath) && file_exists($this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->tempPicturePath)) {
            // delete the old image
            unlink($this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->tempPicturePath);
            // clear the temp image path
            $this->tempPicturePath = null;
        }
        $this->pictureFile = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removePictureFile()
    {
        $file = $this->getPictureAbsolutePath();
        if ($file) {
            if (file_exists($this->getPictureAbsolutePath()))
            {
                unlink($file);
            }
        }
    }

    /****************************************************************/
    /*                  END OF PROFILE PICTURE TREATMENT                   */
    /****************************************************************/


    /**
     * Get attribute
     *
     * String representation of the User entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->username;
    }
}
