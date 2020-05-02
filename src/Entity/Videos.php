<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideosRepository")
 */
class Videos
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
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="videos")
     */
    private $userFK;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\tricks", inversedBy="videos")
     */
    private $fkTricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUserFK(): ?user
    {
        return $this->userFK;
    }

    public function setUserFK(?user $userFK): self
    {
        $this->userFK = $userFK;

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
