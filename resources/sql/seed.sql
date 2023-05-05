CREATE SCHEMA IF NOT EXISTS paginas_amarelas;

SET search_path TO paginas_amarelas;

---------------------------------------
-- Drops
----------------------------------------
DROP TABLE IF EXISTS organicService CASCADE;
DROP TABLE IF EXISTS serviceName CASCADE;
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

CREATE TYPE Roles AS ENUM ('GI');


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
    tagNamePortuguese VARCHAR NOT NULL UNIQUE,
    tagNameEnglish VARCHAR NOT NULL UNIQUE
);

CREATE TABLE organicunit(
    organicUnitId SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE serviceName(
    serviceNameId SERIAL PRIMARY KEY,
    serviceNamePortuguese VARCHAR NOT NULL UNIQUE,
    serviceNameEnglish VARCHAR NOT NULL UNIQUE,
    description VARCHAR
);

CREATE TABLE organicService(
    organicServiceId SERIAL PRIMARY KEY,
    organicUnitId INTEGER REFERENCES organicunit(organicUnitId),
    serviceNameId INTEGER REFERENCES serviceName(serviceNameId)
);


CREATE TABLE event(
    eventId SERIAL PRIMARY KEY,
    requestStatus RequestStatus NOT NULL,
    requestType RequestTypes NOT NULL,
    eventNamePortuguese VARCHAR NOT NULL, -- TODO: fix unique when editing
    eventNameEnglish VARCHAR NOT NULL, -- TODO: fix unique when editing
    address VARCHAR,
    urlPortuguese VARCHAR,
    urlEnglish VARCHAR,
    emailTechnical VARCHAR NOT NULL,
    emailContact VARCHAR,
    dateCreated DATE NOT NULL,
    dateReviewed DATE,
    contactPerson VARCHAR,  
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    eventCanceled BOOLEAN NOT NULL DEFAULT FALSE,
    userId INTEGER REFERENCES users(userId),
    organicUnitId INTEGER REFERENCES organicunit(organicUnitId)
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



CREATE TABLE formation(
    roleId SERIAL PRIMARY KEY,
    roleType Roles NOT NULL,
    userId INTEGER REFERENCES users(userId),
    organicUnitId INTEGER REFERENCES organicunit(organicUnitId)
);



CREATE TABLE questions(
    questionsId SERIAL PRIMARY KEY,
    serviceNameId INTEGER REFERENCES serviceName(serviceNameId),
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
    serviceNameId INTEGER REFERENCES serviceName(serviceNameId),
    requestStatus RequestStatus NOT NULL,
    requestType RequestTypes NOT NULL,
    purpose VARCHAR,
    email VARCHAR,
    contactPerson VARCHAR,
    url VARCHAR,
    --version INTEGER DEFAULT 1,
    dateCreated  DATE NOT NULL,
    startDate DATE,--NOT NULL?
    endDate DATE,--NOT NULL?
    dateReviewed DATE,
    serviceTypeId INTEGER REFERENCES servicetype(serviceTypeId),
    userId INTEGER REFERENCES users(userId),
    organicUnitId INTEGER REFERENCES organicunit(organicUnitId)
);

/*
CREATE TABLE userservicerequest(
    serviceId INTEGER NOT NULL REFERENCES service(serviceId) ON DELETE CASCADE,
    userId INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE
);

CREATE TABLE usereventrequest(
    eventId INTEGER NOT NULL REFERENCES event(eventId) ON DELETE CASCADE,
    userId INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE
);*/


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


INSERT INTO users (username, name,isAdmin, email, password, userPhoto) VALUES ('admin','admin',TRUE,'admin@example.com','$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia','prettyphooto');
INSERT INTO users (username, name,isAdmin,email,password,userPhoto) VALUES('bicente','O GRANDE',FALSE,'henrique@gaio.com','$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia','prettyphooto');


-- USERS
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

INSERT INTO users (username, name,isAdmin,email,password,userPhoto) VALUES('userSwitch','User Switch',FALSE,'admin@example.com','$2y$10$X3VIs.iFuFuPoNBUn3yMW.FJ40dlZ/U11b14J0EZ/R3VdD1M81Fia','prettyphooto');



-- TAGS 
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('music','musica');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('art','arte');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('tecnology','tecnologia');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('sports','desporto');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('science','ciencia');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('literature','literatura');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('education','educacao');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('studentlife','vidadeestudate');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('nanotechnology','nanotecnologia');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('ecotourism','eco-turismo');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('cinematography','cinematografia');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('marketing','marketing');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('i3S','i3s');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('sustainability','sustentabilidade');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('finance','finanças');
INSERT INTO tag (tagNameEnglish,tagNamePortuguese) VALUES ('networking','networking');


--ORGANIC UNIT
INSERT INTO organicunit (name) VALUES ('FMDUP');--1
INSERT INTO organicunit (name) VALUES ('FMUP');--2
INSERT INTO organicunit (name) VALUES ('FPCE');--3
INSERT INTO organicunit (name) VALUES ('FAUP');--4
INSERT INTO organicunit (name) VALUES ('FCNAUP');--5
INSERT INTO organicunit (name) VALUES ('FCUP');--6
INSERT INTO organicunit (name) VALUES ('FEP');--7
INSERT INTO organicunit (name) VALUES ('FEUP');--8
INSERT INTO organicunit (name) VALUES ('FLUP');--9
INSERT INTO organicunit (name) VALUES ('ICBAS');--10
INSERT INTO organicunit (name) VALUES ('REITORIA');--11
INSERT INTO organicunit (name) VALUES ('CDUP');--12
INSERT INTO organicunit (name) VALUES ('FBAUP');--13
INSERT INTO organicunit (name) VALUES ('SASUP');--14
INSERT INTO organicunit (name) VALUES ('FPCEUP');--15
INSERT INTO organicunit (name) VALUES ('UPDIGITAL');--16
INSERT INTO organicunit (name) VALUES ('INEGI');--17
INSERT INTO organicunit (name) VALUES ('FADEUP');--18
INSERT INTO organicunit (name) VALUES ('FDUP');--19
INSERT INTO organicunit (name) VALUES ('UPORTO');--20

-- SERVICE NAME
INSERT INTO servicename (serviceNameEnglish,serviceNamePortuguese,description) VALUES ('HPC and Grid Computing','HPC e Grid Computing','HPC and Grid Computing is a service that deals with the management of the high performance computing infrastructure. Access to the service is restricted to certain departments of FEUP, FCUP and INEGI, requiring an authorization from the person in charge.');--FEUP, FCUP e INEGI
INSERT INTO servicename (serviceNameEnglish,serviceNamePortuguese,description) VALUES ('Virtual Machine','Máquina Virtual','Currently this resource is only available to the Faculty of Engineering.

The creation of virtual machines depends on the existence of hardware resources. The service is not intended for high performance computing.

It should be noted that:

Machines for teaching support are valid for one semester or one academic year;
The machines for project support are active until the end of the project;
Machine management and backup copies are the users responsibility;
Only open source or licensed software can be installed;
Access to Linux machines is by SSH key.');--
--INSERT INTO servicename (serviceNameEnglish,serviceNamePortuguese) VALUES ('HPC and Grid Computing','HPC e Grid Computing');


-- organicService
INSERT INTO organicService (serviceNameId, organicUnitId) VALUES (1, 8);
INSERT INTO organicService (serviceNameId, organicUnitId) VALUES (1, 6);
INSERT INTO organicService (serviceNameId, organicUnitId) VALUES (1, 17);

INSERT INTO organicService (serviceNameId, organicUnitId) VALUES (2, 8);



-- EVENT
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact, 
dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId )VALUES 
('Accepted', 'Create', 'Semana Internacional da FEP','FEP International Week', 'R. Dr. Roberto Frias, 4200-464 Porto', 
'https://sigarra.up.pt/fep/pt/web_base.gera_pagina?p_pagina=1031336','https://sigarra.up.pt/fep/pt/web_base.gera_pagina?p_pagina=1031336',
'up202006199@up.pt','rogerio@gmail.com','2022-01-01', '2022-03-10', 'Diogo Cruz', 'This initiative aims to make known the international mobility opportunities that the Faculty offers to its students.',
 '2022-11-28', '2022-11-30', FALSE,2,7);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Pending', 'Create', 'O IMPACTO DA POLUIÇÃO ATMOSFÉRICA E SONORA NA SAÚDE','THE IMPACT OF AIR AND NOISE POLLUTION ON HEALTH', 'Rua Doutor Plácido da Costa, 4200-450 Porto',
  'https://noticias.up.pt/fmup-e-cintesis-estudam-impacto-da-poluicao-atmosferica-e-sonora-na-saude/','https://noticias.up.pt/fmup-e-cintesis-estudam-impacto-da-poluicao-atmosferica-e-sonora-na-saude/', 
  'up202006199@up.pt','vasco@gmail.com','2023-03-15', NULL, 'João Vasco Santos', 'Know the socio-economic impact of environmental stressors in Europe.', '2023-05-01', '2023-05-31', FALSE,2,2);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Accepted', 'Create','O ADN da FEUP na tecnologia para reduzir os resíduos da indústria têxtil','FEUP DNA in technology for reducing textile industry waste', 'R. Dr. Roberto Frias, 4200-465 Porto', 
 'https://issuu.com/feup/docs/highlights_2022_final/26', 'https://issuu.com/feup/docs/highlights_2022_final/26',
 'up202006199@up.pt','antonio@gmail.com', '2023-02-01', '2023-02-11', ' António Rocha', 'A company in the textile sector that reduces waste by detecting fabric imperfections at an early stage in the production chain.', '2023-04-01', '2023-04-07', FALSE,3,8);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Accepted', 'Edit','O ADN da FEUP na tecnologia para reduzir os resíduos da indústria têxtil' ,'FEUP DNA in technology for reducing textile industry waste', 'R. Dr. Roberto Frias, 4200-465 Porto', 
 'https://issuu.com/feup/docs/highlights_2022_final/26','https://issuu.com/feup/docs/highlights_2022_final/26',
 'up202006199@up.pt','antonio@gmail.com', '2023-02-12', '2023-02-20', ' António Rocha', 'Alumni from U.Porto, are the founders of Smartex.ai, a company in the textile sector that reduces waste by detecting fabric imperfections at an early stage in the production chain.', '2023-04-01', '2023-04-07', FALSE,4,8);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Rejected', 'Create','Semana das Profissões: Engenheiro 2023', 'Profession Week: Engineer 2023', 'R. Dr. Roberto Frias, 4200-465 Porto', 
 'https://paginas.fe.up.pt/~escolas/spe/inscricoesspe23/','https://paginas.fe.up.pt/~escolas/spe/inscricoesspe23/',
 'up202006199@up.pt','rudolfo@gmail.com', '2023-01-01', '2023-01-02', 'Rudolfo Bruno', 'Event for high school students returns to FEUP campus on March 28th, 29th and 30th.', '2023-03-28', '2023-03-30', FALSE,4,8);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Accepted', 'Edit', 'Concerto de lançamento do álbum ''Something to Believe In'': Selo Porta-Jazz','Concert for the release of the album ''Something to Believe In'': Porta-Jazz Stamp', '890 Oak Street, Anytown USA', 
 'https://sigarra.up.pt/feup/pt/noticias_geral.ver_noticia?P_NR=147390','https://sigarra.up.pt/feup/pt/noticias_geral.ver_noticia?P_NR=147390',  
 'up202006199@up.pt','karen@gmail.com','2022-08-01', '2022-08-20', 'Karen Davis', 'O Comissariado Cultural da FEUP e o Porta-Jazz convidam a comunidade FEUP para o concerto de lançamento do disco "Something to Believe In", no Auditório José Marques dos Santos, a 15 de março, pelas 21h30.', '2022-11-01', '2022-11-01', FALSE,5,8);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact, 
dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
('Rejected', 'Archive', 'Leilão anual de beneficência','Annual Charity Auction', '789 Oak Lane, Anytown USA', 
'https://www.example.com/charity_auction','https://www.example.com/charity_auction',
'duarte@up.pt','sarah@gmail.com','2021-10-20', '2021-11-01', 'Sarah Johnson', 'Bid on unique items to support a great cause!', '2021-11-15', '2021-11-16', FALSE,5,11);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact, 
dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
('Pending', 'Create', 'A imunoterapia é eficaz em termos de custos no tratamento de crianças com asma alérgica aos ácaros do pó','Immunotherapy is cost-effective in treating children with dust mite allergic asthma', 'Rua das Taipas 135, 4050-600 Porto', 
'https://ispup.up.pt/en/immunotherapy-is-cost-effective-in-treating-children-with-dust-mite-allergic-asthma/', 'https://ispup.up.pt/en/immunotherapy-is-cost-effective-in-treating-children-with-dust-mite-allergic-asthma/',
'henrique@up.pt','emily@gmail.com', '2022-02-15', NULL, 'Emily Davis', 'An ISPUP research has concluded that immunotherapy is cost-effective in treating children with house dust mite-driven allergic asthma.', '2022-07-10', '2022-07-10', FALSE,5,14);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact,
 dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
 ('Pending', 'Create','ISPUP implementa projecto em Matosinhos para ajudar a prevenir a perda de memória' ,'ISPUP implements a project in Matosinhos to help prevent memory loss', 'Rua das Taipas 135, 4050-600 Porto', 
 'https://ispup.up.pt/en/ispup-implements-a-project-in-matosinhos-to-help-prevent-memory-loss/', 'https://ispup.up.pt/en/ispup-implements-a-project-in-matosinhos-to-help-prevent-memory-loss/',
'rudolfo@up.pt','emily@gmail.com','2023-02-15', NULL, 'Emilia David', 'The MIND-Matosinhos project aims to help prevent cognitive decline in the citizens of the municipality of Matosinhos. ', '2023-07-10', '2023-07-10', FALSE,6,14);
INSERT INTO event (requestStatus, requestType, eventNamePortuguese,eventNameEnglish, address, urlPortuguese,urlEnglish, emailTechnical,emailContact, 
dateCreated, dateReviewed, contactPerson, description, startDate, endDate, eventCanceled,userId,organicUnitId) VALUES 
('Pending', 'Create','Mais de 250 alunos participaram nos concursos do projecto AlergiaPT' ,'More than 250 students participated in the AlergiaPT project contests', 'Rua das Taipas 135, 4050-600 Porto', 
'https://ispup.up.pt/en/over-250-students-participated-in-the-alergiapt-project-contests/','https://ispup.up.pt/en/over-250-students-participated-in-the-alergiapt-project-contests/',
'jarope@up.pt','david@gmail.com','2022-02-15', NULL, 'David Emilia', 'The contests for the school community organised within the AlergiaPT project, promoted by ISPUP, counted with the participation of 253 primary, middle, and secondary school students from four districts of Portugal.', '2022-07-10', '2022-07-10', FALSE,7,14);

