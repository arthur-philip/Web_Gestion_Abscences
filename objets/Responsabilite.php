<?php

/**
 * @author arthur.philip
 *
 */
class Responsabilite
{
    private $id_responsabilite;

    private $libelle;
    
    // Constructeur de la classe
    public function __construct($pIdResponsabilite, $pLibelle)
    {
        $this->id_responsabilite = $pIdResponsabilite;
        $this->libelle = $pLibelle;
    }
    
    /* Getter et Setter */

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
     * @param mixed $pIdResponsabilite
     */
    public function setIdSalle($pIdResponsabilite)
    {
        $this->id_responsabilite = $pIdResponsabilite;
    }

    /**
     *
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     *
     * @param mixed $numero de salle
     */
    public function setLibelle($pLibelle)
    {
        $this->libelle = $pLibelle;
    }
}
