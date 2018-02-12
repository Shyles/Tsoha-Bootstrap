-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Readers
INSERT INTO Reader (user_name,first_name, last_name, e_mail, password, moderator) VALUES ('Loladin', 'Eka', 'Lukija', 'esi@merkki.fi', 'Kalle123', false);
INSERT INTO Reader (user_name,first_name, last_name, e_mail, password, moderator) VALUES ('Huntteri', 'Toka', 'Lukija', 'esi@merkki.fi', 'Kalle123', true);

-- Topics
INSERT INTO Topic (topic) VALUES ('Swing');

-- Discussions
INSERT INTO Discussion (published, reader_id, topic) VALUES (NOW(), (SELECT id FROM reader WHERE user_name = 'loladin'), 'Testiaihe');

-- Comments
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());
INSERT INTO Comment (comment, published) VALUES ('lorem ipsum popsum possuseni ptrui ptrui', NOW());


