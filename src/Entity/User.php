<?php

namespace App\Entity;

use App\Config\UserStatus;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_subscribed_to_newsletter = null;


    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_url = null;



    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'submitter', orphanRemoval: true)]
    private Collection $games;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column(enumType: UserStatus::class)]
    private ?UserStatus $status = null;

    /**
     * @var Collection<int, Topic>
     */
    #[ORM\OneToMany(targetEntity: Topic::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $topics;



    /**
     * @var Collection<int, Announcement>
     */
    #[ORM\OneToMany(targetEntity: Announcement::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $announcements;

    /**
     * @var Collection<int, Badge>
     */
    #[ORM\ManyToMany(targetEntity: Badge::class, inversedBy: 'users')]
    private Collection $badges;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $reviews;

    /**
     * @var Collection<int, Topicpost>
     */
    #[ORM\OneToMany(targetEntity: Topicpost::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $topicposts;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'uploads', orphanRemoval: true)]
    private Collection $uploads;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\JoinTable(name: 'download')]
    #[ORM\ManyToMany(targetEntity: Game::class, inversedBy: 'downloads')]
    private Collection $downloads;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'favorites')]
    private Collection $favorites;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'wishlists')]
    private Collection $wishlists;




    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->announcements = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->topicposts = new ArrayCollection();
        $this->uploads = new ArrayCollection();
        $this->downloads = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->wishlists = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSubscribedToNewsletter(): ?bool
    {
        return $this->is_subscribed_to_newsletter;
    }

    public function setIsSubscribedToNewsletter(bool $is_subscribed_to_newsletter): static
    {
        $this->is_subscribed_to_newsletter = $is_subscribed_to_newsletter;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->picture_url;
    }

    public function setPictureUrl(string $picture_url): static
    {
        $this->picture_url = $picture_url;

        return $this;
    }



    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setSubmitter($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getSubmitter() === $this) {
                $game->setSubmitter(null);
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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?UserStatus
    {
        return $this->status;
    }

    public function setStatus(UserStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Topic>
     */
    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(Topic $topic): static
    {
        if (!$this->topics->contains($topic)) {
            $this->topics->add($topic);
            $topic->setUser($this);
        }

        return $this;
    }

    public function removeTopic(Topic $topic): static
    {
        if ($this->topics->removeElement($topic)) {
            // set the owning side to null (unless already changed)
            if ($topic->getUser() === $this) {
                $topic->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Announcement>
     */
    public function getAnnouncements(): Collection
    {
        return $this->announcements;
    }

    public function addAnnouncement(Announcement $announcement): static
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements->add($announcement);
            $announcement->setUser($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): static
    {
        if ($this->announcements->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getUser() === $this) {
                $announcement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): static
    {
        if (!$this->badges->contains($badge)) {
            $this->badges->add($badge);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): static
    {
        $this->badges->removeElement($badge);

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
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUser() === $this) {
                $review->setUser(null);
            }
        }

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
            $topicpost->setUser($this);
        }

        return $this;
    }

    public function removeTopicpost(Topicpost $topicpost): static
    {
        if ($this->topicposts->removeElement($topicpost)) {
            // set the owning side to null (unless already changed)
            if ($topicpost->getUser() === $this) {
                $topicpost->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getUploads(): Collection
    {
        return $this->uploads;
    }

    public function addUpload(Game $upload): static
    {
        if (!$this->uploads->contains($upload)) {
            $this->uploads->add($upload);
            $upload->setUploads($this);
        }

        return $this;
    }

    public function removeUpload(Game $upload): static
    {
        if ($this->uploads->removeElement($upload)) {
            // set the owning side to null (unless already changed)
            if ($upload->getUploads() === $this) {
                $upload->setUploads(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getDownloads(): Collection
    {
        return $this->downloads;
    }

    public function addDownload(Game $download): static
    {
        if (!$this->downloads->contains($download)) {
            $this->downloads->add($download);
        }

        return $this;
    }

    public function removeDownload(Game $download): static
    {
        $this->downloads->removeElement($download);

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Game $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->addFavorite($this);
        }

        return $this;
    }

    public function removeFavorite(Game $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            $favorite->removeFavorite($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(Game $wishlist): static
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
            $wishlist->addWishlist($this);
        }

        return $this;
    }

    public function removeWishlist(Game $wishlist): static
    {
        if ($this->wishlists->removeElement($wishlist)) {
            $wishlist->removeWishlist($this);
        }

        return $this;
    }

}
