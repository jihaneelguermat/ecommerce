<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as Mapping;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[Mapping\Entity(repositoryClass: UserRepository::class)]
#[Mapping\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Mapping\Id]
    #[Mapping\GeneratedValue]
    #[Mapping\Column]
    private ?int $id = null;

    #[Mapping\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[Mapping\Column]
    private array $roles = [];

    #[Mapping\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Nettoyage si données sensibles temporaires stockées
    }
}