INSERT INTO USERS (username, email, password, description, gender, typology, avatar) VALUES
('AdminMax', 'admin@unired.it', 'admin123', 'The absolute God', 'Male', 'admin', 'assets/avatar/avatar1.jpg'),
('Giulia_99', 'giulia@email.com', 'pass123', 'Coffee addict and book lover', 'Female', 'user', 'assets/avatar/avatar2.jpg'),
('LucaDev', 'luca@email.com', 'pass456', 'Full-stack developer and tech enthusiast', 'Male', 'user', NULL),
('SimoDesign', 'simo@email.com', 'pass789', 'Creative designer and visual artist', 'Non-binary', 'user', 'assets/avatar/avatar3.jpg'),
('MarcoTech', 'marco@email.com', 'pass321', 'AI researcher and data scientist', 'Male', 'user', 'assets/avatar/avatar4.jpg'),
('AnnaStudy', 'anna@email.com', 'pass654', 'Psychology student and mental health advocate', 'Female', 'user', 'assets/avatar/avatar5.jpg'),
('AlexGamer', 'alex@email.com', 'pass987', 'Gamer and streaming enthusiast', 'Male', 'user', NULL),
('SofiaArt', 'sofia@email.com', 'pass147', 'Digital artist and illustrator', 'Female', 'user', 'assets/avatar/avatar6.jpg');

INSERT INTO GROUPS (name, longdescription, avatar) VALUES
('Computer Science', 'Discussions about code, exams and technology', 'assets/avatar/avatar1.jpg'),
('Art', 'Free chat and memes', 'assets/avatar/avatar2.jpg'),
('Psychology', 'University textbook sales and exchanges', 'assets/avatar/avatar3.jpg'),
('Gaming', 'Video games, reviews and multiplayer sessions', 'assets/avatar/avatar4.jpg'),
('Music', 'Share your favorite songs and discover new artists', 'assets/avatar/avatar5.jpg'),
('Sports', 'All about sports, fitness and healthy lifestyle', 'assets/avatar/avatar6.jpg');

INSERT INTO PARTICIPANT (userId, groupId, subscriptionDate) VALUES
(1, 1, '2023-10-01'), 
(2, 1, '2023-10-02'), 
(2, 2, '2023-10-05'), 
(3, 1, '2023-10-06'), 
(4, 3, '2023-11-01'),
(5, 1, '2023-11-03'),
(5, 4, '2023-11-10'),
(6, 3, '2023-11-05'),
(6, 2, '2023-11-08'),
(7, 4, '2023-11-12'),
(7, 5, '2023-11-15'),
(8, 2, '2023-11-14'),
(8, 5, '2023-11-18'),
(1, 2, '2023-11-20'),
(3, 4, '2023-11-22');

INSERT INTO POSTS (title, longdescription, userId, groupId, postImage, upvote, downvote, postDate) VALUES
('Java Notes', 'Does anyone have the notes from yesterday\'s lecture?', 2, 1, 'assets/post/post1.jpg', 10, 2, '2023-11-01 10:00:00'),
('My Setup', 'Here\'s where I spend my nights programming.', 3, 1, 'assets/post/post2.jpg', 55, 0, '2023-11-01 14:30:00'),
('Check This Out!', 'Random photo found in my gallery.', 4, 2, 'assets/post/post3.jpg', 1423, 5, '2023-11-01 16:45:00'),
('Calculus Textbook', 'Selling textbook in like-new condition, contact me.', 2, 3, 'assets/post/post4.jpg', 100, 0, '2023-11-01 18:20:00'),
('Python vs JavaScript', 'Which one should I learn first as a beginner?', 5, 1, 'assets/post/post5.jpg', 23, 3, '2023-11-02 09:15:00'),
('Study Group', 'Looking for people to form a study group for the upcoming exam.', 6, 3, NULL, 15, 0, '2023-11-02 11:30:00'),
('New Game Release', 'Just tried the new RPG everyone\'s talking about. Worth it!', 7, 4, 'assets/post/post6.jpg', 42, 1, '2023-11-03 20:00:00'),
('Digital Portrait', 'My latest artwork, let me know what you think!', 8, 2, 'assets/post/post7.jpg', 67, 0, '2023-11-04 15:00:00'),
('Concert Tonight', 'Anyone going to the concert tonight? Let\'s meet up!', 8, 5, 'assets/post/post8.jpg', 6960, 0, '2023-11-05 17:30:00'),
('Database Tips', 'Sharing some SQL optimization tricks I learned.', 5, 1, NULL, 69, 1, '2023-11-06 10:45:00');

INSERT INTO COMMENTS (longdescription, userId, postId) VALUES
('Thanks so much, I needed these!', 3, 1), 
('Wow, beautiful setup!', 2, 2),      
('Is the price negotiable?', 4, 4),
('I think Python is easier to start with!', 2, 5),
('JavaScript has more job opportunities though', 3, 5),
('I\'m interested! When do you want to meet?', 2, 6),
('Count me in for the study group!', 5, 6),
('Already bought it, totally agree!', 5, 7),
('This is amazing! What software do you use?', 4, 8),
('Your art style is incredible!', 2, 8),
('I\'m going! See you there!', 7, 9),
('Super helpful tips, thanks for sharing!', 3, 10),
('Could you explain the indexing part more?', 6, 10);