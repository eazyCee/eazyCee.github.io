<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
    
    /**
    * @ORM\Column(type="string", length=10)
    */
    private $token;

    /*
    * @ORM\Column(type="boolean", options={"default":"0"})
    */
    private $isActive;

    /*
    * @ORM\Column(type="datetime", nullable=true)
    */
    private $activatedAt;

    /*
    * @ORM\Column(type="string", nullable=true)
    */
    private $sendEmailTo;

    public function __construct(){
        // $date= new DateTime
        $this->roles = array('ROLE_USER');
        // $this->created = $date->format('Y-m-d H:i:s');
        $this->created = new DateTime;
        $this->updated = new DateTime;
        //$this->updatedAt= new DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getRoles()
    {
        return [
            'ROLE_USER'];

    }

  

    public function getSalt() {}

    public function eraseCredentials (){}

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ]);
    }
    public function unserialize($string)
    {
        list (
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ) = unserialize($string,['allowed_classes' =>false]);
    }

      public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

      public function getFirstName(): ?string
      {
          return $this->firstName;
      }

      public function setFirstName(?string $firstName): self
      {
          $this->firstName = $firstName;

          return $this;
      }

      public function getLastName(): ?string
      {
          return $this->lastName;
      }

      public function setLastName(?string $lastName): self
      {
          $this->lastName = $lastName;

          return $this;
      }

      public function getCreated(): ?\DateTimeInterface
      {
          return $this->created;
      }

      public function setCreated(?\DateTimeInterface $created): self
      {
          $this->created = $created;

          return $this;
      }

      public function getUpdated(): ?\DateTimeInterface
      {
          return $this->updated;
      }

      public function setUpdated(?\DateTimeInterface $updated): self
      {
          $this->updated = $updated;

          return $this;
      }

      public function getToken(): ?Token
      {
           return $this->token;
      }

      public function setToken(?string $token): self
      {
          $this->token = $token;

          return $this;
      }

            public function getActivatedAt(): ?\DateTimeInterface
      {
          return $this->activatedAt;
      }

      public function setActivatedAt(?\DateTimeInterface $activatedAt): self
      {
          $this->activatedAt = $activatedAt;;

          return $this;
      }

      public function isActive(): ?isActive
      {
          return $this->isActive;
      }

      public function setActive(?boolean $isActive): self
      {
          $this->isActive = $isActive;

          return $this;
      }

      public function getSendEmailTo(): ?string
    {
        return $this->sendEmailTo;
    }

    public function setSendEmailTo(string $sendEmailTo): self
    {
        $this->sendEmailTo = $sendEmailTo;

        return $this;
    }
      
}
