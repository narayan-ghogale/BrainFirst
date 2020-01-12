-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 09:02 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainfirst`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_ans`
--

CREATE TABLE `assignment_ans` (
  `student_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `answer_path` varchar(1000) NOT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_ans`
--

INSERT INTO `assignment_ans` (`student_id`, `assignment_id`, `answer_path`, `grade`) VALUES
(3, 7, 'assignment_ans/7_3.pdf', 'A'),
(3, 8, 'assignment_ans/8_3.pdf', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_ques`
--

CREATE TABLE `assignment_ques` (
  `course_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `about_assignment` varchar(1000) NOT NULL,
  `question_path` varchar(1000) NOT NULL,
  `due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_ques`
--

INSERT INTO `assignment_ques` (`course_id`, `assignment_id`, `about_assignment`, `question_path`, `due_date`) VALUES
(8, 7, 'Searching Methods Assignment', 'assignment_ques/8_Searching_Methods_Assignment.pdf', '2018-10-11 16:30:00'),
(9, 8, 'Assignment1', 'assignment_ques/9_Assignment1.pdf', '2018-10-12 06:30:00'),
(9, 9, 'Assignment2', 'assignment_ques/9_Assignment2.pdf', '2018-10-20 18:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `about` varchar(1000) NOT NULL,
  `syllabus_path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `faculty_id`, `course_name`, `start_date`, `end_date`, `about`, `syllabus_path`) VALUES
(7, 3, 'Data Structures', '2018-10-01', '2018-10-31', 'This course will introduce the core data structures of the Python programming language. We will move past the basics of procedural programming and explore how we can use the Python built-in data structures such as lists, dictionaries, and tuples to perform increasingly complex data analysis.', ' syllabus/3_Data_Structures.pdf'),
(8, 3, 'Analysis of Algorithm', '2018-09-01', '2018-10-11', 'Learn Analysis of Algorithm using asymptotic notations like Big Oh and others. Understand and analyse sorting algorithms', ' syllabus/3_Analysis_of_Algorithm.pdf'),
(9, 3, 'ETHICAL HACKING', '2018-08-01', '2018-10-31', 'This course will train you on the advanced step-by-step methodologies that hackers actually use, such as writing virus codes, and reverse engineering, so you can better protect corporate infrastructure from data breaches. Youâ€™ll master advanced network packet analysis, securing web servers, malware threats, and advanced system penetration testing techniques to build your network security skillset and beat hackers at their own game.', ' syllabus/3_ETHICAL_HACKING.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `course_id` int(11) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`course_id`, `file_path`, `time`, `file_type`) VALUES
(8, 'content/8_1611011-(ADBMS-EXP3).pdf', '2018-10-11 16:12:21', 'Document'),
(8, 'content/8_movie.mp4', '2018-10-11 16:11:56', 'Video'),
(9, 'content/9_ETHICAL_HACKING.pdf', '2018-10-12 03:46:04', 'Document'),
(9, 'content/9_ETHICAL_HACKING_1.mp4', '2018-10-12 03:45:31', 'Video'),
(9, 'content/9_ETHICAL_HACKING_2.mp4', '2018-10-12 03:45:43', 'Video'),
(9, 'content/9_ETHICAL_HACKING_2.pdf', '2018-10-12 03:46:17', 'Document');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled`
--

CREATE TABLE `course_enrolled` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_enrolled`
--

INSERT INTO `course_enrolled` (`student_id`, `course_id`) VALUES
(1, 8),
(3, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `discussion_forum_ans`
--

CREATE TABLE `discussion_forum_ans` (
  `course_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion_forum_ans`
--

INSERT INTO `discussion_forum_ans` (`course_id`, `thread_id`, `user_type`, `id`, `answer`, `post_time`) VALUES
(8, 34, 'faculty', 3, 'Quick Sort has an average case time complexity of O(n logn) while selection sort has an average time of O(n^2).', '2018-10-11 16:29:14'),
(8, 34, 'student', 1, 'Everything is better than selection sort !!!', '2018-10-11 16:27:45'),
(9, 35, 'faculty', 3, 'Message repudiation means a sender can claim they did not actually send a particular message.A quality that prevents a third party from being able to prove that a communication between two other parties ever took place. This is a desirable quality if you do not want your communications to be traceable. Non-repudiation is the opposite quality-a third party can prove that a communication between two other parties took place. Non-repudiation is desirable if you want to be able to trace your communications and prove that they occurred. Repudiation - Denial of message submission or delivery.', '2018-10-12 03:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_forum_ques`
--

CREATE TABLE `discussion_forum_ques` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion_forum_ques`
--

INSERT INTO `discussion_forum_ques` (`course_id`, `student_id`, `thread_id`, `question`, `post_time`) VALUES
(8, 3, 34, 'How is quick sort better than selection sort ?', '2018-10-11 16:26:23'),
(9, 3, 35, 'To which concept in realm of email security does \"message repudiation\" refer to?', '2018-10-12 03:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_fname` varchar(50) NOT NULL,
  `faculty_lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `about_yourself` varchar(500) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_fname`, `faculty_lname`, `email`, `about_yourself`, `university`) VALUES
(2, 'XYZ', 'PQR', 'xyz@somaiya.edu', NULL, NULL),
(3, 'Harshal', 'Dedhia', 'harshal.ad@somaiya.edu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`email`, `password`, `usertype`) VALUES
('abc@somaiya.edu', 'abcd', 'student'),
('gandhi.hk@somaiya.edu', 'harsh', 'student'),
('harshal.ad@somaiya.edu', 'harshal', 'faculty'),
('narayan.ghogale@somaiya.edu', 'narayan', 'student'),
('xyz@somaiya.edu', '1234', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_ans`
--

CREATE TABLE `quiz_ans` (
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `ques_num` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_ans`
--

INSERT INTO `quiz_ans` (`student_id`, `quiz_id`, `ques_num`, `answer`) VALUES
(3, 2, 1, 'b'),
(3, 2, 2, 'b'),
(3, 2, 3, 'd'),
(3, 2, 4, 'c'),
(3, 2, 5, 'd'),
(3, 3, 1, 'c'),
(3, 3, 2, 'a'),
(3, 3, 3, 'a'),
(3, 3, 4, 'a'),
(3, 3, 5, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_grade`
--

CREATE TABLE `quiz_grade` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_grade`
--

INSERT INTO `quiz_grade` (`course_id`, `student_id`, `quiz_id`, `grade`) VALUES
(8, 3, 2, 'A'),
(9, 3, 3, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_info`
--

CREATE TABLE `quiz_info` (
  `quiz_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `start_timestamp` timestamp NULL DEFAULT NULL,
  `end_timestamp` timestamp NULL DEFAULT NULL,
  `about_quiz` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_info`
--

INSERT INTO `quiz_info` (`quiz_id`, `course_id`, `start_timestamp`, `end_timestamp`, `about_quiz`) VALUES
(2, 8, '2018-10-11 16:00:00', '2018-10-11 16:30:00', 'Sorting Analysis'),
(3, 9, '2018-10-12 04:00:00', '2018-10-12 04:30:00', 'Quiz 1');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_ques`
--

CREATE TABLE `quiz_ques` (
  `quiz_id` int(11) NOT NULL,
  `ques_num` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `option_a` varchar(50) NOT NULL,
  `option_b` varchar(50) NOT NULL,
  `option_c` varchar(50) NOT NULL,
  `option_d` varchar(50) NOT NULL,
  `correct_answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_ques`
--

INSERT INTO `quiz_ques` (`quiz_id`, `ques_num`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(2, 1, 'Time Complexity of Selection Sort', 'O(n^3)', 'O(n^2)', 'O(n logn)', 'O(n)', 'b'),
(2, 2, 'Time Complexity of Quick Sort', 'O(1)', 'O(n^2)', 'O(n logn)', 'O(n)', 'b'),
(2, 3, 'Time Complexity of Merge Sort', 'O(1)', 'O(n^2)', 'O(n)', 'O(n logn)', 'd'),
(2, 4, 'Best case time complexity of insertion sort', 'O(1)', 'O(n^2)', 'O(n)', 'O(n logn)', 'c'),
(2, 5, 'Which has the worst space complexity ?', 'Selection Sort', 'Quick Sort', 'Insertion Sort', 'Merge Sort', 'd'),
(3, 1, 'Which of the following is the default port for MySQL? ', '5432', '1433', '3306', '1521', 'c'),
(3, 2, 'Within HTTP, which header includes the URL of the web page containing the link that initiated the current request?', 'User-Agent', 'Referer', 'Post', 'Host', 'd'),
(3, 3, 'Precomputed hashes that are intended to contain every possible combination of characters for the purpose of comparing them against a captured password are known as which of the following?', 'Water Lillies', 'Dictionaries', 'Salt Mines', 'Rainbow Tables', 'd'),
(3, 4, 'Within Windows, which log class stores events from remote hosts?', 'Forwarded events log', 'System log', 'Remote log', 'Methods log', 'a'),
(3, 5, 'The default Time-To-Live (TTL) value for IP packets differs based on operating system. What is the default TTL value in Windows?', '32', '255', '128', '64', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_fname` varchar(50) NOT NULL,
  `student_lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `about_yourself` varchar(500) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_fname`, `student_lname`, `email`, `about_yourself`, `university`) VALUES
(1, 'ABC', 'DEF', 'abc@somaiya.edu', '', 'Mumbai University'),
(3, 'Harsh', 'Gandhi', 'gandhi.hk@somaiya.edu', NULL, NULL),
(4, 'Narayan', 'Ghogale', 'narayan.ghogale@somaiya.edu', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_ans`
--
ALTER TABLE `assignment_ans`
  ADD PRIMARY KEY (`student_id`,`assignment_id`),
  ADD KEY `assignment_ans_assignment_fk` (`assignment_id`);

--
-- Indexes for table `assignment_ques`
--
ALTER TABLE `assignment_ques`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `assignment_ques_course_fk` (`course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD UNIQUE KEY `faculty_id` (`faculty_id`,`course_name`),
  ADD KEY `course_faculty_fk` (`faculty_id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`file_path`),
  ADD KEY `course_content_course_id_fk` (`course_id`);

--
-- Indexes for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `enrolled_course_fk` (`course_id`);

--
-- Indexes for table `discussion_forum_ans`
--
ALTER TABLE `discussion_forum_ans`
  ADD PRIMARY KEY (`thread_id`,`user_type`,`id`);

--
-- Indexes for table `discussion_forum_ques`
--
ALTER TABLE `discussion_forum_ques`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `discussion_forum_ques_course_fk` (`course_id`),
  ADD KEY `discussion_forum_ques_student_fk` (`student_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `faculty_email_fk` (`email`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `quiz_ans`
--
ALTER TABLE `quiz_ans`
  ADD PRIMARY KEY (`student_id`,`quiz_id`,`ques_num`),
  ADD KEY `quiz_id_ques_num_fk` (`quiz_id`,`ques_num`);

--
-- Indexes for table `quiz_grade`
--
ALTER TABLE `quiz_grade`
  ADD PRIMARY KEY (`course_id`,`student_id`,`quiz_id`),
  ADD KEY `quiz_grade_student_fk` (`student_id`);

--
-- Indexes for table `quiz_info`
--
ALTER TABLE `quiz_info`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `course_id_fk` (`course_id`);

--
-- Indexes for table `quiz_ques`
--
ALTER TABLE `quiz_ques`
  ADD PRIMARY KEY (`quiz_id`,`ques_num`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_email_fk` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_ques`
--
ALTER TABLE `assignment_ques`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discussion_forum_ques`
--
ALTER TABLE `discussion_forum_ques`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_info`
--
ALTER TABLE `quiz_info`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_ans`
--
ALTER TABLE `assignment_ans`
  ADD CONSTRAINT `assignment_ans_assignment_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assignment_ques` (`assignment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assignment_ans_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assignment_ques`
--
ALTER TABLE `assignment_ques`
  ADD CONSTRAINT `assignment_ques_course_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_faculty_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course_content`
--
ALTER TABLE `course_content`
  ADD CONSTRAINT `course_content_course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  ADD CONSTRAINT `enrolled_course_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `enrolled_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `discussion_forum_ans`
--
ALTER TABLE `discussion_forum_ans`
  ADD CONSTRAINT `thread_id_fk` FOREIGN KEY (`thread_id`) REFERENCES `discussion_forum_ques` (`thread_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `discussion_forum_ques`
--
ALTER TABLE `discussion_forum_ques`
  ADD CONSTRAINT `discussion_forum_ques_course_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `discussion_forum_ques_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_email_fk` FOREIGN KEY (`email`) REFERENCES `login_info` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_ans`
--
ALTER TABLE `quiz_ans`
  ADD CONSTRAINT `quiz_ans_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiz_id_ques_num_fk` FOREIGN KEY (`quiz_id`,`ques_num`) REFERENCES `quiz_ques` (`quiz_id`, `ques_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_grade`
--
ALTER TABLE `quiz_grade`
  ADD CONSTRAINT `quiz_grade_course_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiz_grade_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_info`
--
ALTER TABLE `quiz_info`
  ADD CONSTRAINT `course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_ques`
--
ALTER TABLE `quiz_ques`
  ADD CONSTRAINT `quiz_info_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_info` (`quiz_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_email_fk` FOREIGN KEY (`email`) REFERENCES `login_info` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
