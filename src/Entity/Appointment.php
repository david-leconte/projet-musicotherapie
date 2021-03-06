<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CauseType::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $causeType;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $completeCause;

    /**
     * @ORM\ManyToOne(targetEntity=State::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $participants;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCauseType(): ?CauseType
    {
        return $this->causeType;
    }

    public function setCauseType(?CauseType $causeType): self
    {
        $this->causeType = $causeType;

        return $this;
    }

    public function getCompleteCause(): ?string
    {
        return $this->completeCause;
    }

    public function setCompleteCause(string $completeCause): self
    {
        $this->completeCause = $completeCause;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function __toString()
    {
        return $this->date->format('d-m-Y H:i:s').'-'.$this->getUser();
    }

    public function getParticipants(): ?int
    {
        return $this->participants;
    }

    public function setParticipants(?int $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

}
