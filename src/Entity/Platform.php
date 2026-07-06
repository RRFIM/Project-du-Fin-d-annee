<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, inversedBy: 'platforms')]
    private Collection $game_id;

    public function __construct()
    {
        $this->game_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
        }

        return $this;
    }

    public function removeGameId(Game $gameId): static
    {
        $this->game_id->removeElement($gameId);

        return $this;
    }
}
