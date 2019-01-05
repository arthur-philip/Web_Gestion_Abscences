<?php

/**
 * @author thibault.kuzmycz
 *
 */
class IcsData
{
    private $titreCours;

    private $numSalle;

    private $descSalle;

    private $prof;

    private $promo;
	
	private $dateTimeD;

    private $dateTimeF;
	
	// Constructeur de la classe
    public function __construct($ptitreCours, $pnumSalle, $pdescSalle, $pprof, $ppromo, $pdateTimeD, $pdateTimeF)
    {
        $this->titreCours = $ptitreCours;
        $this->numSalle = $pnumSalle;
        $this->descSalle = $pdescSalle;
        $this->prof = $pprof;
        $this->promo = $ppromo;
		$this->dateTimeD = $pdateTimeD;
        $this->dateTimeF = $pdateTimeF;
    }	
	  
    /* Getter et Setter */

    /**
     *
     * @return mixed
     */
    public function getTitreCours()
    {
        return $this->titreCours;
    }
	
	 /**
     *
     * @param mixed
     */
    public function setTitreCours($pTitreCours)
    {
        $this->titreCours = $pTitreCours;
    }

    /**
     *
     * @return mixed
     */
    public function getDescSalle()
    {
        return $this->descSalle;
    }
	
	/**
     *
     * @param mixed
     */
    public function setDescSalle($pDescSalle)
    {
        $this->descSalle = $pDescSalle;
    }
	
	/**
     *
     * @return mixed
     */
    public function getNumSalle()
    {
        return $this->numSalle;
    }

	/**
     *
     * @param mixed
     */
    public function setNumSalle($pNumSalle)
    {
        $this->numSalle = $pNumSalle;
    }
	
    /**
     *
     * @return mixed
     */
    public function getProf()
    {
        return $this->prof;
    }
	
	/**
     *
     * @param mixed
     */
    public function setProf($pProf)
    {
        $this->prof = $pProf;
    }
	
	/**
     *
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }
	
	/**
     *
     * @param mixed
     */
    public function setPromo($pPromo)
    {
        $this->promo = $pPromo;
    }
	
	/**
     *
     * @return mixed
     */
    public function getDateTimeD()
    {
        return $this->dateTimeD;
    }
	
	/**
     *
     * @param mixed
     */
    public function setDateTimeD($pDateTimeD)
    {
        $this->dateTimeD = $pDateTimeD;
    }
	
	/**
     *
     * @return mixed
     */
    public function getDateTimeF()
    {
        return $this->dateTimeF;
    }
	
	/**
     *
     * @param mixed
     */
    public function setDateTimeF($pDateTimeF)
    {
        $this->dateTimeF = $pDateTimeF;
    }
}