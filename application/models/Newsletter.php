<?php



use Doctrine\Mapping as ORM;

/**
 * Newsletter
 *
 * @Table(name="newsletter")
 * @Entity
 */
class Newsletter
{
    /**
     * @var integer $idnewsletter
     *
     * @Column(name="idNewsletter", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idnewsletter;

    /**
     * @var text $titre
     *
     * @Column(name="titre", type="text", nullable=false)
     */
    private $titre;

    /**
     * @var text $texte
     *
     * @Column(name="texte", type="text", nullable=false)
     */
    private $texte;

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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany(targetEntity="Abonne", inversedBy="idnewsletter")
     * @JoinTable(name="recevoir",
     *   joinColumns={
     *     @JoinColumn(name="idNewsletter", referencedColumnName="idNewsletter")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="idAbonne", referencedColumnName="idAbonne")
     *   }
     * )
     */
    private $idabonne;

    public function __construct()
    {
        $this->idabonne = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idnewsletter
     *
     * @return integer 
     */
    public function getIdnewsletter()
    {
        return $this->idnewsletter;
    }

    /**
     * Set titre
     *
     * @param text $titre
     * @return Newsletter
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
     * Set texte
     *
     * @param text $texte
     * @return Newsletter
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * Get texte
     *
     * @return text 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set iduser
     *
     * @param User $iduser
     * @return Newsletter
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

    /**
     * Add idabonne
     *
     * @param Abonne $idabonne
     * @return Newsletter
     */
    public function addAbonne(\Abonne $idabonne)
    {
        $this->idabonne[] = $idabonne;
        return $this;
    }

    /**
     * Get idabonne
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdabonne()
    {
        return $this->idabonne;
    }
}