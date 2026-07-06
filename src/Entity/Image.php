<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $file_type = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'image')]
    private Collection $game_id;

    public function __construct()
    {
        $this->game_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getFileType(): ?string
    {
        return $this->file_type;
    }

    public function setFileType(string $file_type): static
    {
        $this->file_type = $file_type;

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
            $gameId->setImage($this);
        }

        return $this;
    }

    public function removeGameId(Game $gameId): static
    {
        if ($this->game_id->removeElement($gameId)) {
            // set the owning side to null (unless already changed)
            if ($gameId->getImage() === $this) {
                $gameId->setImage(null);
            }
        }

        return $this;
    }
}
