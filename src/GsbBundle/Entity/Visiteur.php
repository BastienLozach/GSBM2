<?php

namespace GsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visiteur
 *
 * @ORM\Table("Visiteur")
 * @ORM\Entity(repositoryClass="GsbBundle\Entity\VisiteurRepository")
 */
class Visiteur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="GsbBundle\Entity\FicheFrais", mappedBy="visiteur")
     */
    private $ficheFrais ;
    
    /**
     * @ORM\OneToOne(targetEntity="GsbBundle\Entity\Utilisateur", inversedBy="visiteur")
     */
    private $utilisateur;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Visiteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Visiteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ficheFrais = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ficheFrais
     *
     * @param \GsbBundle\Entity\FicheFrais $ficheFrais
     * @return Visiteur
     */
    public function addFicheFrai(\GsbBundle\Entity\FicheFrais $ficheFrais)
    {
        $this->ficheFrais[] = $ficheFrais;

        return $this;
    }

    /**
     * Remove ficheFrais
     *
     * @param \GsbBundle\Entity\FicheFrais $ficheFrais
     */
    public function removeFicheFrai(\GsbBundle\Entity\FicheFrais $ficheFrais)
    {
        $this->ficheFrais->removeElement($ficheFrais);
    }

    /**
     * Get ficheFrais
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }

    /**
     * Set utilisateur
     *
     * @param \GsbBundle\Entity\Utilisateur $utilisateur
     * @return Visiteur
     */
    public function setUtilisateur(\GsbBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \GsbBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
