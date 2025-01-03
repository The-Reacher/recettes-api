<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordUpdateSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    // inject userPasswordHasherInterface
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function onBeforeEntityPersisted(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!$entity instanceof User) {
            return;
        }

        if (!is_null($entity->getPlainPassword()) && '' != $entity->getPlainPassword()) {
            $entity->setPassword(
                $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword())
            );
        }
    }

    public function onBeforeEntityUpdated(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!$entity instanceof User) {
            return;
        }

        if (!is_null($entity->getPlainPassword()) && '' != $entity->getPlainPassword()) {
            $entity->setPassword(
                $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword())
            );
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersisted',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityUpdated',
        ];
    }
}
