<?php

namespace GsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FraisForfait
 *
 * @ORM\Table(name="FraisForfait")
 * @ORM\Entity(repositoryClass="GsbBundle\Entity\FraisForfaitRepository")
 */
class FraisForfait
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;


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
     * Set libelle
     *
     * @param string $libelle
     * @return FraisForfait
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     * @return FraisForfait
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer 
     */
    public function getMontant()
    {
        return $this->montant;
    }
    
    public function __toString(){
        return $this->libelle ;
    }
}
