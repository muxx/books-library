<?php

namespace Intaro\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="book")
 */
class Book
{
    const
        COVER_UPLOAD_DIR = '/uploads/covers',
        FILE_UPLOAD_DIR  = '/uploads/books';

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
     * @ORM\Column(type="boolean")
     */
    protected $allow_download;
    
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
     * for files upload
     */
    public $cover_file;
    public $book_file;

    /**
     * Create object
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->read_at = new \DateTime();
    }

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
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->cover_file) 
        {
            // do whatever you want to generate a unique name
            $this->cover = uniqid() . '.' . $this->cover_file->guessExtension();
        }

        if (null !== $this->book_file) 
        {
            $sourceExtension = pathinfo($this->book_file->getClientOriginalName(), PATHINFO_EXTENSION);
            // do whatever you want to generate a unique name
            $this->filename = uniqid() . '.' . ($this->book_file->guessExtension() != $sourceExtension ? $sourceExtension : $this->book_file->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->cover_file) 
        {
            $this->cover_file->move($this->getWebRootDir() . self::COVER_UPLOAD_DIR, $this->cover);        
            unset($this->cover_file);
        }    

        if (null !== $this->book_file) 
        {
            $this->book_file->move($this->getWebRootDir() . self::FILE_UPLOAD_DIR, $this->filename);        
            unset($this->book_file);
        }    
    }    

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getCoverAbsolutePath())
            unlink($file);

        if ($file = $this->getFileAbsolutePath())
            unlink($file);
    }
        
    public function getCoverAbsolutePath()
    {
        return null === $this->cover ? null : $this->getWebRootDir() . self::COVER_UPLOAD_DIR . '/' . $this->cover;
    }

    public function getCoverWebPath()
    {
        return null === $this->cover ? null : self::COVER_UPLOAD_DIR . '/' . $this->cover;
    }
    
    public function getFileAbsolutePath()
    {
        return null === $this->filename ? null : $this->getWebRootDir() . self::FILE_UPLOAD_DIR . '/' . $this->filename;
    }

    public function getFileWebPath()
    {
        return null === $this->filename ? null : self::FILE_UPLOAD_DIR . '/' . $this->filename;
    }

    protected function getWebRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web';
    }

    /**
     * Set allow_download
     *
     * @param boolean $allowDownload
     */
    public function setAllowDownload($allowDownload)
    {
        $this->allow_download = $allowDownload;
    }

    /**
     * Get allow_download
     *
     * @return boolean 
     */
    public function getAllowDownload()
    {
        return $this->allow_download;
    }
}