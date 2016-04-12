<?php



use Doctrine\Mapping as ORM;

/**
 * Images
 *
 * @Table(name="images")
 * @Entity
 */
class Images
{
    /**
     * @var integer $idimages
     *
     * @Column(name="idImages", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idimages;

    /**
     * @var text $titre
     *
     * @Column(name="titre", type="text", nullable=false)
     */
    private $titre;

    /**
     * @var text $description
     *
     * @Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Articlerubrique
     *
     * @OneToOne(targetEntity="Articlerubrique")
     * @JoinColumns({
     *   @JoinColumn(name="idArticleRubrique", referencedColumnName="idArticleRubrique", unique=true)
     * })
     */
    private $idarticlerubrique;

    /**
     * @var Textsite
     *
     * @OneToOne(targetEntity="Textsite")
     * @JoinColumns({
     *   @JoinColumn(name="idTextSite", referencedColumnName="idTextSite", unique=true)
     * })
     */
    private $idtextsite;

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
     * Get idimages
     *
     * @return integer 
     */
    public function getIdimages()
    {
        return $this->idimages;
    }

    /**
     * Set titre
     *
     * @param text $titre
     * @return Images
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get titre
     *
     * @return text 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Images
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idarticlerubrique
     *
     * @param Articlerubrique $idarticlerubrique
     * @return Images
     */
    public function setIdarticlerubrique(\Articlerubrique $idarticlerubrique = null)
    {
        $this->idarticlerubrique = $idarticlerubrique;
        return $this;
    }

    /**
     * Get idarticlerubrique
     *
     * @return Articlerubrique 
     */
    public function getIdarticlerubrique()
    {
        return $this->idarticlerubrique;
    }

    /**
     * Set idtextsite
     *
     * @param Textsite $idtextsite
     * @return Images
     */
    public function setIdtextsite(\Textsite $idtextsite = null)
    {
        $this->idtextsite = $idtextsite;
        return $this;
    }

    /**
     * Get idtextsite
     *
     * @return Textsite 
     */
    public function getIdtextsite()
    {
        return $this->idtextsite;
    }

    /**
     * Set idrubrique
     *
     * @param Rubrique $idrubrique
     * @return Images
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