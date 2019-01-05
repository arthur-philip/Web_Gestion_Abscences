<?php

/**
 * @author Thibault.kuzmycz
 *
 */
class Salle
{
    private $id_salle;

    private $libelle;
	
	private $desc_salle;
    
    // Constructeur de la classe
    public function __construct($pIdSalle, $pLibelle, $pdesc_salle)
    {
        $this->id_salle = $pIdSalle;
        $this->libelle = $pLibelle;
		$this->desc_salle = $pdesc_salle;
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
	
	/**
     *
     * @return mixed
     */
    public function getDesc_salle()
    {
        return $this->desc_salle;
    }

    /**
     *
     * @param mixed $numero de salle
     */
    public function setDesc_salle($pDesc_salle)
    {
        $this->desc_salle = $pDesc_salle;
    }
}
