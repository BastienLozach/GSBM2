<?php

namespace GsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FicheFrais
 *
 * @ORM\Table(name="FicheFrais")
 * @ORM\Entity(repositoryClass="GsbBundle\Entity\FicheFraisRepository")
 */
class FicheFrais
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
     * @var integer
     *
     * @ORM\Column(name="mois", type="integer")
     */
    private $mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbJustificatif", type="integer")
     */
    private $nbJustificatif;

    /**
     * @var string
     *
     * @ORM\Column(name="MontantValide", type="decimal")
     */
    private $montantValide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="date")
     */
    private $dateModif;

    /**
     * @ORM\OneToMany(targetEntity="GsbBundle\Entity\LigneFraisHorsForfait", mappedBy="ficheFrais")
     *  
     */
    private $ligneFraisHorsForfait;
    
    /**
     * @ORM\ManyToOne(targetEntity="GsbBundle\Entity\Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;
    
    /**
     * @ORM\ManyToOne(targetEntity="GsbBundle\Entity\Visiteur", inversedBy="FicheFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteur;
    
    
    /**
     * @ORM\OneToMany(targetEntity="GsbBundle\Entity\LigneFraisForfait", mappedBy="ficheFrais")
     */
    private $ligneFraisForfait;
    
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
     * Set mois
     *
     * @param integer $mois
     * @return FicheFrais
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return integer 
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     * @return FicheFrais
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set nbJustificatif
     *
     * @param integer $nbJustificatif
     * @return FicheFrais
     */
    public function setNbJustificatif($nbJustificatif)
    {
        $this->nbJustificatif = $nbJustificatif;

        return $this;
    }

    /**
     * Get nbJustificatif
     *
     * @return integer 
     */
    public function getNbJustificatif()
    {
        return $this->nbJustificatif;
    }

    /**
     * Set montantValide
     *
     * @param string $montantValide
     * @return FicheFrais
     */
    public function setMontantValide($montantValide)
    {
        $this->montantValide = $montantValide;

        return $this;
    }

    /**
     * Get montantValide
     *
     * @return string 
     */
    public function getMontantValide()
    {
        return $this->montantValide;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     * @return FicheFrais
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime 
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneFraisHorsForfait = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ligneFraisForfait = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ligneFraisHorsForfait
     *
     * @param \GsbBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     * @return FicheFrais
     */
    public function addLigneFraisHorsForfait(\GsbBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait)
    {
        $this->ligneFraisHorsForfait[] = $ligneFraisHorsForfait;

        return $this;
    }

    /**
     * Remove ligneFraisHorsForfait
     *
     * @param \GsbBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     */
    public function removeLigneFraisHorsForfait(\GsbBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait)
    {
        $this->ligneFraisHorsForfait->removeElement($ligneFraisHorsForfait);
    }

    /**
     * Get ligneFraisHorsForfait
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLigneFraisHorsForfait()
    {
        return $this->ligneFraisHorsForfait;
    }

    /**
     * Set etat
     *
     * @param \GsbBundle\Entity\Etat $etat
     * @return FicheFrais
     */
    public function setEtat(\GsbBundle\Entity\Etat $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \GsbBundle\Entity\Etat 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set visiteur
     *
     * @param \GsbBundle\Entity\Visiteur $visiteur
     * @return FicheFrais
     */
    public function setVisiteur(\GsbBundle\Entity\Visiteur $visiteur)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * Get visiteur
     *
     * @return \GsbBundle\Entity\Visiteur 
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }

    /**
     * Add ligneFraisForfait
     *
     * @param \GsbBundle\Entity\LigneFraisForfait $ligneFraisForfait
     * @return FicheFrais
     */
    public function addLigneFraisForfait(\GsbBundle\Entity\LigneFraisForfait $ligneFraisForfait)
    {
        $this->ligneFraisForfait[] = $ligneFraisForfait;

        return $this;
    }

    /**
     * Remove ligneFraisForfait
     *
     * @param \GsbBundle\Entity\LigneFraisForfait $ligneFraisForfait
     */
    public function removeLigneFraisForfait(\GsbBundle\Entity\LigneFraisForfait $ligneFraisForfait)
    {
        $this->ligneFraisForfait->removeElement($ligneFraisForfait);
    }

    /**
     * Get ligneFraisForfait
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLigneFraisForfait()
    {
        return $this->ligneFraisForfait;
    }
}
