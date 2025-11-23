INSERT INTO USERS (username, email, password, gender, typology, avatar) VALUES
('AdminMax', 'admin@unired.it', 'admin123', 'Uomo', 'admin', 'assets/post/icon.jpg'),
('Giulia_99', 'giulia@email.com', 'pass123', 'Donna', 'utente', 'assets/post/piopio.PNG'),
('LucaDev', 'luca@email.com', 'pass456', 'Uomo', 'utente', NULL),
('SimoDesign', 'simo@email.com', 'pass789', 'Non-binary', 'utente', 'assets/post/icon.jpg');

-- INSERIMENTO GRUPPI
INSERT INTO GROUPS (name, longdescription, avatar) VALUES
('Informatica', 'Discussioni su codice, esami e tecnologia', 'assets/post/post3.jpg'),
('Arte', 'Chacchiere in libertà e meme', 'assets/post/piopio.PNG'),
('Psicologia', 'Vendita e scambio libri universitari', 'assets/post/post1.jpg');

-- INSERIMENTO PARTECIPANTI (Chi segue quali gruppi)
INSERT INTO PARTICIPANT (userId, groupId, subscriptionDate) VALUES
(1, 1, '2023-10-01'), -- Admin segue Informatica
(2, 1, '2023-10-02'), -- Giulia segue Informatica
(2, 2, '2023-10-05'), -- Giulia segue Arte
(3, 1, '2023-10-06'), -- Luca segue Informatica
(4, 3, '2023-11-01'); -- Simo segue Psicologia

-- INSERIMENTO POST
-- Qui collego le immagini esatte che vedo nella tua cartella: post1.jpg, post2.jpg, ecc.
INSERT INTO POSTS (title, longdescription, userId, groupId, postImage, upvote, downvote) VALUES
('Appunti di Java', 'Qualcuno ha gli appunti della lezione di ieri?', 2, 1, 'assets/post/post1.jpg', 10, 2),
('Il mio setup', 'Ecco dove passo le mie nottate a programmare.', 3, 1, 'assets/post/post2.jpg', 55, 0),
('Guardate questo!', 'Foto random trovata in galleria.', 4, 2, 'assets/post/piopio.PNG', 12, 5),
('Libro di Analisi', 'Vendo libro come nuovo, contattatemi.', 2, 3, 'assets/post/post3.jpg', 0, 0);

-- INSERIMENTO COMMENTI
INSERT INTO COMMENTS (longdescription, userId, postId) VALUES
('Grazie mille, mi servivano!', 3, 1), -- Luca commenta il post di Giulia
('Wow, bellissimo setup!', 2, 2),      -- Giulia commenta il post di Luca
('Prezzo trattabile?', 4, 4);          -- Simo commenta il libro