-----------------------------------------------------------------------------------------------------------------------------------------------


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
INSERT INTO questions (serviceNameId,question1,question2)
VALUES (1,'Department/Group','Supervisor Email:');

INSERT INTO questions (serviceNameId,question1,question2, question3, question4)
VALUES (2, 'CPU', 'RAM','Disk', 'Operating System');



--- SERVICE TYPE

INSERT INTO servicetype (questionsId,atribute1,atribute2) values (1,'FCUP','pedro.dinis@fc.up.pt');
INSERT INTO servicetype (questionsId,atribute1,atribute2,atribute3,atribute4) values (2,'RYZEN-5 6100','32GB','100G','Linux');


-- SERVICE

INSERT INTO service (serviceNameId,requestStatus,requestType,purpose,email,contactPerson,url,startDate,endDate,dateReviewed,serviceTypeId,userId,organicUnitId,dateCreated)
VALUES (1,'Pending', 'Create',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,2,6,'2023-04-20');


INSERT INTO service (serviceNameId,requestStatus,requestType,purpose,email,contactPerson,url,startDate,endDate,dateReviewed,serviceTypeId,userId,organicUnitId,dateCreated)
VALUES (2,'Pending', 'Create','For the 2nd year course LCOM','henrique@gaio.com',NULL,NULL,'2022-07-10','2023-07-10',NULL,2,2,8,'2023-04-20');