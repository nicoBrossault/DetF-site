<?php

use Doctrine\Mapping as ORM;

/**
 * Question
 *
 * @Table(name="question")
 * @Entity
 */
class Question
{	
	/**
	 * @var integer idQstSecrete
	 *
	 * @Column(name="idQstSecrete", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	private $idQstSecrete;
	
	/**
	 * @var text $question
	 *
	 * @Column(name="question", type="text", nullable=false)
	 */
	private $question;
	
    /**
     * Get idMarquesRubrique
     *
     * @return integer
     */
    public function getIdQstSecrete()
    {
    	return $this->IdQstSecrete;
    }
    
    /**
     * Get question
     *
     * @return text
     */
    public function getQuestion()
    {
    	return $this->reponse;
    }
    
    /**
     * Set question
     *
     * @param text $question
     * @return Question
     */
    public function setReponse($question)
    {
    	$this->question = $question;
    	return $this;
    }
}