<?php

/**
 * @author guilhem.mateo
 *
 */
class Absence
{
    private $id_absence;

    private $ine;

    private $id_cours;
    
    // Constructeur de la classe
    public function __construct($pid_absence, $pine, $pid_cours)
    {
        $this->ine = $pine;
        $this->id_absence = $pid_absence;
        $this->id_cours = $pid_cours;
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdAbsence()
    {
        return $this->id_absence;
    }

    /**
     *
     * @param mixed $id_absence
     */
    public function setIdAbsence($id_absence)
    {
        $this->id_absence = $id_absence;
    }
    
    /**
     *
     * @return mixed
     */
    public function getINE()
    {
        return $this->ine;
    }
 
    /**
     *
     * @param mixed $ine
     */
    public function setINE($ine)
    {
        $this->ine = $ine;
    }

    /**
     *
     * @return mixed
     */
    public function getIdCours()
    {
        return $this->id_cours;
    }
    
    /**
     *
     * @param mixed $id_cours
     */
    public function setIdCours($id_cours)
    {
        $this->id_cours = $id_cours;
    }
}
