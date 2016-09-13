<?php



use Doctrine\Mapping as ORM;

/**
 * Rubrique
 *
 * @Table(name="promo")
 * @Entity
 */
class Promo
{
    /**
     * @var integer $idpromo
     *
     * @Column(name="idPromo", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idpromo;

    /**
     * @var text $libellePromo
     *
     * @Column(name="libellePromo", type="text", nullable=false)
     */
    private $libellePromo;

    /**
     * @var text $textPromo
     *
     * @Column(name="textPromo", type="text", nullable=false)
     */
    private $textPromo;
    
    /**
     * @var boolean $actif
     *
     * @Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var User
     *
     * @OneToOne(targetEntity="User")
     * @JoinColumns({
     *   @JoinColumn(name="idUser", referencedColumnName="idUser", unique=true)
     * })
     */
    private $iduser;


    /**
     * Get idpromo
     *
     * @return integer 
     */
    public function getIdpromo()
    {
        return $this->idpromo;
    }

    /**
     * Set nompromo
     *
     * @param text $nompromo
     * @return Rubrique
     */
    public function setNompromo($libellePromo)
    {
        $this->libellePromo = $libellePromo;
        return $this;
    }

    /**
     * Get nompromo
     *
     * @return text 
     */
    public function getLibellepromo()
    {
        return $this->libellePromo;
    }

    /**
     * Set textPromo
     *
     * @param text $textPromo
     * @return Promo
     */
    public function setTextpromo($textPromo)
    {
        $this->textPromo = $textPromo;
        return $this;
    }

    /**
     * Get textPromo
     *
     * @return text 
     */
    public function getTextPromo()
    {
        return $this->textPromo;
    }
      
    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Promo
     */
    public function setActif($actif)
    {
    	$this->actif = $actif;
    	return $this;
    }
    
    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
    	return $this->actif;
    }

    /**
     * Set iduser
     *
     * @param User $iduser
     * @return Promo
     */
    public function setIduser(\User $iduser = null)
    {
        $this->iduser = $iduser;
        return $this;
    }

    /**
     * Get iduser
     *
     * @return User 
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}