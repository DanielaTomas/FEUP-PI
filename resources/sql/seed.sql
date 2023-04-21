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

CREATE TYPE RequestStatus AS ENUM ('Accepted', 'Pending', 'Rejected');

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
    eventName VARCHAR NOT NULL, -- TODO: fix unique when editing
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
    --organicUnitId INTEGER REFERENCES organicunit(organicUnitId),
    CHECK(endDate >= startDate),
    CHECK(dateCreated <= dateReviewed)
);
/*
CREATE TABLE eventversion(
    newestversionId INTEGER,
    oldestversionId INTEGER,
    CONSTRAINT eventVersionPk PRIMARY KEY (oldestversionId),
    CONSTRAINT newestversionFk FOREIGN KEY (newestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT oldestversionFk FOREIGN KEY (oldestversionId) REFERENCES event(eventId) ON DELETE NO ACTION ON UPDATE NO ACTION
);
*/

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
    userId INTEGER NULL, -- allow null values
    eventId INTEGER NOT NULL,
    organicUnitId INTEGER NOT NULL,
    CONSTRAINT UserEventOrganic_PK PRIMARY KEY (userId,eventId,organicUnitId),
    CONSTRAINT UEO_User_FK FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE NO ACTION ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Event_FK FOREIGN KEY (eventId) REFERENCES event(eventId) ON DELETE CASCADE ON UPDATE NO ACTION, 
    CONSTRAINT UEO_Organic_FK FOREIGN KEY (organicUnitId) REFERENCES organicunit(organicUnitId) ON DELETE CASCADE ON UPDATE NO ACTION 
);

