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
}