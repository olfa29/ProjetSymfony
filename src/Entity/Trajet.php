<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
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
    private $Point_De_Depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Point_D_Arriver;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Heure_De_Depart;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $heure_D_Arriver;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_De_Depart;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_D_Arriver;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users" ,inversedBy="trajet", cascade={"persist"})   
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

  

    public function getUser(): ?Users
    {
        return  $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user= $user;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointDeDepart(): ?string
    {
        return $this->Point_De_Depart;
    }

    public function setPointDeDepart(string $Point_De_Depart): self
    {
        $this->Point_De_Depart = $Point_De_Depart;

        return $this;
    }

    public function getPointDArriver(): ?string
    {
        return $this->Point_D_Arriver;
    }

    public function setPointDArriver(string $Point_D_Arriver): self
    {
        $this->Point_D_Arriver = $Point_D_Arriver;

        return $this;
    }

    public function getHeureDeDepart(): ?string
    {
        return $this->Heure_De_Depart;
    }

    public function setHeureDeDepart(string $Heure_De_Depart): self
    {
        $this->Heure_De_Depart = $Heure_De_Depart;

        return $this;
    }

    public function getHeureDArriver(): ?string
    {
        return $this->heure_D_Arriver;
    }

    public function setHeureDArriver(string $heure_D_Arriver): self
    {
        $this->heure_D_Arriver = $heure_D_Arriver;

        return $this;
    }

    public function getDateDeDepart(): ?\DateTimeInterface
    {
        return $this->Date_De_Depart;
    }

    public function setDateDeDepart(\DateTimeInterface $Date_De_Depart): self
    {
        $this->Date_De_Depart = $Date_De_Depart;

        return $this;
    }

    public function getDateDArriver(): ?\DateTimeInterface
    {
        return $this->Date_D_Arriver;
    }

    public function setDateDArriver(\DateTimeInterface $Date_D_Arriver): self
    {
        $this->Date_D_Arriver = $Date_D_Arriver;

        return $this;
    }
}
