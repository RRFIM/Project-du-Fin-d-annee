<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'comment')]
    private Collection $user_id;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'comment')]
    private Collection $game_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->game_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->setComment($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getComment() === $this) {
                $userId->setComment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGameId(): Collection
    {
        return $this->game_id;
    }

    public function addGameId(Game $gameId): static
    {
        if (!$this->game_id->contains($gameId)) {
            $this->game_id->add($gameId);
            $gameId->setComment($this);
        }

        return $this;
    }

    public function removeGameId(Game $gameId): static
    {
        if ($this->game_id->removeElement($gameId)) {
            // set the owning side to null (unless already changed)
            if ($gameId->getComment() === $this) {
                $gameId->setComment(null);
            }
        }

        return $this;
    }
}
