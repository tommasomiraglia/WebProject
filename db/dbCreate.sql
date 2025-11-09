DROP DATABASE IF EXISTS UniRed;

CREATE DATABASE UniRed;

USE UniRed;

CREATE TABLE IF NOT EXISTS USERS (
    userId INT AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    email CHAR(63) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    name CHAR(31) NULL, 
    birthdate DATE NULL,
    avatar BLOB,
    typology ENUM('admin', 'utente') NOT NULL DEFAULT 'utente',
    primary key (userId)
);

CREATE TABLE IF NOT EXISTS GROUPS (
    groupId INT AUTO_INCREMENT,
    name CHAR(20) NOT NULL UNIQUE,
    longdescription VARCHAR(128) NOT NULL,
    avatar BLOB,
    primary key (groupId)
);

CREATE TABLE IF NOT EXISTS POSTS (
    postId INT AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    longdescription TEXT NOT NULL,
    upvote INT DEFAULT 0,
    downvote INT DEFAULT 0,
    groupId INT,
    userId INT,
    primary key (postId),
    FOREIGN KEY (groupId) REFERENCES GROUPS(groupId) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES USERS(userid) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS COMMENTS (
    commentId INT AUTO_INCREMENT,
    longdescription VARCHAR(100) NOT NULL,
    userId INT,
    postId INT,
    primary key (commentId),
    FOREIGN KEY (userId) REFERENCES USERS(userId) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (postId) REFERENCES POSTS(postId)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS PARTICIPANT (
    userId INT,
    groupId INT,
    subscription_date DATE,
    primary key (userId, groupId),
    FOREIGN KEY (userId) REFERENCES USERS(userId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (groupId) REFERENCES GROUPS(groupId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);
