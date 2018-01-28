-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Readers
INSERT INTO Reader (first_name, last_name, e_mail, password) VALUES ('Alli', 'Huuppa', 'esi@merkki.fi', 'Kalle123');

-- Topics
INSERT INTO Topic (topic) VALUES ('Swing');

-- Discussions
INSERT INTO Discussion (published) VALUES (NOW());

-- Comments
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());

