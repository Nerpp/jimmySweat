<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KeysEncryptionRepository")
 */
class KeysEncryption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $keyUser;

    /**
     * @ORM\Column(type="blob")
     */
    private $ivUser;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\user", inversedBy="keysEncryption", cascade={"persist", "remove"})
     */
    private $userFk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyUser()
    {
        return $this->keyUser;
    }

    public function setKeyUser($keyUser): self
    {
        $this->keyUser = $keyUser;

        return $this;
    }

    public function getIvUser()
    {
        return $this->ivUser;
    }

    public function setIvUser($ivUser): self
    {
        $this->ivUser = $ivUser;

        return $this;
    }

    public function getUserFk(): ?user
    {
        return $this->userFk;
    }

    public function setUserFk(?user $userFk): self
    {
        $this->userFk = $userFk;

        return $this;
    }
}
