<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * @var boolean
     *
     * @ORM\Column(name="not_read", type="boolean", nullable=true)
     */
    private $notRead = true;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="notifications")
     */
    private $user;


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
     * Set title
     *
     * @param string $title
     *
     * @return Notification
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Notification
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set notRead
     *
     * @param boolean $notRead
     *
     * @return Notification
     */
    public function setNotRead($notRead)
    {
        $this->notRead = $notRead;

        return $this;
    }

    /**
     * Get notRead
     *
     * @return boolean
     */
    public function getNotRead()
    {
        return $this->notRead;
    }

    /**
     * Set user
     *
     * @param \P2\Bundle\UserBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\P2\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \P2\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
