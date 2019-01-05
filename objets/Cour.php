<?php

/**
 * @author arthur.philip
 *
 */
class Cours
{
    private $id_cours;

    private $id_matiere;

    private $id_salle;

    private $horaire_debut;

    private $horaire_fin;
    
    // Constructeur de la classe
    public function __construct($pIdCours, $pIdMatiere, $pIdSalle, $pHoraireDebut, $pHoraireFin)
    {
        $this->id_cours = $pIdCours;
        $this->id_matiere = $pIdMatiere;
        $this->id_salle = $pIdSalle;
        $this->horaire_debut = $pHoraireDebut;
        $this->horaire_fin = $pHoraireFin;
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
     * @return mixed
     */
    public function getIdMatiere()
    {
        return $this->id_matiere;
    }

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
     * @return mixed
     */
    public function getHoraireDebut()
    {
        return $this->horaire_debut;
    }

    /**
     *
     * @return mixed
     */
    public function getHoraireFin()
    {
        return $this->horaire_fin;
    }

    /**
     *
     * @param mixed $pIdCours
     */
    public function setIdCours($pIdCours)
    {
        $this->id_cours = $pIdCours;
    }

    /**
     *
     * @param mixed $pIdMatiere
     */
    public function setIdMatiere($pIdMatiere)
    {
        $this->id_matiere = $pIdMatiere;
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
     * @param mixed $pHoraireDebut
     */
    public function setHoraireDebut($pHoraireDebut)
    {
        $this->horaire_debut = $pHoraireDebut;
    }

    /**
     *
     * @param mixed $pHoraireFin
     */
    public function setHoraireFin($pHoraireFin)
    {
        $this->horaire_fin = $pHoraireFin;
    }
}
