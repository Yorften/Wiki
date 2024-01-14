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

    public function getWikisByTag($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tags_wikis JOIN tags ON tags_wikis.tagId = tags.tagId JOIN wikis ON tags_wikis.wikiId = wikis.wikiId JOIN categories ON wikis.categoryId = categories.categoryId JOIN users ON wikis.userId = users.userId WHERE isArchived = 0 AND tagName LIKE CONCAT('%', ? ,'%') GROUP BY wikiName");
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->execute();
        $wikis = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setName($row['wikiName']);
            $wiki->setDesc($row['wikiDesc']);
            $wiki->setImage($row['wikiImage']);
            $wiki->setContent($row['wikiContent']);
            $wiki->setDate($row['wikiDate']);
            $wiki->setIsArchived($row['isArchived']);
            $wiki->getAuthor()->setName($row['userName']);
            $wiki->getCategory()->setName($row['categoryName']);

            array_push($wikis, $wiki);
        }
        return $wikis;
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
        if($stmt->execute()){
            return true;
        }
        return false;
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
