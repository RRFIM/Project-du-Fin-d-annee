<?php

namespace App\Entity;

use App\Repository\VersionRepository;
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

    #[ORM\ManyToOne(inversedBy: 'versions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $gameversion): static
    {
        $this->game = $gameversion;

        return $this;
    }
}
