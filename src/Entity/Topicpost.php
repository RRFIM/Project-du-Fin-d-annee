<?php

namespace App\Entity;

use App\Repository\TopicpostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Topic>
     */
    #[ORM\OneToMany(targetEntity: Topic::class, mappedBy: 'topicpost')]
    private Collection $topic_id;

    public function __construct()
    {
        $this->topic_id = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Topic>
     */
    public function getTopicId(): Collection
    {
        return $this->topic_id;
    }

    public function addTopicId(Topic $topicId): static
    {
        if (!$this->topic_id->contains($topicId)) {
            $this->topic_id->add($topicId);
            $topicId->setTopicpost($this);
        }

        return $this;
    }

    public function removeTopicId(Topic $topicId): static
    {
        if ($this->topic_id->removeElement($topicId)) {
            // set the owning side to null (unless already changed)
            if ($topicId->getTopicpost() === $this) {
                $topicId->setTopicpost(null);
            }
        }

        return $this;
    }
}
