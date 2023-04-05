CREATE SCHEMA IF NOT EXISTS paginas_amarelas;

SET search_path TO paginas_amarelas;

---------------------------------------
-- Drops
----------------------------------------
DROP TABLE IF EXISTS eventtags CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS formation CASCADE;
DROP TABLE IF EXISTS eventversion CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS usereventorganic CASCADE;
DROP TABLE IF EXISTS userserviceorganic CASCADE;
DROP TABLE IF EXISTS organicunit CASCADE;
DROP TABLE IF EXISTS userservicerequest CASCADE;
DROP TABLE IF EXISTS usereventrequest CASCADE;
DROP TABLE IF EXISTS service CASCADE;
DROP TABLE IF EXISTS servicetype CASCADE;
DROP TABLE IF EXISTS questions CASCADE;
DROP TABLE IF EXISTS event CASCADE;
DROP TYPE  IF EXISTS RequestStatus;
DROP TYPE  IF EXISTS RequestTypes;
DROP TYPE  IF EXISTS Roles;
----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE RequestStatus AS ENUM ('Accepted', 'Pending', 'Rejected', 'Old');

CREATE TYPE RequestTypes AS ENUM ('Create', 'Edit', 'Archive');

CREATE TYPE Roles AS ENUM ('GI', 'Administrator');--Retirar admin daqui? e qual a necessidade de Authenticated?


-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE users(
    userId SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL UNIQUE,
    name VARCHAR NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE, --Retirar?
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    userPhoto VARCHAR NOT NULL
);


CREATE TABLE tag(
    tagId SERIAL PRIMARY KEY,
    tagName VARCHAR NOT NULL UNIQUE
);


CREATE TABLE event(
    eventId SERIAL PRIMARY KEY,
    requestStatus RequestStatus NOT NULL,
    requestType RequestTypes NOT NULL,
    eventName VARCHAR NOT NULL UNIQUE,
    address VARCHAR NOT NULL,
    url VARCHAR,
    email VARCHAR NOT NULL,
    dateCreated DATE NOT NULL,
    dateReviewed DATE,
    contactPerson VARCHAR NOT NULL,  
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    eventCanceled BOOLEAN NOT NULL DEFAULT FALSE,
    version INTEGER NOT NULL DEFAULT 1,
    --tagId INTEGER REFERENCES tag(tagId) NOT NULL,
    CHECK(endDate >= startDate),
    CHECK(dateCreated <= dateReviewed)
);

CREATE TABLE eventversion(
    newestversionId INTEGER,
    oldestversionId INTEGER,
    CONSTRAINT eventVersionPk PRIMARY KEY (oldestversionId),
    CONSTRAINT newestversionFk FOREIGN KEY (newestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT oldestversionFk FOREIGN KEY (oldestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION
);


CREATE TABLE organicunit(
    organicUnitId SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE formation(
    roleId SERIAL PRIMARY KEY,
    roleType Roles NOT NULL,
    userId INTEGER REFERENCES users(userId),
    organicUnitId INTEGER REFERENCES organicunit(organicUnitId)
);



CREATE TABLE questions(
    questionsId SERIAL PRIMARY KEY,
    question1 VARCHAR NOT NULL, 
    question2 VARCHAR,
    question3 VARCHAR,
    question4 VARCHAR,
    question5 VARCHAR,
    question6 VARCHAR,
    question7 VARCHAR,
    question8 VARCHAR,
    question9 VARCHAR,
    question10 VARCHAR
);

CREATE TABLE servicetype(
    serviceTypeId SERIAL PRIMARY KEY,
    serviceTypeName VARCHAR NOT NULL,
    atribute1 VARCHAR NOT NULL,
    atribute2 VARCHAR,
    atribute3 VARCHAR,
    atribute4 VARCHAR,
    atribute5 VARCHAR,
    atribute6 VARCHAR,
    atribute7 VARCHAR,
    atribute8 VARCHAR,
    atribute9 VARCHAR,
    atribute10 VARCHAR,
    questionsId INTEGER REFERENCES questions(questionsId)
);

CREATE TABLE service(
    serviceId SERIAL PRIMARY KEY,
    serviceName VARCHAR NOT NULL,
    requestStatus RequestStatus NOT NULL,
    requestType RequestTypes NOT NULL,
    purpose VARCHAR,
    email VARCHAR,
    contactPerson VARCHAR,
    url VARCHAR,
    version INTEGER DEFAULT 1,
    startDate DATE,--NOT NULL?
    endDate DATE,--NOT NULL?
    versionNumber INTEGER,
    serviceTypeId INTEGER REFERENCES servicetype(serviceTypeId)
);

CREATE TABLE userservicerequest(
    serviceId INTEGER NOT NULL REFERENCES service(serviceId) ON DELETE CASCADE,
    userId INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE
);

CREATE TABLE usereventrequest(
    eventId INTEGER NOT NULL REFERENCES event(eventId) ON DELETE CASCADE,
    userId INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE
);


CREATE TABLE  usereventorganic(
    userId INTEGER,
    eventId INTEGER,
    organicUnitId INTEGER,
    CONSTRAINT UserEventOrganic_PK PRIMARY KEY (userId,eventId,organicUnitId),
    CONSTRAINT UEO_User_FK FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE NO ACTION ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Event_FK FOREIGN KEY (eventId) REFERENCES event(eventId) ON DELETE CASCADE ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Organic_FK FOREIGN KEY (organicUnitId) REFERENCES organicunit(organicUnitId) ON DELETE CASCADE ON UPDATE NO ACTION 
);

CREATE TABLE  userserviceorganic(
    userId INTEGER,
    serviceId INTEGER,
    organicUnitId INTEGER,
    CONSTRAINT UserServiceOrganic_PK PRIMARY KEY (userId,serviceId,organicUnitId),
    CONSTRAINT UEO_User_FK FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE NO ACTION ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Servic_FK FOREIGN KEY (serviceId) REFERENCES service(serviceId) ON DELETE CASCADE ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Organic_FK FOREIGN KEY (organicUnitId) REFERENCES organicunit(organicUnitId) ON DELETE CASCADE ON UPDATE NO ACTION 
);

CREATE TABLE eventtags(
    eventId INTEGER,
    tagId INTEGER,
    CONSTRAINT EventTags_PK PRIMARY KEY (eventId,tagId),
    CONSTRAINT ET_Event_FK FOREIGN KEY (eventId) REFERENCES event(eventId) ON DELETE CASCADE ON UPDATE NO ACTION, 
    CONSTRAINT ET_Tag_FK FOREIGN KEY (tagId) REFERENCES tag(tagId) ON DELETE CASCADE ON UPDATE NO ACTION 
);

--------------------------------------------------------


