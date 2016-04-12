<?php



use Doctrine\Mapping as ORM;

/**
 * Rubrique
 *
 * @Table(name="rubrique")
 * @Entity
 */
class Rubrique
{
    /**
     * @var integer $idrubrique
     *
     * @Column(name="idRubrique", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idrubrique;

    /**
     * @var text $nomrubrique
     *
     * @Column(name="nomRubrique", type="text", nullable=false)
     */
    private $nomrubrique;

    /**
     * @var text $descriptionrubrique
     *
     * @Column(name="descriptionRubrique", type="text", nullable=false)
     */
    private $descriptionrubrique;

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
     * Get idrubrique
     *
     * @return integer 
     */
    public function getIdrubrique()
    {
        return $this->idrubrique;
    }

    /**
     * Set nomrubrique
     *
     * @param text $nomrubrique
     * @return Rubrique
     */
    public function setNomrubrique($nomrubrique)
    {
        $this->nomrubrique = $nomrubrique;
        return $this;
    }

    /**
     * Get nomrubrique
     *
     * @return text 
     */
    public function getNomrubrique()
    {
        return $this->nomrubrique;
    }

    /**
     * Set descriptionrubrique
     *
     * @param text $descriptionrubrique
     * @return Rubrique
     */
    public function setDescriptionrubrique($descriptionrubrique)
    {
        $this->descriptionrubrique = $descriptionrubrique;
        return $this;
    }

    /**
     * Get descriptionrubrique
     *
     * @return text 
     */
    public function getDescriptionrubrique()
    {
        return $this->descriptionrubrique;
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