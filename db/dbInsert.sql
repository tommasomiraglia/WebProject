INSERT INTO USERS (username, email, password, description , gender, typology, avatar) VALUES
('AdminMax', 'admin@unired.it', 'admin123','The absolute God' , 'Uomo', 'admin', 'assets/avatar/avatar1.jpg'),
('Giulia_99', 'giulia@email.com', 'pass123','Piopio', 'Donna', 'utente', 'assets/avatar/avatar2.jpg'),
('LucaDev', 'luca@email.com', 'pass456', 'Piopio', 'Uomo', 'utente', NULL),
('SimoDesign', 'simo@email.com', 'pass789', 'Piopio', 'Non-binary', 'utente', 'assets/avatar/avatar3.jpg');

INSERT INTO GROUPS (name, longdescription, avatar) VALUES
('Informatica', 'Discussioni su codice, esami e tecnologia', 'assets/avatar/avatar1.jpg'),
('Arte', 'Chacchiere in libertà e meme', 'assets/avatar/avatar2.jpg'),
('Psicologia', 'Vendita e scambio libri universitari', 'assets/avatar/avatar3.jpg');

INSERT INTO PARTICIPANT (userId, groupId, subscriptionDate) VALUES
(1, 1, '2023-10-01'), 
(2, 1, '2023-10-02'), 
(2, 2, '2023-10-05'), 
(3, 1, '2023-10-06'), 
(4, 3, '2023-11-01'); 

INSERT INTO POSTS (title, longdescription, userId, groupId, postImage, upvote, downvote) VALUES
('Appunti di Java', 'Qualcuno ha gli appunti della lezione di ieri?', 2, 1, 'assets/post/post1.jpg', 10, 2, '2023-11-01 10:00:00'),
('Il mio setup', 'Ecco dove passo le mie nottate a programmare.', 3, 1, 'assets/post/post2.jpg', 55, 0, '2023-11-01 10:00:00'),
('Guardate questo!', 'Foto random trovata in galleria.', 4, 2, 'assets/post/post3.jpg', 1, 5, '2023-11-01 10:00:00'),
('Libro di Analisi', 'Vendo libro come nuovo, contattatemi.', 2, 3, 'assets/post/post4.jpg', 100, 0, '2023-11-01 10:00:00');

INSERT INTO COMMENTS (longdescription, userId, postId) VALUES
('Grazie mille, mi servivano!', 3, 1), 
('Wow, bellissimo setup!', 2, 2),      
('Prezzo trattabile?', 4, 4);          