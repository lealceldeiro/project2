<?php

namespace P2\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrator
 *
 * @ORM\Table(name="administrator")
 * @ORM\Entity(repositoryClass="P2\Bundle\UserBundle\Entity\Repository\AdministratorRepository")
 */
class Administrator extends User
{

	/**
     * Get specific user type
     */
    public function getType()
    {
        return 'Administrator';
    }

}
