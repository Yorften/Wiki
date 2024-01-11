<?php

require_once 'entities/Tag.php';

class TagDAO
{
    private $conn;
    private Tag $tag;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->tag = new Tag();
    }


    public function checkTag($column, $value)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tags WHERE `$column` = ?");
        $stmt->bindParam(1, $value);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return true;
        } else return false;
    }

    public function addTag(Tag $tag)
    {
        $name = $tag->getName();
        $result = $this->checktag('tagName', $name);
        if ($result) {
            return 'Tag already exists';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO tags VALUES (null,?)");
            $stmt->bindParam(1, $name, PDO::PARAM_STR_CHAR);
            if ($stmt->execute()) {
                return 1;
            } else
                return 'Database error';
        }
    }

    public function updateTag(Tag $tag)
    {
        $name = $tag->getName();
        $id = $tag->getId();
        $result = $this->checkTag('tagName', $name);
        if ($result) {
            return 'Tag already exists';
        } else {
            $stmt = $this->conn->prepare("UPDATE tags SET tagName = ? WHERE tagId = ?");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 1;
            } else
                return 'Database error';
        }
    }

    public function deleteTag(Tag $tag)
    {
        $id = $tag->getId();
        $result = $this->checkTag('tagId', $id);
        if ($result) {
            $stmt = $this->conn->prepare("DELETE FROM tags WHERE tagId = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 3;
            } else
                return 'Database error';
        } else {
            return "tag doesn't exist";
        }
    }

    public function getAllTags()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tags");
        $stmt->execute();
        $tags = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tag = new Tag();
            $tag->setId($row['tagId']);
            $tag->setName($row['tagName']);
            array_push($tags, $tag);
        }
        return $tags;
    }

    /**
     * Get the value of tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
