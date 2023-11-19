<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

final class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        // Ajout des informations ci-dessous dans le token
        $payload = $event->getData();

        // on definit ce que c'est user pour l'IDE
        /**
         * @var User $user
         */
        $user = $event->getUser();

        $payload['email'] = $user->getUserIdentifier();

        // exemple de ce qu'on peux ajouter dans le token :
        // $payload['countRecipes'] = count($user->getRecipes());

        $event->setData($payload);
    }
}
