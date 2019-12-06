<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponseRepository")
 */
class Response
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $message;

    /**
     * @ORM\Column(type="integer")
     */
    private $coach_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $product_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Advice", inversedBy="response")
     */
    private $advice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCoachId(): ?int
    {
        return $this->coach_id;
    }

    public function setCoachId(int $coach_id): self
    {
        $this->coach_id = $coach_id;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(?int $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdvice(): ?Advice
    {
        return $this->advice;
    }

    public function setAdvice(?Advice $advice): self
    {
        $this->advice = $advice;

        return $this;
    }
}
