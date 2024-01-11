<?php

require_once 'entities/Wiki.php';

class WikiDAO
{
    private $conn;
    private Wiki $wiki;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->wiki = new Wiki();
    }

    public function checkWiki($column, $value)
    {
        $stmt = $this->conn->prepare("SELECT * FROM wikis WHERE `$column` = ?");
        $stmt->bindParam(1, $value);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return true;
        } else return false;
    }

    public function isArchived($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM wikis WHERE wikiId = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['isArchived'] == 1) {
            return true;
        } else return false;
    }

    public function isOwner(Wiki $wiki)
    {
        $userId = $wiki->getAuthor()->getId();
        $wikiId = $wiki->getId();
        $stmt = $this->conn->prepare("SELECT * FROM wikis WHERE wikiId = ? AND userId = ?");
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
        $stmt->bindParam(2, $wikiId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return true;
        } else return false;
    }

    public function addWiki(Wiki $wiki)
    {
        $userId = $wiki->getAuthor()->getId();
        $categoryId = $wiki->getCategory()->getId();
        $name = $wiki->getName();
        $desc = $wiki->getDesc();
        $banner = $wiki->getBanner();
        $image = $wiki->getImage();
        $content = $wiki->getContent();
        $date = $wiki->getDate();

        $result = $this->checkWiki('wikiName', $name);
        if ($result) {
            return 'This wiki title already exists';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO wikis VALUES (null,?,?,?,?,?,?,0,?,?)");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $desc, PDO::PARAM_STR);
            $stmt->bindParam(3, $banner, PDO::PARAM_STR);
            $stmt->bindParam(4, $image, PDO::PARAM_STR);
            $stmt->bindParam(5, $content, PDO::PARAM_STR);
            $stmt->bindParam(6, $date, PDO::PARAM_STR);
            $stmt->bindParam(7, $userId, PDO::PARAM_INT);
            $stmt->bindParam(8, $categoryId, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->lastInsertId();
            } else
                return 'Database error';
        }
    }

    public function updateWiki(Wiki $wiki)
    {
        $wikiId = $wiki->getId();
        $categoryId = $wiki->getCategory()->getId();
        $name = $wiki->getName();
        $desc = $wiki->getDesc();
        $banner = $wiki->getBanner();
        $image = $wiki->getImage();
        $content = $wiki->getContent();
        $date = $wiki->getDate();

        $result = $this->checkWiki('wikiName', $name);
        if ($result) {
            return 'This wiki title already exists';
        } else {
            if ($banner) {
                $stmt = $this->conn->prepare("UPDATE wikis SET wikiBanner = ? WHERE wikiId = ?");
                $stmt->bindParam(1, $banner, PDO::PARAM_STR);
                $stmt->execute();
            }
            if ($image) {
                $stmt = $this->conn->prepare("UPDATE wikis SET wikiImage = ? WHERE wikiId = ?");
                $stmt->bindParam(1, $image, PDO::PARAM_STR);
                $stmt->execute();
            }
            $stmt = $this->conn->prepare("UPDATE wikis SET wikiName = ?, wikiDesc = ?, wikiContent = ?, categoryId = ? WHERE wikiId = ?");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $desc, PDO::PARAM_STR);
            $stmt->bindParam(3, $content, PDO::PARAM_INT);
            $stmt->bindParam(4, $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(5, $wikiId, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            } else
                return 'Database error';
        }
    }

    public function archiveWiki(Wiki $wiki)
    {
        $id = $wiki->getId();
        $result = $this->checkWiki('wikiId', $id);
        if ($result) {
            $stmt = $this->conn->prepare("UPDATE wikis SET isArchived = 1 WHERE wikiId = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 1;
            } else
                return 'Database error';
        } else {
            return "Wiki doesn't exist";
        }
    }

    public function restoreWiki(Wiki $wiki)
    {
        $id = $wiki->getId();
        $result = $this->checkwiki('wikiId', $id);
        if ($result) {
            $stmt = $this->conn->prepare("UPDATE wikis SET isArchived = 0 WHERE wikiId = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 2;
            } else
                return 'Database error';
        } else {
            return "Wiki doesn't exist";
        }
    }

    public function getLatestWikis()
    {
        $stmt = $this->conn->prepare("SELECT * FROM wikis JOIN categories ON wikis.categoryId = categories.categoryId JOIN users ON wikis.userId = users.userId WHERE isArchived = 0 ORDER BY wikiDate DESC LIMIT 6");
        $stmt->execute();
        $wikis = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setName($row['wikiName']);
            $wiki->setDesc($row['wikiDesc']);
            $wiki->setBanner($row['wikiBanner']);
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

    public function getAllWikis()
    {
        $stmt = $this->conn->prepare("SELECT * FROM wikis JOIN categories ON wikis.categoryId = categories.categoryId JOIN users ON wikis.userId = users.userId");
        $stmt->execute();
        $wikis = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $wiki = new wiki();
            $wiki->setId($row['wikiId']);
            $wiki->setName($row['wikiName']);
            $wiki->setDesc($row['wikiDesc']);
            $wiki->setBanner($row['wikiBanner']);
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


    /**
     * Get the value of wiki
     */
    public function getWiki()
    {
        return $this->wiki;
    }
}
