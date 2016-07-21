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
     * @Column(name="idRubrique", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idpromo;

    /**
     * @var text $nompromo
     *
     * @Column(name="nomRubrique", type="text", nullable=false)
     */
    private $nompromo;

    /**
     * @var text $descriptionpromo
     *
     * @Column(name="descriptionRubrique", type="text", nullable=false)
     */
    private $descriptionpromo;

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
    public function setNompromo($nompromo)
    {
        $this->nompromo = $nompromo;
        return $this;
    }

    /**
     * Get nompromo
     *
     * @return text 
     */
    public function getNompromo()
    {
        return $this->nompromo;
    }

    /**
     * Set descriptionpromo
     *
     * @param text $descriptionpromo
     * @return Rubrique
     */
    public function setTextepromo($descriptionpromo)
    {
        $this->descriptionpromo = $descriptionpromo;
        return $this;
    }

    /**
     * Get textepromo
     *
     * @return text 
     */
    public function getTextepromo()
    {
        return $this->Textepromo;
    }

    /**
     * Set iduser
     *
     * @param User $iduser
     * @return Rubrique
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