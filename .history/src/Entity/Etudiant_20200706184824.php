<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Unique
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Regex(
     * pattern     = "/^[a-z]+$/i",
     * htmlPattern = "^[a-zA-Z]+$"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *  pattern     = "/^[a-z]+$/i",
     *  htmlPattern = "^[a-zA-Z]+$"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     * message = " email '{{ value }}' invalide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montant_bourse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^7[0678][0-9]{7}+$/")
     */
    private $telephone;



    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="matricules")
     */
    private $chambre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMontantBourse(): ?int
    {
        return $this->montant_bourse;
    }

    public function setMontantBourse(int $montant_bourse): self
    {
        $this->montant_bourse = $montant_bourse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    //public function getNumChambre(): ?string
    // {
    //     return $this->numChambre;
    // }

    // public function setNumChambre(?string $numChambre): self
    // {
    //     $this->numChambre = $numChambre;

    //     return $this;
    // }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function coupe($nom, $prenom)
    {
        $mot = '';
        $mot1 = $nom[0] . $nom[1];

        $n = strlen($prenom);
        $m = $n - 2;
        $mot2 = $prenom[$m] . $prenom[$n - 1];
        $distict = date("is");
        $matricule = $mot1 . $mot2 . $distict;
        return $matricule;
    }
}