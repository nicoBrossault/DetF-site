<?php

use Doctrine\Mapping as ORM;

/**
 * Marquesrubrique
 *
 * @Table(name="marquesrubrique")
 * @Entity
 */
class Marquesrubrique
{	
	/**
	 * @var integer $idMarquesRubrique
	 *
	 * @Column(name="idMarquesRubrique", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	private $idMarquesRubrique;
	
	/**
     * @var Rubrique
     *
     * @OneToOne(targetEntity="Rubrique")
     * @JoinColumns({
     *   @JoinColumn(name="idRubrique", referencedColumnName="idRubrique", unique=true)
     * })
     */
    private $idrubrique;
    
    /**
     * @var Marque
     *
     * @OneToOne(targetEntity="Marque")
     * @JoinColumns({
     *   @JoinColumn(name="idMarque", referencedColumnName="idMarque", unique=true)
     * })
     */
    private $idmarque;
    
    /**
     * Get idMarquesRubrique
     *
     * @return integer
     */
    public function getIdMarquesrubrique()
    {
    	return $this->idMarquesRubrique;
    }
    
    /**
     * Set idrubrique
     *
     * @param Rubrique $idrubrique
     * @return Articlerubrique
     */
    public function setIdrubrique(\Rubrique $idrubrique = null)
    {
    	$this->idrubrique = $idrubrique;
    	return $this;
    }
    
    /**
     * Get idrubrique
     *
     * @return Rubrique
     */
    public function getIdrubrique()
    {
    	return $this->idrubrique;
    }
    
    /**
     * Set idmarque
     *
     * @param Rubrique $idmarque
     * @return Marque
     */
    public function setIdmarque(\Marque $idmarque = null)
    {
    	$this->idmarque = $idmarque;
    	return $this;
    }
    
    /**
     * Get idmarque
     *
     * @return Marque
     */
    public function getIdmarque()
    {
    	return $this->idmarque;
    }
}