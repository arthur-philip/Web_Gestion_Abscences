<?php

/**
 * @author Thibault.kuzmycz
 *
 */
class CoursGroupe
{
    private $id_cours;

    private $id_groupe;
    
    // Constructeur de la classe
    public function __construct($pId_cours, $pId_groupe)
    {
        $this->id_cours = $pId_cours;
        $this->id_groupe = $pId_groupe;
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
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }

    /**
     *
     * @param mixed
     */
    public function setIdGroupe($pId_groupe)
    {
        $this->id_groupe = $pId_groupe;
    }
}
