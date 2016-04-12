<?php



use Doctrine\Mapping as ORM;

/**
 * Abonne
 *
 * @Table(name="abonne")
 * @Entity
 */
class Abonne
{
    /**
     * @var integer $idabonne
     *
     * @Column(name="idAbonne", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idabonne;

    /**
     * @var text $nom
     *
     * @Column(name="nom", type="text", nullable=false)
     */
    private $nom;

    /**
     * @var text $prenom
     *
     * @Column(name="prenom", type="text", nullable=false)
     */
    private $prenom;

    /**
     * @var text $mail
     *
     * @Column(name="mail", type="text", nullable=false)
     */
    private $mail;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany(targetEntity="Newsletter", mappedBy="idabonne")
     */
    private $idnewsletter;

    public function __construct()
    {
        $this->idnewsletter = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idabonne
     *
     * @return integer 
     */
    public function getIdabonne()
    {
        return $this->idabonne;
    }

    /**
     * Set nom
     *
     * @param text $nom
     * @return Abonne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get nom
     *
     * @return text 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param text $prenom
     * @return Abonne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get prenom
     *
     * @return text 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param text $mail
     * @return Abonne
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * Get mail
     *
     * @return text 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add idnewsletter
     *
     * @param Newsletter $idnewsletter
     * @return Abonne
     */
    public function addNewsletter(\Newsletter $idnewsletter)
    {
        $this->idnewsletter[] = $idnewsletter;
        return $this;
    }

    /**
     * Get idnewsletter
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdnewsletter()
    {
        return $this->idnewsletter;
    }
}