CREATE TABLE  userserviceorganic(
    userId INTEGER  NULL, -- allow null values,
    serviceId INTEGER NOT NULL,
    organicUnitId INTEGER NOT NULL,
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


-- USERS
INSERT INTO users (username, name,isAdmin, email, password, userPhoto) VALUES ('admin','admin',TRUE,'admin@example.com','$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia','prettyphooto');
INSERT INTO users (username, name,isAdmin,email,password,userPhoto) VALUES('bicente','O GRANDE',FALSE,'henrique@gaio.com','$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia','prettyphooto');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202006188', 'Rita Mendes', FALSE, 'up202006188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201206188', 'João  Carvalho', FALSE, 'up201206188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201006188', 'Eduardo Aragão', FALSE, 'up201006188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201506188', 'Vitor Ferreira', FALSE, 'up201506188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202106188', 'Ana Clara Pinto', FALSE, 'up202106188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201801188', 'Lucas Moura', FALSE, 'up201801188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202008188', 'Bruna Almeida', FALSE, 'up202008188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201207188', 'Gabriel Farias', FALSE, 'up201207188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202005188', 'Daniel Campos', FALSE, 'up202005188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201503188', 'Rebeca Cunha', FALSE, 'up201503188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202106118', 'João Pedro Pinto', FALSE, 'up202106118@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201106198', 'Natália Mendes', FALSE, 'up201106198@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202005555', 'Pedro Correia', FALSE, 'up202005555@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201606188', 'Diogo Nunes', FALSE, 'up201606188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up202001958', 'Daniela Tomas', FALSE, 'up202001958@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/john_doe.jpg');
INSERT INTO users (username, name, isAdmin, email, password, userPhoto) VALUES ('up201706188', 'Miguel Tavares', FALSE, 'up201706188@up.pt', '$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia', 'https://www.example.com/user_photos/jane_doe.jpg');




-- TAGS 
INSERT INTO tag (tagName) VALUES ('music');
INSERT INTO tag (tagName) VALUES ('art');
INSERT INTO tag (tagName) VALUES ('tecnology');
INSERT INTO tag (tagName) VALUES ('sports');
INSERT INTO tag (tagName) VALUES ('science');
INSERT INTO tag (tagName) VALUES ('literature');
INSERT INTO tag (tagName) VALUES ('education');
INSERT INTO tag (tagName) VALUES ('studentlife');
INSERT INTO tag (tagName) VALUES ('nanotechnology');
INSERT INTO tag (tagName) VALUES ('ecotourism');
INSERT INTO tag (tagName) VALUES ('cinematography');
INSERT INTO tag (tagName) VALUES ('marketing');
INSERT INTO tag (tagName) VALUES ('i3S');
INSERT INTO tag (tagName) VALUES ('sustainability');
INSERT INTO tag (tagName) VALUES ('finance');
INSERT INTO tag (tagName) VALUES ('networking');

-- EVENT
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled)VALUES ('Accepted', 'Create', 'FEP International Week', 'R. Dr. Roberto Frias, 4200-464 Porto', 'https://sigarra.up.pt/fep/pt/web_base.gera_pagina?p_pagina=1031336', 'info@example.com','2022-01-01', '2022-03-10', 'Diogo Cruz', 'This initiative aims to make known the international mobility opportunities that the Faculty offers to its students.', '2022-11-28', '2022-11-30', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Pending', 'Create', 'THE IMPACT OF AIR AND NOISE POLLUTION ON HEALTH', 'Rua Doutor Plácido da Costa, 4200-450 Porto', 'https://noticias.up.pt/fmup-e-cintesis-estudam-impacto-da-poluicao-atmosferica-e-sonora-na-saude/', 'info@example.com','2023-03-15', NULL, 'João Vasco Santos', 'Know the socio-economic impact of environmental stressors in Europe.', '2023-05-01', '2023-05-31', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Accepted', 'Create', 'FEUP DNA in technology for reducing textile industry waste', 'R. Dr. Roberto Frias, 4200-465 Porto', 'https://issuu.com/feup/docs/highlights_2022_final/26', 'info@example.com', '2023-02-01', '2023-02-11', ' António Rocha', 'A company in the textile sector that reduces waste by detecting fabric imperfections at an early stage in the production chain.', '2023-04-01', '2023-04-07', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Accepted', 'Edit', 'FEUP DNA in technology for reducing textile industry waste', 'R. Dr. Roberto Frias, 4200-465 Porto', 'https://issuu.com/feup/docs/highlights_2022_final/26', 'info@example.com', '2023-02-12', '2023-02-20', ' António Rocha', 'Alumni from U.Porto, are the founders of Smartex.ai, a company in the textile sector that reduces waste by detecting fabric imperfections at an early stage in the production chain.', '2023-04-01', '2023-04-07', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Rejected', 'Create', 'Profession Week: Engineer 2023', 'R. Dr. Roberto Frias, 4200-465 Porto', 'https://paginas.fe.up.pt/~escolas/spe/inscricoesspe23/', 'info@example.com', '2023-01-01', '2023-01-02', 'Rudolfo Bruno', 'Event for high school students returns to FEUP campus on March 28th, 29th and 30th.', '2023-03-28', '2023-03-30', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Accepted', 'Edit', 'Concert for the release of the album ''Something to Believe In'': Porta-Jazz Stamp', '890 Oak Street, Anytown USA', 'https://sigarra.up.pt/feup/pt/noticias_geral.ver_noticia?P_NR=147390', 'info@example.com','2022-08-01', '2022-08-20', 'Karen Davis', 'O Comissariado Cultural da FEUP e o Porta-Jazz convidam a comunidade FEUP para o concerto de lançamento do disco "Something to Believe In", no Auditório José Marques dos Santos, a 15 de março, pelas 21h30.', '2022-11-01', '2022-11-01', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Rejected', 'Archive', 'Annual Charity Auction', '789 Oak Lane, Anytown USA', 'https://www.example.com/charity_auction', 'info@example.com','2021-10-20', '2021-11-01', 'Sarah Johnson', 'Bid on unique items to support a great cause!', '2021-11-15', '2021-11-16', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Pending', 'Create', 'Immunotherapy is cost-effective in treating children with dust mite allergic asthma', 'Rua das Taipas 135, 4050-600 Porto', 'https://ispup.up.pt/en/immunotherapy-is-cost-effective-in-treating-children-with-dust-mite-allergic-asthma/', 'info@example.com', '2022-02-15', NULL, 'Emily Davis', 'An ISPUP research has concluded that immunotherapy is cost-effective in treating children with house dust mite-driven allergic asthma.', '2022-07-10', '2022-07-10', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Pending', 'Create', 'ISPUP implements a project in Matosinhos to help prevent memory loss', 'Rua das Taipas 135, 4050-600 Porto', 'https://ispup.up.pt/en/ispup-implements-a-project-in-matosinhos-to-help-prevent-memory-loss/', 'info@example.com','2023-02-15', NULL, 'Emilia David', 'The MIND-Matosinhos project aims to help prevent cognitive decline in the citizens of the municipality of Matosinhos. ', '2023-07-10', '2023-07-10', FALSE);
INSERT INTO event (requestStatus, requestType, eventName, address, url, email, dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled) VALUES ('Pending', 'Create', 'More than 250 students participated in the AlergiaPT project contests', 'Rua das Taipas 135, 4050-600 Porto', 'https://ispup.up.pt/en/over-250-students-participated-in-the-alergiapt-project-contests/', 'info@example.com','2022-02-15', NULL, 'David Emilia', 'The contests for the school community organised within the AlergiaPT project, promoted by ISPUP, counted with the participation of 253 primary, middle, and secondary school students from four districts of Portugal.', '2022-07-10', '2022-07-10', FALSE);

-----------------------------------------------------------------------------------------------------------------------------------------------

--ORGANIC UNIT
INSERT INTO organicunit (name) VALUES ('FMDUP');
INSERT INTO organicunit (name) VALUES ('FMUP');
INSERT INTO organicunit (name) VALUES ('FPCE');
INSERT INTO organicunit (name) VALUES ('FAUP');
INSERT INTO organicunit (name) VALUES ('FCNAUP');
INSERT INTO organicunit (name) VALUES ('FCUP');
INSERT INTO organicunit (name) VALUES ('FEP');
INSERT INTO organicunit (name) VALUES ('FEUP');
INSERT INTO organicunit (name) VALUES ('FLUP');
INSERT INTO organicunit (name) VALUES ('ICBAS');
INSERT INTO organicunit (name) VALUES ('REITORIA');
INSERT INTO organicunit (name) VALUES ('SIPREITORIA');
INSERT INTO organicunit (name) VALUES ('UPDIGITAL');
INSERT INTO organicunit (name) VALUES ('ISPUP');
INSERT INTO organicunit (name) VALUES ('ALUMNI');
INSERT INTO organicunit (name) VALUES ('CULTURA');

-- FORMATION
INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 2, 1);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 2, 8);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 3, 2);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 4, 3);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 5, 4);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 6, 5);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 8, 6);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 9, 7);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 10, 9);

