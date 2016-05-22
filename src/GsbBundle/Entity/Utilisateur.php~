<?php

namespace GsbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="Utilisateur")
 * @ORM\Entity(repositoryClass="GsbBundle\Entity\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     *
     * @ORM\OneToOne(targetEntity="GsbBundle\Entity\Visiteur", mappedBy="utilisateur")
     */
    private $visiteur;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="GsbBundle\Entity\Comptable", mappedBy="utilisateur")
     */
    private $comptable;
    
    
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
     * Set login
     *
     * @param string $login
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Utilisateur
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set visiteur
     *
     * @param \GsbBundle\Entity\Visiteur $visiteur
     * @return Utilisateur
     */
    public function setVisiteur(\GsbBundle\Entity\Visiteur $visiteur = null)
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
     * Set comptable
     *
     * @param \GsbBundle\Entity\Comptable $comptable
     * @return Utilisateur
     */
    public function setComptable(\GsbBundle\Entity\Comptable $comptable = null)
    {
        $this->comptable = $comptable;

        return $this;
    }

    /**
     * Get comptable
     *
     * @return \GsbBundle\Entity\Comptable 
     */
    public function getComptable()
    {
        return $this->comptable;
    }
}
