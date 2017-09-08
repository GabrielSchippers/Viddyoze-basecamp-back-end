<?php

namespace AppBundle\Entity;

use Doctrin\ORM\Mapping as ORM;

/**
*Quote
*
*@ORM\Table()
*@ORM\Entity\(repositoryClass="AppBundle\Entity\QuoteRepository")
*/

class Quote {
    /**
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="Auto")
    */
    private $id;

    /**
    * @var string
    *
    * @ORM\column(name="author", type="string", length="255")
    */
    private $author;

    /**
    * @var string
    *
    * @ORM\column(name="content", type="text")
    */
    private $content;

    /**
    * Get id
    *
    * @return integer
    */
    public function getId(){
        return $this->id;
    }

    /**
    * Get Author
    *
    * @return string
    */
    public function getAuthor(){
        return $this->author;
    }

    /**
    * Set Author
    *
    * @return string
    */
    public function setAuthor($author){
        return $this->author = $author;
    }

    /**
    * Get Content
    *
    * @return text
    */
    public function getContent(){
        return $this->content;
    }

    /**
    * Set Content
    *
    * @return text
    */
    public function setContent($content){
        return $this->content = $content;
    }
}