DROP DATABASE IF EXISTS UniRed;

CREATE DATABASE UniRed;

USE UniRed;

CREATE TABLE IF NOT EXISTS USER (
    userId CHAR(20) NOT NULL UNIQUE,
    email CHAR(63) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    phoneNumber CHAR(31) NULL,
    name CHAR(31) NULL, 
    birthDate date NULL,
    typology BOOLEAN NOT NULL DEFAULT FALSE,
    primary key (userId)
);