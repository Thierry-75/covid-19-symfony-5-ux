<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hospitalisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reanimation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nouvellesHospitalisations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nouvellesReanimations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gueris;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourceType;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getHospitalisation(): ?string
    {
        return $this->hospitalisation;
    }

    public function setHospitalisation(string $hospitalisation): self
    {
        $this->hospitalisation = $hospitalisation;

        return $this;
    }

    public function getReanimation(): ?string
    {
        return $this->reanimation;
    }

    public function setReanimation(string $reanimation): self
    {
        $this->reanimation = $reanimation;

        return $this;
    }

    public function getNouvellesHospitalisations(): ?string
    {
        return $this->nouvellesHospitalisations;
    }

    public function setNouvellesHospitalisations(string $nouvellesHospitalisations): self
    {
        $this->nouvellesHospitalisations = $nouvellesHospitalisations;

        return $this;
    }

    public function getNouvellesReanimations(): ?string
    {
        return $this->nouvellesReanimations;
    }

    public function setNouvellesReanimations(string $nouvellesReanimations): self
    {
        $this->nouvellesReanimations = $nouvellesReanimations;

        return $this;
    }

    public function getDeces(): ?string
    {
        return $this->deces;
    }

    public function setDeces(string $deces): self
    {
        $this->deces = $deces;

        return $this;
    }

    public function getGueris(): ?string
    {
        return $this->gueris;
    }

    public function setGueris(string $gueris): self
    {
        $this->gueris = $gueris;

        return $this;
    }

    public function getSourceType(): ?string
    {
        return $this->sourceType;
    }

    public function setSourceType(string $sourceType): self
    {
        $this->sourceType = $sourceType;

        return $this;
    }
}
