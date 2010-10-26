<?php

namespace Symfony\Bundle\DoctrineBundle\Security;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\User\UserProviderInterface;
use Symfony\Component\Security\Exception\UsernameNotFoundException;

class EntityUserProvider implements UserProviderInterface
{
    protected $repository;
    protected $property;

    public function __construct($em, $class, $property = null)
    {
        $this->repository = $em->getRepository($class);
        $this->property = $property;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        if (null !== $this->property) {
            $user = $this->repository->findOneBy(array($this->property => $username));
        } else {
            if (!$this->repository instanceof UserProviderInterface) {
                throw new \InvalidArgumentException('The Doctrine user manager must implement UserManagerInterface.');
            }

            $user = $this->repository->loadUserByUsername($username);
        }

        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        return $user;
    }
}
