-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Readers
INSERT INTO Reader (user_name,first_name, last_name, e_mail, password, moderator) VALUES ('Loladin', 'Eka', 'Lukija', 'esi@merkki.fi', 'Kalle123', false);
INSERT INTO Reader (user_name,first_name, last_name, e_mail, password, moderator) VALUES ('Huntteri', 'Toka', 'Lukija', 'esi@merkki.fi', 'Kalle123', true);

-- Topics
INSERT INTO Topic (topic) VALUES ('Swing');
INSERT INTO Topic (topic) VALUES ('Random');

-- ReaderTopics
INSERT INTO ReaderTopic (reader_id, topic_id) VALUES (1,1);
INSERT INTO ReaderTopic (reader_id, topic_id) VALUES (2,1);
INSERT INTO ReaderTopic (reader_id, topic_id) VALUES (1,2);

-- Discussions
INSERT INTO Discussion (published, reader_id, topic, topic_id) VALUES (NOW(), 1, 'Tanssiminen on kivaa', 1);
INSERT INTO Discussion (published, reader_id, topic, topic_id) VALUES (NOW(), 2, 'Tanssiminen on tylsää', 2);

-- Comments
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Tämä kommentti aloittaa keskustelun', NOW(), 1, 1);
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Seuraava kommentti haukkuu keskustelun aloittajaa äidinn***ijaksi', NOW(), 1, 2);
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Kolmannessa kommentissa lukee eka', NOW(), 1, (SELECT id FROM reader WHERE user_name = 'Loladin'));
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Neljännessä kommenttisa yritetään vastata asiallisesti AP:n aloitukseen', NOW(), 1, (SELECT id FROM reader WHERE user_name = 'Huntteri'));
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Viides kommenttia mainitsee, lol, gay', NOW(), 1, (SELECT id FROM reader WHERE user_name = 'Huntteri'));

INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('Onpas tylsää', NOW(), (SELECT id FROM discussion WHERE topic = 'Tanssiminen on tylsää'), 1);
INSERT INTO Comment (comment, published, discussion_id, reader_id) VALUES ('No ei', NOW(), (SELECT id FROM discussion WHERE topic = 'Tanssiminen on tylsää'), 2);


