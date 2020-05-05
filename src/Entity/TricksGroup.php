<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksGroupRepository")
 */
class TricksGroup
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tricks", mappedBy="fkTricksGroup")
     */
    private $fkTricks;

    /**
     * @return mixed
     */
    public function getFkTricks()
    {
        return $this->fkTricks;
    }

    /**
     * @param mixed $fkTricks
     */
    public function setFkTricks($fkTricks): void
    {
        $this->fkTricks = $fkTricks;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
