
DELETE FROM `subject`;
INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_description`) VALUES
	(1, 'Engineering', NULL),
	(2, 'Mathematics', 'Study of numbers, quantities, and shapes'),
	(3, 'Physics', 'Study of matter and energy'),
	(4, 'Computer Science', 'Study of algorithms, programming, and computation'),
	(5, 'History', 'Study of past events'),
	(6, 'Biology', 'Study of living organisms and their interactions'),
	(7, 'Literature', 'Study of written works, including novels and poems');

DELETE FROM `uploads`;
INSERT INTO `uploads` (`file_id`, `file_name`, `file_description`, `file_type`, `file_uploader`, `file_uploaded_on`, `file_uploaded_to`, `file`, `status`, `file_content`, `subject_id`) VALUES
	(110, 'Lorem sed amet solu', 'Error dolore neque u', 'txt', 'user', '2024-01-24 06:57:04', 'Computer Science', '645921.txt', 'approved', NULL, 5),
	(111, 'Payslip', 'Payslip', 'pdf', 'user', '2024-01-24 06:56:46', 'Computer Science', '610470.pdf', 'approved', NULL, 6),
	(112, 'Ea explicabo Rerum', 'Est voluptatem labor', 'docx', 'user', '2024-01-24 06:59:39', 'Computer Science', '169813.docx', 'approved', NULL, 6);

DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `name`, `about`, `role`, `email`, `token`, `gender`, `password`, `course`, `image`, `joindate`) VALUES
	(12, 'root', 'Abbas', 'Hensem asdasdasdasdasasdasdasd', 'admin', 'root@gmail.com', '', 'N/A', '$2y$10$UExd.f8vQXogrZELXF8KGulQJKUn32p8x4B5SVQ7V/D6.mrSAkAjW', 'Computer Science', '92992.jpg', '2000-01-01'),
	(18, 'user1', 'User 1', 'N/A', 'teacher', 'user1@gmail.com', '', 'Male', '$2y$10$LS76ATZ/jRN/M/pDAyfJmOkNI1MpF08T8NzjNcK.MZKpbjkeMKdMC', 'Electrical', '180812.jpg', 'July 19, 2017'),
	(19, 'user2', 'user2', 'i am user', 'student', 'user2@gmail.com', '', 'Female', '$2y$10$OCazXxzd6FM.V2afvmapqOGxVj8Gac3zN.2tlmuO1v1Y3103dqhti', 'Electrical', 'profile.jpg', 'July 19, 2017'),
	(20, 'user3', 'user3', 'N/A', 'teacher', 'user3@gmail.com', '', 'Male', '$2y$10$DEKxq9z1r8sWPSzj2XL7LOlT.cUWZv1EbTGZlrXO2VkiBbIuRfoBu', 'Computer Science', 'profile.jpg', 'July 19, 2017'),
	(21, 'student', 'student4', 'N/A', 'teacher', 'user4@gmai.com', '', 'Female', '$2y$10$8NTdzG/HXZq5d23o9IqteOY3vWZg75hC99tkuU60/ivcqiQ1sho6.', 'Computer Science', 'profile.jpg', 'July 19, 2017'),
	(22, 'teacher', 'teacher', 'N/A', 'teacher', 'teacher@bfbf.nncn', '', 'Male', '$2y$10$jAk4uQiBQ6b03EVZ0/9i1ucWdNFcVV1dXYj4X2f8uZ4Xd81hBkauG', 'Mechanical', '839669.jpg', 'July 19, 2017'),
	(23, 'teacher2', 'teacher2', 'N/A', 'teacher', 'teacher2hdh@n.fncn', '', 'Male', '$2y$10$rCjs9AHzUSVmITcRJJosgeUxJA5gJ7dZfY16ij/1xf9bzxmFAZzMq', 'Mechanical', '895979.jpg', 'July 19, 2017'),
	(24, 'user', 'Abbas 1', 'N/A', 'teacher', 'abbas@test.com', '', 'Male', '$2y$10$Z1H.ruYjbMSp07EhejzS0O1Fr7PgFdjqbWmtu7/j68TXr55gZ2Msu', 'Computer Science', '398505.jpg', 'July 19, 2017'),
	(25, 'anirban', 'Anirban', 'N/A', 'teacher', 'anirban.root@gmail.com', 'fbab3eec077a38d565e9c93442178b7d', 'Male', '$2y$10$h4i29DiU8zeLT7EOMLka3uTTCtAxtU.DAExBhywJF3SIRwpHq4wuG', 'Computer Science', '441172.jpg', 'July 20, 2017'),
	(27, 'user9', 'hfg gghh', 'N/A', 'teacher', 'ffhhgh@jjdj.vjjv', '', 'Male', '$2y$10$Z1hwjfIGjC8/Zv0NFy/BDO0W.A6K4ZAWLPrW8.himo7YAi0sC7Kjy', 'Computer Science', 'profile.jpg', 'July 22, 2017'),
	(28, 'qohijipa', 'Kirsten Riggs', 'N/A', 'teacher', 'abbas@gmail.com', '', 'Male', '$2y$10$VIGn9ZXz/TIDa1rL9F7LEuUr/NK4zN.BjXIlXQOWg3/yJMzM4GDeW', 'Computer Science', 'profile.jpg', 'January 13, 2024'),
	(29, 'ismiabbas', 'Abbas', 'N/A', 'teacher', 'abbas@test.com', '', 'Male', '$2y$10$tMQ0OQ0dilfPKMznwFP89eXe7DcQmhiEhukx4tEYES4ePO/2xJ/IW', 'Computer Science', 'profile.jpg', 'January 17, 2024');

DELETE FROM `user_note_list`;
DELETE FROM `videos`;
INSERT INTO `videos` (`video_id`, `video_name`, `video_description`, `url`, `status`, `file_uploader`, `subject_id`) VALUES
	(3, 'C++ in 100  132131', 'Simple C++ explanation 1231', 'https://www.youtube.com/watch?v=MNeX4EGtR5Y', 'pending', '24', 4);
