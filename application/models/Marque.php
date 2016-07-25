<?php



use Doctrine\Mapping as ORM;

/**
 * Marque
 *
 * @Table(name="marque")
 * @Entity
 */
class Marque
{
    /**
     * @var integer $idMarque
     *
     * @Column(name="idMarque", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idMarque;

    /**
     * @var text $url
     *
     * @Column(name="url", type="text", nullable=false)
     */
    private $url;

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
     * Get idMarque
     *
     * @return integer 
     */
    public function getIdmarque()
    {
        return $this->idMarque;
    }
	
    /**
     * Set url
     *
     * @param text $url
     * @return Image
     */
    public function setUrl($url)
    {
    	$this->url = $url;
    	return $this;
    }
    
    /**
     * Get url
     *
     * @return text
     */
    public function getUrl()
    {
    	return $this->url;
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