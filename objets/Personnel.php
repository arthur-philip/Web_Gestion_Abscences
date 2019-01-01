<?php

/**
 * @author guilhem.mateo
 *
 */
class Personnel
{
    private $id_personnel;

    private $login;

    private $mdp;

    private $nom;

    private $prenom;

    private $id_responsabilite;
    
    // Constructeur de la classe
    public function __construct($pIdPersonnel, $pLogin, $pMdp, $pNom, $pPrenom, $pIdResponsabilite)
    {
        $this->id_personnel = $pIdPersonnel;
        $this->login = $pLogin;
        $this->mdp = $pMdp;
        $this->nom = $pNom;
        $this->prenom = $pPrenom;
        $this->id_responsabilite = $pIdResponsabilite;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdPersonnel()
    {
        return $this->id_personnel;
    }

    /**
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     *
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     *
     * @return mixed
     */
    public function getIdResponsabilite()
    {
        return $this->id_responsabilite;
    }
    
    /**
     *
     * @param mixed $id personnel
     */
    public function setIdPersonnel($pIdPersonnel)
    {
        $this->id_personnel = $pIdPersonnel;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setNom($pNom)
    {
        $this->nom = $pNom;
    }

    /**
     *
     * @param mixed $prenom
     */
    public function setPrenom($pPrenom)
    {
        $this->prenom = $pPrenom;
    }

    /**
     *
     * @param mixed $mdp
     */
    public function setMdp($pMdp)
    {
        $this->mdp = $pMdp;
    }

    /**
     *
     * @param mixed $pLogin
     */
    public function setLogin($pLogin)
    {
        $this->login = $pLogin;
    }

    /**
     *
     * @param mixed $pIdResponsabilite
     */
    public function setIdResponsabilite($pIdResponsabilite)
    {
        $this->id_responsabilite = $pIdResponsabilite;
    }
}
