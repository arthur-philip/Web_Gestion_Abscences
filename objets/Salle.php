<?php

/**
 * @author guilhem.mateo
 *
 */
class Salle
{
    private $id_salle;

    private $libelle;
    
    // Constructeur de la classe
    public function __construct($pLibelle, $pIdSalle)
    {
        $this->id_salle = $pIdSalle;
        $this->libelle = $pLibelle;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->id_salle;
    }

    /**
     *
     * @param mixed $pIdSalle
     */
    public function setIdSalle($pIdSalle)
    {
        $this->id_salle = $pIdSalle;
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
