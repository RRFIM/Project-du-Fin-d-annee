<?php

namespace App\Entity;

use App\Repository\VersionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersionRepository::class)]
class Version
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $source_path = null;

    #[ORM\Column]
    private ?int $version_number = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'version')]
    private Collection $game_id;

    public function __construct()
    {
        $this->game_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourcePath(): ?string
    {
        return $this->source_path;
    }

    public function setSourcePath(string $source_path): static
    {
        $this->source_path = $source_path;

        return $this;
    }

    public function getVersionNumber(): ?int
    {
        return $this->version_number;
    }

    public function setVersionNumber(int $version_number): static
    {
        $this->version_number = $version_number;

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
            $gameId->setVersion($this);
        }

        return $this;
    }

    public function removeGameId(Game $gameId): static
    {
        if ($this->game_id->removeElement($gameId)) {
            // set the owning side to null (unless already changed)
            if ($gameId->getVersion() === $this) {
                $gameId->setVersion(null);
            }
        }

        return $this;
    }
}
