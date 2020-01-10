<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 */
class Level
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beginer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $medium;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $experienced;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="level", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginer(): ?string
    {
        return $this->beginer;
    }

    public function setBeginer(?string $beginer): self
    {
        $this->beginer = $beginer;

        return $this;
    }

    public function getMedium(): ?string
    {
        return $this->medium;
    }

    public function setMedium(?string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function getExperienced(): ?string
    {
        return $this->experienced;
    }

    public function setExperienced(?string $experienced): self
    {
        $this->experienced = $experienced;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newLevel = null === $user ? null : $this;
        if ($user && $user->getLevel() !== $newLevel) {
            $user->setLevel($newLevel);
        }

        return $this;
    }
}
