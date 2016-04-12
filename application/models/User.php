<?php



use Doctrine\Mapping as ORM;

/**
 * User
 *
 * @Table(name="user")
 * @Entity
 */
class User
{
    /**
     * @var integer $iduser
     *
     * @Column(name="idUser", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

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
     * @var text $mdp
     *
     * @Column(name="mdp", type="text", nullable=false)
     */
    private $mdp;


    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set nom
     *
     * @param text $nom
     * @return User
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
     * @return User
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
     * @return User
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
     * Set mdp
     *
     * @param text $mdp
     * @return User
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * Get mdp
     *
     * @return text 
     */
    public function getMdp()
    {
        return $this->mdp;
    }
}