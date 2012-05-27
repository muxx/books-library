<?php

namespace Intaro\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    protected $id;
    
    /**
     * @ORM\Column(length=255)
     */
    protected $name;
    
    /**
     * @ORM\Column(length=255)
     */
    protected $author;
    
    /**
     * @ORM\Column(length=255, nullable=true)
     */
    protected $cover;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $read_at;
    
    /**
     * @ORM\Column(length=255, nullable=true)
     */
    protected $filename;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set cover
     *
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set read_at
     *
     * @param date $readAt
     */
    public function setReadAt($readAt)
    {
        $this->read_at = $readAt;
    }

    /**
     * Get read_at
     *
     * @return date 
     */
    public function getReadAt()
    {
        return $this->read_at;
    }

    /**
     * Set filename
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
}