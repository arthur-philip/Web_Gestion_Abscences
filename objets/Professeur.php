<?php

/**
 * @author guilhem.mateo
 *
 */
class Professeur extends Personnel
{

    // Constructeur de la classe
    public function __construct($pIdProf)
    {
        $this->setIdPersonnel($pIdProf);
    }
    
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getIdProf()
    {
        return $this->getIdPersonnel();
    }
    
    /**
     *
     * @param mixed $id prof
     */
    public function setIdProf($pIdProf)
    {
        $this->setIdPersonnel($pIdProf);
    }

}

?>