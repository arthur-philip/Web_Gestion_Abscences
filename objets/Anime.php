<?php

/**
 * @author Thibault.kuzmycz
 *
 */
class Anime
{
    private $id_cours;

    private $id_personnel;
    
    // Constructeur de la classe
    public function __construct($pId_cours, $pId_personnel)
    {
        $this->id_cours = $pId_cours;
        $this->id_personnel = $pId_personnel;
    }
    
    /* Getter et Setter */

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
     * @param mixed
     */
    public function setIdCours($pIdCours)
    {
        $this->id_cours = $pIdCours;
    }

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
     * @param mixed
     */
    public function setIdPersonnel($pIdPersonnel)
    {
        $this->id_personnel = $pIdPersonnel;
    }
}
