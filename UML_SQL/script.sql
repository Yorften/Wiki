CREATE DATABASE wiki;
USE wiki;

CREATE TABLE users (
	userId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(255),
    userEmail VARCHAR(255),
    userPassword VARCHAR(255),
    userDate DATE,
    userRole ENUM('admin','author')
);

CREATE TABLE tags (
	tagId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tagName VARCHAR(255)
);

CREATE TABLE categories (
	categoryId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255),
    categoryDate DATETIME
);

CREATE TABLE wikis (
	wikiId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    wikiName VARCHAR(255),
    wikiDesc VARCHAR(500),
    wikiImage VARCHAR(255),
    wikiContent VARCHAR(20000),
    wikiDate DATETIME,
    isArchived SMALLINT(1) DEFAULT FALSE,
    userId INT,
    categoryId INT,
    CONSTRAINT fk_wiki_user FOREIGN KEY (userId) REFERENCES users(userId),
    CONSTRAINT fk_wiki_category FOREIGN KEY (categoryId) REFERENCES categories(categoryId) ON DELETE CASCADE
);

CREATE TABLE tags_wikis (
	tags_wikisId INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    tagId INT,
    wikiId INT,
    CONSTRAINT fk_tagswikis_tag FOREIGN KEY (tagId) REFERENCES tags(tagId),
    CONSTRAINT fk_tagswikis_wiki FOREIGN KEY (wikiId) REFERENCES wikis(wikiId) ON DELETE CASCADE
);

ALTER TABLE wikis ADD wikiDesc VARCHAR(500) NOT NULL AFTER wikiId;

ALTER TABLE users CHANGE userRole userRole ENUM('admin','author') NOT NULL DEFAULT 'author';