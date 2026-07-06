<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_description = null;

    #[ORM\Column]
    private ?int $download_rate = null;

    #[ORM\Column]
    private ?bool $is_approved = null;

    #[ORM\Column(length: 255)]
    private ?string $online_game_url = null;

    #[ORM\Column(length: 255)]
    private ?string $source_code_url = null;

    #[ORM\Column(length: 255)]
    private ?string $browser_version = null;

    #[ORM\Column(length: 255)]
    private ?string $requirements = null;

    #[ORM\Column]
    private ?int $nb_player_max = null;

    
    #[ORM\ManyToOne(inversedBy: 'game_id')]
    private ?Comment $comment = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'game')]
    private Collection $uploader_id;

    #[ORM\ManyToOne(inversedBy: 'game_id')]
    private ?Image $image = null;

    /**
     * @var Collection<int, Platform>
     */
    #[ORM\ManyToMany(targetEntity: Platform::class, mappedBy: 'game_id')]
    private Collection $platforms;

    #[ORM\ManyToOne(inversedBy: 'game_id')]
    private ?Devlog $devlog = null;

    #[ORM\ManyToOne(inversedBy: 'game_id')]
    private ?Version $version = null;

    public function __construct()
    {
        $this->uploader_id = new ArrayCollection();
        $this->platforms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): static
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getDownloadRate(): ?int
    {
        return $this->download_rate;
    }

    public function setDownloadRate(int $download_rate): static
    {
        $this->download_rate = $download_rate;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): static
    {
        $this->is_approved = $is_approved;

        return $this;
    }

    public function getOnlineGameUrl(): ?string
    {
        return $this->online_game_url;
    }

    public function setOnlineGameUrl(string $online_game_url): static
    {
        $this->online_game_url = $online_game_url;

        return $this;
    }

    public function getSourceCodeUrl(): ?string
    {
        return $this->source_code_url;
    }

    public function setSourceCodeUrl(string $source_code_url): static
    {
        $this->source_code_url = $source_code_url;

        return $this;
    }

    public function getBrowserVersion(): ?string
    {
        return $this->browser_version;
    }

    public function setBrowserVersion(string $browser_version): static
    {
        $this->browser_version = $browser_version;

        return $this;
    }

    public function getRequirements(): ?string
    {
        return $this->requirements;
    }

    public function setRequirements(string $requirements): static
    {
        $this->requirements = $requirements;

        return $this;
    }

    public function getNbPlayerMax(): ?int
    {
        return $this->nb_player_max;
    }

    public function setNbPlayerMax(int $nb_player_max): static
    {
        $this->nb_player_max = $nb_player_max;

        return $this;
    }

    

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(?Comment $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUploaderId(): Collection
    {
        return $this->uploader_id;
    }

    public function addUploaderId(User $uploaderId): static
    {
        if (!$this->uploader_id->contains($uploaderId)) {
            $this->uploader_id->add($uploaderId);
            $uploaderId->setGame($this);
        }

        return $this;
    }

    public function removeUploaderId(User $uploaderId): static
    {
        if ($this->uploader_id->removeElement($uploaderId)) {
            // set the owning side to null (unless already changed)
            if ($uploaderId->getGame() === $this) {
                $uploaderId->setGame(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Platform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(Platform $platform): static
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
            $platform->addGameId($this);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): static
    {
        if ($this->platforms->removeElement($platform)) {
            $platform->removeGameId($this);
        }

        return $this;
    }

    public function getDevlog(): ?Devlog
    {
        return $this->devlog;
    }

    public function setDevlog(?Devlog $devlog): static
    {
        $this->devlog = $devlog;

        return $this;
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(?Version $version): static
    {
        $this->version = $version;

        return $this;
    }
}
