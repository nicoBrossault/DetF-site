<?php



use Doctrine\Mapping as ORM;

/**
 * Articlerubrique
 *
 * @Table(name="articlerubrique")
 * @Entity
 */
class Articlerubrique
{
    /**
     * @var integer $idarticlerubrique
     *
     * @Column(name="idArticleRubrique", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idarticlerubrique;

    /**
     * @var text $textrubrique
     *
     * @Column(name="textRubrique", type="text", nullable=false)
     */
    private $textrubrique;

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
     * Get idarticlerubrique
     *
     * @return integer 
     */
    public function getIdarticlerubrique()
    {
        return $this->idarticlerubrique;
    }

    /**
     * Set textrubrique
     *
     * @param text $textrubrique
     * @return Articlerubrique
     */
    public function setTextrubrique($textrubrique)
    {
        $this->textrubrique = $textrubrique;
        return $this;
    }

    /**
     * Get textrubrique
     *
     * @return text 
     */
    public function getTextrubrique()
    {
        return $this->textrubrique;
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
}