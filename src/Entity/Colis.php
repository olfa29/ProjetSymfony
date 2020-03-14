<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColisRepository")
 */
class Colis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Point_De_Depart;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Point_D_Arriver;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_De_Depart;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_D_Arriver;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Size;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Categorie;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Prix;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users" ,inversedBy="colis", cascade={"persist"})   
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

    public function getSize(): ?string
    {
        return $this->Size;
    }

    public function setSize(string $Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }



   /**
    * @ORM\Column(name="path",type="string",nullable=true)
    * @Assert\File(mimeTypes={ "image/jpeg" })
    */
   public $path;
 

   /**
    * @ORM\Column(type="string", length=50)
    */
   private $Type;
   /** 

     * @ORM\Column(name="image",type="string",nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    public $image;
    private $file;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Heure_D_Arriver;
  




 
   public function setPath($path)
   {
       $this->path = $path;

       return $this;
   }

   public function getPath()
   {
       return $this->path;
   }

   public function getType(): ?string
   {
       return $this->Type;
   }

   public function setType(string $Type): self
   {
       $this->Type = $Type;

       return $this;
   }

  
   public function getImage()
   {
       return $this->image;
   }

   public function setImage( $image)
   {
       $this->image = $image;

      
       return $this;
   }

   public function getFile()
   {
       return $this->file;
   }

   public function setFile($file)
   {
       $this->file = $file;

       return $this;
   }

   public function getHeureDArriver(): ?string
   {
       return $this->Heure_D_Arriver;
   }

   public function setHeureDArriver(string $Heure_D_Arriver): self
   {
       $this->Heure_D_Arriver = $Heure_D_Arriver;

       return $this;
   }

  
   


  



   


}



