<?php

require_once 'Author.php';
require_once 'Category.php';

class Wiki
{
    private $id;
    private $desc;
    private $banner;
    private $image;
    private $content;
    private $date;
    private $isArchived;
    private Author $author;
    private Category $categoty;


    public function __construct()
    {
        $this->author = new Author();
        $this->categoty = new Category();
    }

    /**
     * Get the value of categoty
     */ 
    public function getCategoty()
    {
        return $this->categoty;
    }

    /**
     * Set the value of categoty
     *
     * @return  self
     */ 
    public function setCategoty($categoty)
    {
        $this->categoty = $categoty;

        return $this;
    }

    /**
     * Get the value of isArchived
     */ 
    public function getIsArchived()
    {
        return $this->isArchived;
    }

    /**
     * Set the value of isArchived
     *
     * @return  self
     */ 
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of banner
     */ 
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set the value of banner
     *
     * @return  self
     */ 
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get the value of desc
     */ 
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set the value of desc
     *
     * @return  self
     */ 
    public function setDesc($desc)
    {
        $this->desc = $desc;

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

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }
}
