<?php

require_once 'Wiki.php';
require_once 'Tag.php';

class WikiTag
{
    private $id;
    private Wiki $wiki;
    private Tag $tag;

    public function __construct()
    {
        $this->wiki = new Wiki();
        $this->tag = new Tag();
    }

    /**
     * Get the value of wiki
     */ 
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of wiki
     *
     * @return  self
     */ 
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

    /**
     * Get the value of tag
     */ 
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set the value of tag
     *
     * @return  self
     */ 
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
