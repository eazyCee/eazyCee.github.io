<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class PersonFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $person = new Person();
            $person->setEmail ('ncrst' . $i . '@gipe2020.com');
            $person->setPassword($this->passwordEncoder->encodePassword
            (
                $person,
               'gipe2020!'.$i
            ));
            $person->setCreatedAt (new \DateTime());
            $manager->persist ($person);
        }
        $manager->flush();
    }
}
