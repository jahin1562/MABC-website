-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 02:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mabc_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `member_id`, `member_name`, `answer`, `created_at`) VALUES
(1, 2, 0, 'jahin', 'sfdwsdcfqawesfd', '2026-07-02 08:23:29'),
(3, 2, 0, 'rubab', 'wergfwefwefwe', '2026-07-02 08:27:12'),
(5, 2, 0, 'rubab', 'terhtrhetheth', '2026-07-05 17:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `show_on_home` tinyint(1) DEFAULT 0,
  `category` varchar(50) DEFAULT 'book',
  `type` varchar(50) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `writer`, `img_url`, `description`, `link`, `show_on_home`, `category`, `type`, `subject`, `year`) VALUES
(5, 'Real Analysis', 'hafizur', 'uploads/6a4a6e7548bf4.png', '', '', 1, 'book', 'book', 'math', NULL),
(6, 'Ordinary Differention', 'hafizur', 'uploads/6a4a6e442d20a.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset\'s Body Type sheets. It has survived not only many decades, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised thanks to these sheets and more recently with desktop publishing software like Aldus PageMaker and Microsoft Word including versions of Lorem Ipsum.', '', 1, 'book', 'book', 'math', NULL),
(7, 'Numarical Analysis', 'Elias', 'uploads/6a4a6e05c24c9.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset\'s Body Type sheets. It has survived not only many decades, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised thanks to these sheets and more recently with desktop publishing software like Aldus PageMaker and Microsoft Word including versions of Lorem Ipsum.', '', 1, 'book', 'book', 'math', NULL),
(8, 'Fortan proggrame', 'hafizur', 'uploads/6a4a6dd6e07cd.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset\'s Body Type sheets. It has survived not only many decades, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised thanks to these sheets and more recently with desktop publishing software like Aldus PageMaker and Microsoft Word including versions of Lorem Ipsum.', '', 1, 'book', 'book', 'math', NULL),
(9, 'CALCULAS II', 'hafizur', 'uploads/6a4a6d03c6316.png', '', '', 1, 'book', 'book', 'math', NULL),
(11, 'Abstrac Alzabra', 'hafizur', 'uploads/6a4a75ea46290.png', '', 'https://www.facebook.com/gbcmathfamily', 1, 'book', 'book', 'bangla', NULL),
(13, 'math Question', '', 'uploads/6a4bcff8dbca0.webp', '', '', 0, 'book', 'question', 'math', '2nd');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) DEFAULT NULL,
  `registration_start` date DEFAULT NULL,
  `registration_deadline` date DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `show_on_home` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `time`, `registration_start`, `registration_deadline`, `place`, `img_url`, `description`, `show_on_home`) VALUES
