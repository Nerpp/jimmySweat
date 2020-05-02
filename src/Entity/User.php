<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Videos", mappedBy="userFK")
     */
    private $videos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\KeysEncryption", mappedBy="userFk", cascade={"persist", "remove"})
     */
    private $keysEncryption;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pic", mappedBy="fkUser")
     */
    private $pics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="fkUser")
     */
    private $comments;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
        $this->pics = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Videos[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Videos $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setUserFK($this);
        }

        return $this;
    }

    public function removeVideo(Videos $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getUserFK() === $this) {
                $video->setUserFK(null);
            }
        }

        return $this;
    }

    public function getKeysEncryption(): ?KeysEncryption
    {
        return $this->keysEncryption;
    }

    public function setKeysEncryption(?KeysEncryption $keysEncryption): self
    {
        $this->keysEncryption = $keysEncryption;

        // set (or unset) the owning side of the relation if necessary
        $newUserFk = null === $keysEncryption ? null : $this;
        if ($keysEncryption->getUserFk() !== $newUserFk) {
            $keysEncryption->setUserFk($newUserFk);
        }

        return $this;
    }

    /**
     * @return Collection|Pic[]
     */
    public function getPics(): Collection
    {
        return $this->pics;
    }

    public function addPic(Pic $pic): self
    {
        if (!$this->pics->contains($pic)) {
            $this->pics[] = $pic;
            $pic->setFkUser($this);
        }

        return $this;
    }

    public function removePic(Pic $pic): self
    {
        if ($this->pics->contains($pic)) {
            $this->pics->removeElement($pic);
            // set the owning side to null (unless already changed)
            if ($pic->getFkUser() === $this) {
                $pic->setFkUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFkUser($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getFkUser() === $this) {
                $comment->setFkUser(null);
            }
        }

        return $this;
    }
}
