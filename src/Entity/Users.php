<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Colis", mappedBy="user" )
     */
    private $colis;

    public function __construct()
    {
       $this->colis = new ArrayCollection();
    }

    /** 
    * @return Collection|Colis[]
    */ 
    public function getColis(): Collection
    {
        return $this->colis;
    }

      /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="user" )
     */
    private $trajet;

    public function __construct1()
    {
       $this->trajet = new ArrayCollection();
    }

    /** 
    * @return Collection|Trajet[]
    */ 
    public function getTrajet(): Collection
    {
        return $this->trajet;
    }

   
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Cin;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Sexe;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_De_Naissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Poste;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Numero_De_Telephone;

 
    /**
     * @ORM\Column(name="image",type="string",nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    public $image;
    private $file;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCin(): ?string
    {
        return $this->Cin;
    }

    public function setCin(string $Cin): self
    {
        $this->Cin = $Cin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->Date_De_Naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $Date_De_Naissance): self
    {
        $this->Date_De_Naissance = $Date_De_Naissance;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): self
    {
        $this->Poste = $Poste;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getNumeroDeTelephone(): ?string
    {
        return $this->Numero_De_Telephone;
    }

    public function setNumeroDeTelephone(string $Numero_De_Telephone): self
    {
        $this->Numero_De_Telephone = $Numero_De_Telephone;

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
    public function __toString(){
        // to show the name of the User in the select
        //return $this->name;
        // to show the id of the User in the select
         return (string) $this->id;
    }
}
