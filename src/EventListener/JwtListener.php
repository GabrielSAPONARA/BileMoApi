<?php

namespace App\EventListener;

use App\Entity\UserAccount;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JwtListener
{
    public function __construct(private RequestStack $requestStack) {}

    public function onJwtCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof UserAccount) {
            return;
        }

        $data = $event->getData();

        // Add custom claims
        $data['id'] = $user->getId();
        $data['email'] = $user->getEmail();

        $event->setData($data);
    }
}
