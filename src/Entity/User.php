<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'email que vous avez indiqué est deja utilisé"
 * )
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
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sportId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Level", inversedBy="user", cascade={"persist", "remove"})
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Advice", mappedBy="user")
     */
    private $advice;

    /**
     * @ORM\Column(type="string", length=90)
     * @Assert\Length(max="25")
     */
    private $username;

    public function __construct()
    {
        $this->advice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSportId(): ?int
    {
        return $this->sportId;
    }

    public function setSportId(?int $sportId): self
    {
        $this->sportId = $sportId;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Advice[]
     */
    public function getAdvice(): Collection
    {
        return $this->advice;
    }

    public function addAdvice(Advice $advice): self
    {
        if (!$this->advice->contains($advice)) {
            $this->advice[] = $advice;
            $advice->setUser($this);
        }

        return $this;
    }

    public function removeAdvice(Advice $advice): self
    {
        if ($this->advice->contains($advice)) {
            $this->advice->removeElement($advice);
            // set the owning side to null (unless already changed)
            if ($advice->getUser() === $this) {
                $advice->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
