-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Reader(
  id SERIAL PRIMARY KEY,
  password varchar(50) NOT NULL,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  e_mail varchar(50) NOT NULL,
  moderator boolean DEFAULT FALSE
);

CREATE TABLE Topic(
  id SERIAL PRIMARY KEY,
  name varchar(50),
);

CREATE TABLE Discussion(
  id SERIAL PRIMARY KEY,
  reader_id INTEGER REFERENCES Player(id),
  topic_id INTEGER REFERENCES Topic(id),
  locked boolean DEFAULT FALSE,
  topic varchar(100),
  published DATE,
);

CREATE TABLE Comment(
  id SERIAL PRIMARY KEY,
  discussion_id INTEGER REFERENCES Discussion(id),
  reader_id INTEGER REFERENCES Reader(id),
  comment varchar(800),
  published DATE,
);

