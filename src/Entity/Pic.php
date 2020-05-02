<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PicRepository")
 */
class Pic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="boolean")
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="pics")
     */
    private $fkUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\tricks", inversedBy="pics")
     */
    private $fkTricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getProfile(): ?bool
    {
        return $this->profile;
    }

    public function setProfile(bool $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getFkUser(): ?user
    {
        return $this->fkUser;
    }

    public function setFkUser(?user $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    public function getFkTricks(): ?tricks
    {
        return $this->fkTricks;
    }

    public function setFkTricks(?tricks $fkTricks): self
    {
        $this->fkTricks = $fkTricks;

        return $this;
    }
}