(5, 'ইফতার মাহফিল ২০২৫', '2025-07-05', '08:59', '2025-05-06', '2025-05-25', 'Government bangla college', 'uploads/6a4c9e7ed02c1.jpeg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1),
(6, 'চড়ুইভাতি ২০২৬', '2026-07-05', '17:07', '2026-06-25', '2026-07-01', 'Government bangla college', 'uploads/6a4c9d87d9c73.jpeg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1),
(8, 'অনুশীলন ম্যাচ ২০২৬', '0000-00-00', '', '0000-00-00', '0000-00-00', '', 'uploads/6a4a7d2581cea.jpeg', '???? অনুশীলন ম্যাচ ২০২৬ ????\n???? তারিখ: ০৭ মে ২০২৬, বৃহস্পতিবার।\n⏰ সময়: দুপুর ১:০০ টা\n???? স্থান: কলেজ মাঠ\n⚽ খেলাধুলার মাধ্যমে দক্ষতা ও ঐক্য গড়ে তুলি ⚽\n???? সবাইকে উপস্থিত থাকার জন্য আমন্ত্রণ জানানো হলো', 1),
(9, 'টাউ দিবসের শুভেচ্ছা', '2026-05-04', '19:08', '2025-07-07', '2025-08-08', 'asfasdvsdgfvwsdrgvb', 'uploads/6a4a7cbfdf639.jpeg', 'টাউ দিবসের শুভেচ্ছা\n২৮/০৬/২০২৬ রবিবার, টাউ (৬.২৮) দিবস উপলক্ষে কুইজ প্রতিযোগিতা ও বিজয় র‍্যালি আয়োজন করা হয়েছে। উক্ত আয়োজন কে সাফল্য মণ্ডিত করার জন্য আপনারা সকলেই আমন্ত্রিত।\n\nসময়সূচি:\n⏰ কুইজ : সকাল ১১:৩১ মিনিট।\n⏰ র‍্যালি : দুপুর ১২:১৫ মিনিট।\n???? তারিখ: ২৮শে জুন, ২০২৬ (রবিবার)', 1),
(10, 'Bandarban Department Tour 2026', '2026-08-21', '08:21', '2026-08-01', '2026-08-15', 'Bandorban', 'uploads/6a4b5f2416c00.webp', 'আমাদের ডিপার্টমেন্টের শিক্ষার্থীদের জন্য আয়োজন করা হয়েছে একটি রোমাঞ্চকর Bandarban Educational & Refreshment Tour 2026। পাহাড়, মেঘ, ঝর্ণা ও প্রকৃতির অপরূপ সৌন্দর্যের মাঝে একসাথে স্মরণীয় কিছু মুহূর্ত কাটানোর এটাই হতে পারে বছরের সেরা সুযোগ।\n???? Tour Highlights\nনীলাচল\nনীলগিরি\nচিম্বুক পাহাড়\nশৈলপ্রপাত\nস্বর্ণ মন্দির\nমেঘলা পর্যটন কেন্দ্র\nগ্রুপ ফটোগ্রাফি, সাংস্কৃতিক আড্ডা ও বিভিন্ন বিনোদনমূলক কার্যক্রম\n???? Important Notes\nনিবন্ধন সম্পন্ন হলেই আপনার আসন নিশ্চিত হবে।\nসীমিত সংখ্যক আসন উপলব্ধ, তাই আগে নিবন্ধন করলে অগ্রাধিকার দেওয়া হবে।\nভ্রমণের বিস্তারিত সময়সূচি, যাতায়াত, আবাসন ও অন্যান্য তথ্য নিবন্ধন শেষে জানিয়ে দেওয়া হবে।\nসকল অংশগ্রহণকারীকে নির্ধারিত সময় মেনে উপস্থিত থাকতে হবে এবং ট্যুরের সকল নিয়ম অনুসরণ করতে হবে।\n\n✨ চলুন, একসাথে পাহাড়ের সৌন্দর্য উপভোগ করি এবং ডিপার্টমেন্টের বন্ধুদের সঙ্গে তৈরি করি সারাজীবনের স্মৃতি।', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `show_on_home` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `img_url`, `show_on_home`) VALUES
(7, 'Invitation ', 'uploads/6a4b587e3c9a2.jpeg', 1),
(8, 'Group Photo', 'uploads/6a4b5885a93b4.jpeg', 1),
(9, 'prize money', 'uploads/6a4b588a75b97.jpeg', 1),
(11, 'Wining celebration', 'uploads/6a4b5896aed38.jpeg', 1),
(12, 'taw dibos group photo', 'uploads/6a4b589f4801d.jpeg', 1),
(13, 'Raly Udjapon', 'uploads/6a4b58a53e7c6.jpeg', 1),
(14, 'Enjoy wining', 'uploads/6a4b58aa0b444.jpeg', 0),
(15, 'Taw dibos', 'uploads/6a4b58ae7b2fe.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

CREATE TABLE `guest_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_url` varchar(255) DEFAULT 'assets/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest_users`
--

INSERT INTO `guest_users` (`id`, `name`, `age`, `blood_group`, `institute`, `department`, `phone`, `email`, `created_at`, `username`, `password`, `img_url`) VALUES
(1, 'Bankim', 22, '0+', 'GBC', 'math', 'aqscasc', 'asadc', '2026-07-02 07:36:36', 'bankim', '111', 'uploads/6a46155b5720a.png'),
(2, 'Rubab Abedden', 22, '0', 'GBC', 'math', '01518938681', 'hasinanjumjahin1@gmail.com', '2026-07-02 08:01:01', 'rubab', '111', 'uploads/1782979261_IMG-20260411-WA1535.jpg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `show_on_home` tinyint(1) DEFAULT 0,
  `institute` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `serial` int(11) DEFAULT 99
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `username`, `password`, `title`, `department`, `year`, `blood_group`, `religion`, `email`, `phone`, `address`, `about_us`, `type`, `img_url`, `show_on_home`, `institute`, `skills`, `serial`) VALUES
(1, 'Hasin Anjum Jahin', 'jahin', '111', 'member', 'math', '22-23', '0+', 'islam', 'hasinanjumjahin1@gmail.com', '01518938681', 'Niribili Housing, Sonkor', 'I Am Developer', 'committee', 'uploads/6a45011a883e2.png', 1, 'GBC', NULL, 5),
(2, ' Nahid Hasan', ' Nahid', '111', 'member', 'math', '', '', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6c8446096.jpeg', 1, 'GBC', NULL, 99),
(3, ' Rakibul Hasan', ' rakibul', '111', 'member', 'math', '', '', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6c49e000e.jpeg', 1, 'GBC', NULL, 3),
(4, ' Atik Hasan', 'atik', '111', 'member', 'math', '', '', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6c09c950e.jpeg', 1, 'GBC', NULL, 4),
(6, ' Md Shamim', 'shamim', '111', 'Secretary', 'math', '22-23', '', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6b3d39130.jpeg', 1, 'GBC', NULL, 2),
(7, ' Md. Injamamul Haque', 'injamamul', '111', 'Member', 'math', '22-23', 'A+', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6a71e2852.jpeg', 1, 'GBC', NULL, 99),
(8, ' Ibrahim Al Arafat', 'arafat', '111', 'member', 'math', '22-23', '0+', 'islam', '', '', '', '', 'committee', 'uploads/6a4a6a102c58f.jpeg', 1, 'GBC', '', 99),
(9, 'Md Rokon', 'rokon', '111', 'president', 'math', '', '', 'islam', '', '', '', '', 'committee', 'uploads/6a4a69b2c70f2.jpeg', 1, 'GBC', 'web development', 1),
(10, 'Tanvir Ahmmed Tarek', 'tanvir', '111', 'Running Member', 'math', '22-23', '0+', 'islam', 'hasinanjumjahin1@gmail.com', '01518938681', 'Niribili Housing, Sonkor', '', 'running', 'uploads/6a4a6926daba7.jpeg', 1, 'GBC', '', 99),
(11, ' Prosanjit Gain', 'gain', '111', 'Teacher', 'math', '', '', '', '', '', '', '', 'teacher', 'uploads/6a4b646751798.jpeg', 1, 'GBC', NULL, 1),
(12, ' Rasel Bhuiyan', 'rasel', '111', 'EX- president', '', '', '', '', '', '', '', '', 'past', 'uploads/6a4bc450c3037.jpeg', 1, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT 0,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `date`, `description`, `is_urgent`, `img`) VALUES
(6, 'গণিত বিভাগ বনাম ফিন্যান্স বিভাগ ⚽', '2026-07-06', 'গণিত বিভাগ বনাম ফিন্যান্স বিভাগ ⚽????\nকোয়ার্টার ফাইনাল-এর মহাযুদ্ধ! আমাদের প্রিয় গণিত বিভাগ প্রস্তুত। বিজয় নিশ্চিত করতে মাঠে এসে দলের মনোবল বাড়ান এবং সমর্থন করুন। আমাদের টিমের জন্য সবার দোয়া কাম্য। ❤️????\n???? ভেন্যু: বাঙলা কলেজ কেন্দ্রীয় মাঠ।\n???? সময়: ০৫ জুলাই, ২০২৬, দুপুর ২:০০ টা', 1, NULL),
(7, 'প্রকাশিত হলো ', '2026-02-05', 'প্রকাশিত হলো \"টাউ দিবস-২০২৬\" কুইজ প্রতিযোগিতার চূড়ান্ত ফলাফল! সকল বিজয়ীদের অভিনন্দন। চড়ুইভাতির দিন উপস্থিত থেকে আপনাদের পুরস্কার গ্রহণ করার জন্য বিশেষভাবে বলা হলো', 1, NULL),
(8, 'কোয়ার্টার ফাইনালে গণিত বিভাগ!', '2026-04-14', 'আলহামদুলিল্লাহ কোয়ার্টার ফাইনালে গণিত বিভাগ! ⚽????\nআন্তঃবিভাগ ফুটবল টুর্নামেন্ট ২০২৬-এর রোমাঞ্চকর ম্যাচে প্রাণিবিজ্ঞান বিভাগকে ১-০ গোলে হারিয়ে আমরা গণিত বিভাগ কোয়ার্টার ফাইনাল নিশ্চিত করেছি! টিমের সকল প্লেয়ারদের অসাধারণ নৈপুণ্য এবং দর্শকদের দারুণ সাপোর্টে আজকের জয়টি ছিল দুর্দান্ত। শোয়াইব আকন্দ নিশাতের দারুণ শট থেকে গোলটি পূর্ণ করেন আমাদের সুপার সাব ফজলুর রহমান বাবু।\nআমাদের প্রতি ভালোবাসা ও সমর্থন অব্যাহত রাখার জন্য সবার প্রতি কৃতজ্ঞতা। আগামী ম্যাচগুলোর জন্য সবাই আমাদের টিমের জন্য দোয়া করবেন। আলহামদুলিল্লাহ!', 1, 'uploads/6a4cc314a3218.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `question` text NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `member_id`, `member_name`, `department`, `institute`, `question`, `photo_url`, `created_at`) VALUES
(1, 0, NULL, 'General', NULL, 'whats;s your name ', '', '2026-07-02 08:07:56'),
(2, 0, 'jahin', 'Bangla', NULL, 'erfgaergawerg', '', '2026-07-02 08:23:06'),
(3, 0, 'rubab', 'Physics', NULL, 'efwefqwefweFWQEF', '', '2026-07-02 13:08:20'),
(4, 0, 'rubab', 'Math', NULL, 'ergfer', '', '2026-07-02 13:55:47'),
(5, 0, 'jahin', 'Math', NULL, 'asfsdcsdac', '', '2026-07-02 14:06:29'),
(6, 0, 'jarif', 'Bangla', NULL, 'rthertherth', '', '2026-07-02 14:06:47'),
(7, 0, 'ifty', 'ICT', NULL, 'regawergrweg', '', '2026-07-02 14:23:10'),
(8, 0, 'rubab', 'ICT', NULL, 'tynrtyjrthrsth', '', '2026-07-05 17:29:12'),
(9, 0, 'jahin', 'Math', 'GBC', 'wefwefwefw', '', '2026-07-06 15:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `img_url`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(2, 'ত্রিভুজের ৩ কোনের সমষ্টি কত?', '', '১৮০', '১৬০', '২০০', '৩৬০', 'a'),
(4, 'পৃথিবীতে বাঙলা ভাষার অবস্থান কত তম?', '', '৫', '৪', '৬', '২', 'b'),
(5, 'বাঙলা কলেজ কত সালে প্রতিষ্ঠিত', '', '১৯৬২', '১৯৭১', '২০২৬', '১৯৯৯', 'a'),
(6, 'জাতীয় ফলের নাম কি ?', '', 'আম', 'কাঁঠাল', 'বাঙ্গি', 'পেয়ারা', 'b'),
(7, 'জাতীয় পাখির নাম কি ?', '', 'দোয়েল', 'কোয়েল', 'ময়না', 'টিয়া', 'a'),
(8, 'নিচের কোনটি vowel নয়?', NULL, 'a', 'e', 'i', 'f', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT 'N/A',
  `institute` varchar(255) DEFAULT 'N/A',
  `score` int(11) NOT NULL,
  `time_taken` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `member_id`, `member_name`, `department`, `institute`, `score`, `time_taken`, `created_at`) VALUES
(80, 9, 'Md Rokon', 'math', 'Gbc', 2, 6, '2026-07-06 09:51:35'),
(91, 10, 'Tanvir Ahmmed Tarek', 'math', 'GBC', 1, 7, '2026-07-06 14:36:36'),
(92, 1, 'Hasin Anjum Jahin', 'math', 'GBC', 1, 9, '2026-07-06 14:39:47'),
(94, 0, 'Rubab Abedden', 'math', 'GBC', 3, 8, '2026-07-06 14:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `p` text DEFAULT NULL,
  `show_on_home` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `img_url`, `h1`, `p`, `show_on_home`) VALUES
(3, 'uploads/6a4a22e1c490b.jpeg', '', '', 1),
(4, 'uploads/6a4a80febd296.jpeg', '', '', 1),
(5, 'uploads/6a4c9d2388e41.jpeg', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('promotion','birthday') NOT NULL,
  `msg` text NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `show_on_home` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`id`, `name`, `title`, `type`, `msg`, `img_url`, `show_on_home`) VALUES
(1, 'Hasin Anjum Jahin', 'member', 'birthday', 'congratulation', 'uploads/6a4522a542b88.png', 1),
(2, 'Shamim Mia', 'Sectery', 'promotion', 'Congratultin for your success', 'uploads/6a4bc5337d05b.jpeg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_users`
--
ALTER TABLE `guest_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guest_users`
--
ALTER TABLE `guest_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
