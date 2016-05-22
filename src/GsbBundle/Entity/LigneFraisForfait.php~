<?php

namespace GsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisForfait
 *
 * @ORM\Table(name="LigneFraisForfait")
 * @ORM\Entity(repositoryClass="GsbBundle\Entity\LigneFraisForfaitRepository")
 */
class LigneFraisForfait
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
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="GsbBundle\Entity\FraisForfait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fraisForfait;
    
    /**
     * @ORM\ManyToOne(targetEntity="GsbBundle\Entity\FicheFrais", inversedBy="lignefraisForfait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ficheFrais ;
    
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
     * Set quantite
     *
     * @param integer $quantite
     * @return LigneFraisForfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set fraisForfait
     *
     * @param \GsbBundle\Entity\FraisForfait $fraisForfait
     * @return LigneFraisForfait
     */
    public function setFraisForfait(\GsbBundle\Entity\FraisForfait $fraisForfait)
    {
        $this->fraisForfait = $fraisForfait;

        return $this;
    }

    /**
     * Get fraisForfait
     *
     * @return \GsbBundle\Entity\FraisForfait 
     */
    public function getFraisForfait()
    {
        return $this->fraisForfait;
    }

    /**
     * Set ficheFrais
     *
     * @param \GsbBundle\Entity\FicheFrais $ficheFrais
     * @return LigneFraisForfait
     */
    public function setFicheFrais(\GsbBundle\Entity\FicheFrais $ficheFrais)
    {
        $this->ficheFrais = $ficheFrais;

        return $this;
    }

    /**
     * Get ficheFrais
     *
     * @return \GsbBundle\Entity\FicheFrais 
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }
}
