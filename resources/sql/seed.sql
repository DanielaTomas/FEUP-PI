CREATE SCHEMA IF NOT EXISTS paginas_amarelas;

SET search_path TO paginas_amarelas;

---------------------------------------
-- Drops
----------------------------------------




----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE RequestStatus AS ENUM ('Accepted', 'Pending', 'Rejected', 'Old');

CREATE TYPE RequestTypes AS ENUM ('Create', 'Edit', 'Archive');


-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE user(
    userId SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL UNIQUE,
    name VARCHAR NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
    isGI BOOLEAN NOT NULL DEFAULT FALSE,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    userPhoto VARCHAR NOT NULL,
    CHECK IF (isAdmin=True, isGI=False),
    CHECK IF (isGI=True,isAdmin=False)
)


CREATE TABLE event(
    eventId SERIAL PRIMARY KEY,
    RequestStatus RequestStatus NOT NULL,
    RequestType RequestTypes NOT NULL,
    eventName VARCHAR NOT NULL UNIQUE,
    address VARCHAR NOT NULL,
    url VARCHAR,
    email VARCHAR NOT NULL,
    dateCreated DATE NOT NULL,
    dateReviewed DATE,
    contactPerson VARCHAR NOT NULL, -- THIS A VARCHAR OR CHAR(8)????
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    eventCanceled BOOLEAN NOT NULL DEFAULT FALSE,
    version INTEGER NOT NULL DEFAULT 1,
    categoryId INTEGER REFERENCES category(categoryId) NOT NULL,
    CHECK(endDate >= startDate),
    CHECK(dateCreated <= dateReviewed)
)

CREATE TABLE eventVersion(
    newestversionId INTEGER,
    oldestversionId INTEGER,
    CONSTRAINT eventVersionPk PRIMARY KEY (oldestversionId),
    CONSTRAINT newestversionFk FOREIGN KEY (newestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT oldestversionFk FOREIGN KEY (oldestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION
)


CREATE TABLE category(
    categoryId SERIAL PRIMARY KEY,
    categoryName VARCHAR NOT NULL UNIQUE,
)

CREATE TABLE subcategory(
    subCategoryId SERIAL PRIMARY KEY,
    subCategoryName VARCHAR NOT NULL UNIQUE,
)

CREATE TABLE eventsubcategory(
    eventId INTEGER NOT NULL REFERENCES users(eventId) ON DELETE CASCADE,
    subCategoryId INTEGER NOT NULL REFERENCES product(subCategoryId) ON DELETE CASCADE,

)


CREATE TABLE organisationunit(
    organisationUnitId SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE,
)

/*CREATE TABLE userservice(
    eventId integer NOT NULL REFERENCES users(eventId) ON DELETE CASCADE,
    userId integer NOT NULL REFERENCES user(userId) ON DELETE CASCADE,
)*/

CREATE TABLE userevent(
    eventId INTEGER NOT NULL REFERENCES users(eventId) ON DELETE CASCADE,
    userId INTEGER NOT NULL REFERENCES user(userId) ON DELETE CASCADE,
)

CREATE TABLE userorganisation(
    userId INTEGER NOT NULL REFERENCES user(userId) ON DELETE CASCADE,
    organisationUnitId INTEGER NOT NULL REFERENCES product(organisationUnitId) ON DELETE CASCADE,
)
