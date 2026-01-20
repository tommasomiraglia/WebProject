DROP DATABASE IF EXISTS UniRed;

CREATE DATABASE UniRed;

USE UniRed;

CREATE TABLE IF NOT EXISTS USERS (
    userId INT AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    email CHAR(63) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    description VARCHAR(500),
    avatar VARCHAR(255) DEFAULT NULL,
    gender ENUM('Male' , 'Female' , 'Non-binary' , 'I prefer not to say'),
    typology ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    primary key (userId)
);

CREATE TABLE IF NOT EXISTS GROUPS (
    groupId INT AUTO_INCREMENT,
    name CHAR(20) NOT NULL UNIQUE,
    longdescription VARCHAR(128) NOT NULL,
    avatar VARCHAR(255),
    primary key (groupId)
);

CREATE TABLE IF NOT EXISTS POSTS (
    postId INT AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    longdescription TEXT NOT NULL,
    upvote INT DEFAULT 0,
    downvote INT DEFAULT 0,
    postDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    postImage VARCHAR(100),
    reportCount INT DEFAULT 0,
    groupId INT,
    userId INT,
    primary key (postId),
    FOREIGN KEY (groupId) REFERENCES GROUPS(groupId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES USERS(userId) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS COMMENTS (
    commentId INT AUTO_INCREMENT,
    longdescription VARCHAR(500) NOT NULL,
    commentDate date,
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
    subscriptionDate DATE,
    primary key (userId, groupId),
    FOREIGN KEY (userId) REFERENCES USERS(userId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (groupId) REFERENCES GROUPS(groupId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS LIKES (
    postId INT, 
    userId INT,
    is_upvote BOOLEAN,
    PRIMARY KEY (postId, userId),
    FOREIGN KEY (postId) REFERENCES POSTS(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES USERS(userId) ON DELETE CASCADE
);