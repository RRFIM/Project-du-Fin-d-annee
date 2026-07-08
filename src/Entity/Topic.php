<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $post_title = null;

    #[ORM\Column]
    private ?\DateTime $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'topics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Topicpost>
     */
    #[ORM\OneToMany(targetEntity: Topicpost::class, mappedBy: 'topic', orphanRemoval: true)]
    private Collection $topicposts;

    public function __construct()
    {
        $this->topicposts = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Topicpost>
     */
    public function getTopicposts(): Collection
    {
        return $this->topicposts;
    }

    public function addTopicpost(Topicpost $topicpost): static
    {
        if (!$this->topicposts->contains($topicpost)) {
            $this->topicposts->add($topicpost);
            $topicpost->setTopic($this);
        }

        return $this;
    }

    public function removeTopicpost(Topicpost $topicpost): static
    {
        if ($this->topicposts->removeElement($topicpost)) {
            // set the owning side to null (unless already changed)
            if ($topicpost->getTopic() === $this) {
                $topicpost->setTopic(null);
            }
        }

        return $this;
    }
}
