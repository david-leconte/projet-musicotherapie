<?php

namespace App\Entity;

use App\Repository\CauseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CauseTypeRepository::class)
 */
class CauseType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameType;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="causeType")
     */
    private $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameType(): ?string
    {
        return $this->nameType;
    }

    public function setNameType(string $nameType): self
    {
        $this->nameType = $nameType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setCauseType($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getCauseType() === $this) {
                $appointment->setCauseType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nameType;
    }
}
