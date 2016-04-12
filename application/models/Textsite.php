<?php



use Doctrine\Mapping as ORM;

/**
 * Textsite
 *
 * @Table(name="textsite")
 * @Entity
 */
class Textsite
{
    /**
     * @var integer $idtextsite
     *
     * @Column(name="idTextSite", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idtextsite;

    /**
     * @var text $titretextsite
     *
     * @Column(name="titreTextSite", type="text", nullable=false)
     */
    private $titretextsite;

    /**
     * @var text $textsite
     *
     * @Column(name="textSite", type="text", nullable=false)
     */
    private $textsite;

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
     * Get idtextsite
     *
     * @return integer 
     */
    public function getIdtextsite()
    {
        return $this->idtextsite;
    }

    /**
     * Set titretextsite
     *
     * @param text $titretextsite
     * @return Textsite
     */
    public function setTitretextsite($titretextsite)
    {
        $this->titretextsite = $titretextsite;
        return $this;
    }

    /**
     * Get titretextsite
     *
     * @return text 
     */
    public function getTitretextsite()
    {
        return $this->titretextsite;
    }

    /**
     * Set textsite
     *
     * @param text $textsite
     * @return Textsite
     */
    public function setTextsite($textsite)
    {
        $this->textsite = $textsite;
        return $this;
    }

    /**
     * Get textsite
     *
     * @return text 
     */
    public function getTextsite()
    {
        return $this->textsite;
    }

    /**
     * Set iduser
     *
     * @param User $iduser
     * @return Textsite
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