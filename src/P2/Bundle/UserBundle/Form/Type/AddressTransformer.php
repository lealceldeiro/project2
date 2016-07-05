<?php

namespace P2\Bundle\UserBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\DataTransformerInterface;

class AddressTransformer implements DataTransformerInterface
{

	private $entityManager;

public function __construct(EntityManager $entityManager)
{
    $this->entityManager = $entityManager;
}

public function transform($address)
{
    if (null === $address) {
        return '';
    }

    return $address->__toString();
}

public function reverseTransform($addressString)
{
    if (!$addressString) {
        return;
    }

    $address = $this->entityManager->getRepository('P2UserBundle:Address')->findOneBySearch($addressString);

    if (null === $address) {
        throw new TransformationFailedException(sprintf('"%s" does not exist.',
            $addressString
        ));
    }

    return $address;
 }
 
}