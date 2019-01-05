<?php

/**
 * @author thibault.kuzmycz
 *
 */
class Groupe_etudiant
{
    private $id_groupe;

    private $ine_etudiant;

    // Constructeur de la classe
    public function __construct($pid_groupe, $pine_etudiant)
    {
        $this->id_groupe = $pid_groupe;
        $this->ine_etudiant = $pine_etudiant;
    }
    
    /* Getter et Setter */

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
     * @param mixed id_departement
     */
    public function setIdGroupe($pid_groupe)
    {
        $this->id_groupe = $pid_groupe;
    }

    /**
     *
     * @return mixed
     */
    public function getIneEtudiant()
    {
        return $this->ine_etudiant;
    }
 
    /**
     *
     * @param mixed $id filiere
     */
    public function setIneEtudiant($pine_etudiant)
    {
        $this->ine_etudiant = $pine_etudiant;
    }
}