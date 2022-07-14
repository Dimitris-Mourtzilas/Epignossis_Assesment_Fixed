<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    const roles = [
        0=>'admin',
        1=>'employee'
    ];

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $nick_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getNickName(): ?string
    {
        return $this->nick_name;
    }

    public function setNickName(?string $nick_name): self
    {
        $this->nick_name = $nick_name;

        return $this;
    }
}
