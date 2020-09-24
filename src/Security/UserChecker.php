<?php

namespace App\Security;

use App\Entity\Person;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $person)
    {
        if (!$person instanceof Person) {
            return;
        }

        // if (!$person->isActive()) {
        //     throw new CustomUserMessageAuthenticationException(
        //         'Inactive account cannot log-in.'
        //     );
        // }
    }

    public function checkPostAuth(UserInterface $person)
    {
        $this->checkPreAuth($person);
    }
}