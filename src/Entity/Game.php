<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

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

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $submitter = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'game')]
    private Collection $images;

    /**
     * @var Collection<int, Version>
     */
    #[ORM\OneToMany(targetEntity: Version::class, mappedBy: 'game', orphanRemoval: true)]
    private Collection $versions;

    /**
     * @var Collection<int, Devlog>
     */
    #[ORM\OneToMany(targetEntity: Devlog::class, mappedBy: 'game', orphanRemoval: true)]
    private Collection $devlogs;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'game', orphanRemoval: true)]
    private Collection $comments;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'game', orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'uploads')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $uploads = null;

    /**
     * @var Collection<int, User>
     */
    #[JoinTable(name: 'download')]
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'downloads')]
    private Collection $downloads;

    /**
     * @var Collection<int, User>
     */
    #[JoinTable(name: 'favorite')]
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'favorites')]
    private Collection $favorites;

    /**
     * @var Collection<int, User>
     */
    #[JoinTable(name: 'wishlist')]
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'wishlists')]
    private Collection $wishlists;

    

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->versions = new ArrayCollection();
        $this->devlogs = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->downloads = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
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

    public function getSubmitter(): ?User
    {
        return $this->submitter;
    }

    public function setSubmitter(?User $submitter): static
    {
        $this->submitter = $submitter;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setGame($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getGame() === $this) {
                $image->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Version>
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(Version $version): static
    {
        if (!$this->versions->contains($version)) {
            $this->versions->add($version);
            $version->setGame($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): static
    {
        if ($this->versions->removeElement($version)) {
            // set the owning side to null (unless already changed)
            if ($version->getGame() === $this) {
                $version->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Devlog>
     */
    public function getDevlogs(): Collection
    {
        return $this->devlogs;
    }

    public function addDevlog(Devlog $devlog): static
    {
        if (!$this->devlogs->contains($devlog)) {
            $this->devlogs->add($devlog);
            $devlog->setGame($this);
        }

        return $this;
    }

    public function removeDevlog(Devlog $devlog): static
    {
        if ($this->devlogs->removeElement($devlog)) {
            // set the owning side to null (unless already changed)
            if ($devlog->getGame() === $this) {
                $devlog->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setGame($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getGame() === $this) {
                $comment->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setGame($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getGame() === $this) {
                $review->setGame(null);
            }
        }

        return $this;
    }

    public function getUploads(): ?User
    {
        return $this->uploads;
    }

    public function setUploads(?User $uploads): static
    {
        $this->uploads = $uploads;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getDownloads(): Collection
    {
        return $this->downloads;
    }

    public function addDownload(User $download): static
    {
        if (!$this->downloads->contains($download)) {
            $this->downloads->add($download);
            $download->addDownload($this);
        }

        return $this;
    }

    public function removeDownload(User $download): static
    {
        if ($this->downloads->removeElement($download)) {
            $download->removeDownload($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(User $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
        }

        return $this;
    }

    public function removeFavorite(User $favorite): static
    {
        $this->favorites->removeElement($favorite);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(User $wishlist): static
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
        }

        return $this;
    }

    public function removeWishlist(User $wishlist): static
    {
        $this->wishlists->removeElement($wishlist);

        return $this;
    }
  
}