INSERT INTO formation (roleType, userId, organicUnitId) VALUES ('GI', 11, 10);


---- USER EVENT REQUEST
INSERT INTO usereventrequest (eventId, userId) VALUES (1, 2);
INSERT INTO usereventrequest (eventId, userId) VALUES (2, 2);
INSERT INTO usereventrequest (eventId, userId) VALUES (3, 3);
INSERT INTO usereventrequest (eventId, userId) VALUES (4, 4);
INSERT INTO usereventrequest (eventId, userId) VALUES (5, 5);
INSERT INTO usereventrequest (eventId, userId) VALUES (6, 6);
INSERT INTO usereventrequest (eventId, userId) VALUES (7, 7);
INSERT INTO usereventrequest (eventId, userId) VALUES (8, 8);
INSERT INTO usereventrequest (eventId, userId) VALUES (9, 9);
INSERT INTO usereventrequest (eventId, userId) VALUES (10, 10);

--- EVENT TAGS
INSERT INTO eventtags (eventId, tagId) VALUES (1,1);
INSERT INTO eventtags (eventId, tagId) VALUES (1,7);
INSERT INTO eventtags (eventId, tagId) VALUES (2,5);
INSERT INTO eventtags (eventId, tagId) VALUES (2,6);
INSERT INTO eventtags (eventId, tagId) VALUES (2,8);
INSERT INTO eventtags (eventId, tagId) VALUES (2,15);
INSERT INTO eventtags (eventId, tagId) VALUES (3,3);
INSERT INTO eventtags (eventId, tagId) VALUES (3,5);
INSERT INTO eventtags (eventId, tagId) VALUES (3,9);
INSERT INTO eventtags (eventId, tagId) VALUES (4,3);
INSERT INTO eventtags (eventId, tagId) VALUES (4,5);
INSERT INTO eventtags (eventId, tagId) VALUES (4,9);
INSERT INTO eventtags (eventId, tagId) VALUES (4,14);
INSERT INTO eventtags (eventId, tagId) VALUES (5,1);
INSERT INTO eventtags (eventId, tagId) VALUES (5,4);
INSERT INTO eventtags (eventId, tagId) VALUES (5,8);
INSERT INTO eventtags (eventId, tagId) VALUES (6,2);
INSERT INTO eventtags (eventId, tagId) VALUES (6,4);
INSERT INTO eventtags (eventId, tagId) VALUES (6,8);
INSERT INTO eventtags (eventId, tagId) VALUES (6,13);
INSERT INTO eventtags (eventId, tagId) VALUES (7,3);
INSERT INTO eventtags (eventId, tagId) VALUES (7,5);
INSERT INTO eventtags (eventId, tagId) VALUES (7,9);
INSERT INTO eventtags (eventId, tagId) VALUES (8,2);
INSERT INTO eventtags (eventId, tagId) VALUES (8,4);
INSERT INTO eventtags (eventId, tagId) VALUES (8,8);
INSERT INTO eventtags (eventId, tagId) VALUES (8,13);
INSERT INTO eventtags (eventId, tagId) VALUES (9,7);
INSERT INTO eventtags (eventId, tagId) VALUES (9,15);
INSERT INTO eventtags (eventId, tagId) VALUES (10,7);
INSERT INTO eventtags (eventId, tagId) VALUES (10,11);


---- usereventorganic
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 1, 7);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 2, 2);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 3, 8);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 4, 8);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 5, 8);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 6, 8);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 7, 16);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 8, 14);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 9, 14);
INSERT INTO usereventorganic (userId,eventId, organicUnitId) VALUES (1, 10, 14);


-- Sample data for the "questions" table
INSERT INTO questions (question1, question2, question3, question4, question5, question6, question7, question8, question9, question10)
VALUES ('What is your name?', 'What is your age?', 'What is your favorite color?', 'What is your favorite food?', 'What is your favorite movie?',
'What is your favorite book?', 'What is your favorite sport?', 'What is your favorite hobby?', 'What is your favorite animal?', 'What is your favorite song?');
