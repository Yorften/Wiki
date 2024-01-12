<?php

require_once 'entities/WikiTag.php';

class WikiTagDAO
{
    private $conn;
    private Wiki $wiki;
    private Tag $tag;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->wiki = new Wiki();
        $this->tag = new Tag();
    }

    public function getWikiTags($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tags_wikis JOIN tags ON tags_wikis.tagId = tags.tagId WHERE wikiId = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
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

    public function setWikiTags(Array $tags, $id)
    {
        foreach ($tags as $tag) {
            $stmt = $this->conn->prepare("INSERT INTO tags_wikis (`tagId`, `wikiId`) VALUES (?,?)");
            $stmt->bindParam(1, $tag, PDO::PARAM_INT);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        return true;
    }

    public function deleteWikiTags($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tags_wikis WHERE wikiId = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }




    /**
     * Get the value of tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Get the value of wiki
     */
    public function getWiki()
    {
        return $this->wiki;
    }
}
