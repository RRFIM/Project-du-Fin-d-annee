<?php

namespace App\Entity;

use App\Config\UserStatus;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_subscribed_to_newsletter = null;

    #[ORM\Column]
    private ?bool $has_badge = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_url = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: UserStatus::class)]
    private array $status = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSubscribedToNewsletter(): ?bool
    {
        return $this->is_subscribed_to_newsletter;
    }

    public function setIsSubscribedToNewsletter(bool $is_subscribed_to_newsletter): static
    {
        $this->is_subscribed_to_newsletter = $is_subscribed_to_newsletter;

        return $this;
    }

    public function hasBadge(): ?bool
    {
        return $this->has_badge;
    }

    public function setHasBadge(bool $has_badge): static
    {
        $this->has_badge = $has_badge;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->picture_url;
    }

    public function setPictureUrl(string $picture_url): static
    {
        $this->picture_url = $picture_url;

        return $this;
    }

    /**
     * @return UserStatus[]
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    public function setStatus(array $status): static
    {
        $this->status = $status;

        return $this;
    }
}
