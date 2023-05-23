<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cases;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $todayCases;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $todayDeaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recovered;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $critical;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $casesPerOneMillion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deathsPerOneMillion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalTests;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $testsPerOneMillion;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCases(): ?int
    {
        return $this->cases;
    }

    public function setCases(?int $cases): self
    {
        $this->cases = $cases;

        return $this;
    }

    public function getTodayCases(): ?int
    {
        return $this->todayCases;
    }

    public function setTodayCases(?int $todayCases): self
    {
        $this->todayCases = $todayCases;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(?int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getTodayDeaths(): ?int
    {
        return $this->todayDeaths;
    }

    public function setTodayDeaths(?int $todayDeaths): self
    {
        $this->todayDeaths = $todayDeaths;

        return $this;
    }

    public function getRecovered(): ?int
    {
        return $this->recovered;
    }

    public function setRecovered(?int $recovered): self
    {
        $this->recovered = $recovered;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCritical(): ?int
    {
        return $this->critical;
    }

    public function setCritical(?int $critical): self
    {
        $this->critical = $critical;

        return $this;
    }

    public function getCasesPerOneMillion(): ?int
    {
        return $this->casesPerOneMillion;
    }

    public function setCasesPerOneMillion(?int $casesPerOneMillion): self
    {
        $this->casesPerOneMillion = $casesPerOneMillion;

        return $this;
    }

    public function getDeathsPerOneMillion(): ?int
    {
        return $this->deathsPerOneMillion;
    }

    public function setDeathsPerOneMillion(?int $deathsPerOneMillion): self
    {
        $this->deathsPerOneMillion = $deathsPerOneMillion;

        return $this;
    }

    public function getTotalTests(): ?int
    {
        return $this->totalTests;
    }

    public function setTotalTests(?int $totalTests): self
    {
        $this->totalTests = $totalTests;

        return $this;
    }

    public function getTestsPerOneMillion(): ?int
    {
        return $this->testsPerOneMillion;
    }

    public function setTestsPerOneMillion(?int $testsPerOneMillion): self
    {
        $this->testsPerOneMillion = $testsPerOneMillion;

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
