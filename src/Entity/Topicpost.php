<?php

namespace App\Entity;

use App\Repository\TopicpostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicpostRepository::class)]
class Topicpost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $post_title = null;

    #[ORM\Column(length: 255)]
    private ?string $post_description = null;

    #[ORM\Column]
    private ?\DateTime $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostTitle(): ?string
    {
        return $this->post_title;
    }

    public function setPostTitle(string $post_title): static
    {
        $this->post_title = $post_title;

        return $this;
    }

    public function getPostDescription(): ?string
    {
        return $this->post_description;
    }

    public function setPostDescription(string $post_description): static
    {
        $this->post_description = $post_description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
