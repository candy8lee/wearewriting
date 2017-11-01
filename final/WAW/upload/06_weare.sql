-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-11-01 10:59:50
-- 伺服器版本: 10.1.25-MariaDB
-- PHP 版本： 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `06_weare`
--

-- --------------------------------------------------------

--
-- 資料表結構 `about`
--

CREATE TABLE `about` (
  `pageID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `acts`
--

CREATE TABLE `acts` (
  `actID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `start` varchar(255) NOT NULL,
  `happy_end` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `acts`
--

INSERT INTO `acts` (`actID`, `title`, `content`, `start`, `happy_end`, `createdDate`, `updatedDate`) VALUES
(2, '活動二', '活動二', '2017-09-11', '2017-09-28', '2017-08-15', NULL),
(3, '活動三', '<p>活動3</p>', '2017-10-03', '2017-10-11', '17-10-30 18:32:35', '17-10-30 18:40:22');

-- --------------------------------------------------------

--
-- 資料表結構 `boards`
--

CREATE TABLE `boards` (
  `boardsID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdDate` varchar(255) NOT NULL,
  `membetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `boards_reply`
--

CREATE TABLE `boards_reply` (
  `boardsID` int(11) NOT NULL,
  `boards_replyID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `brand`
--

CREATE TABLE `brand` (
  `brandID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `nation` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `brand`
--

INSERT INTO `brand` (`brandID`, `logo`, `name`, `content`, `nation`, `createdDate`, `updatedDate`, `author`) VALUES
(8, 'Robert Oster20171101101351.png', 'Robert Oster', '<p>Robert Oster</p>', 'United States', '17-11-01 10:13:37', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `industry`
--

CREATE TABLE `industry` (
  `industryID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `industry`
--

INSERT INTO `industry` (`industryID`, `title`, `content`, `class`, `createdDate`, `updatedDate`, `author`) VALUES
(2, '造紙', '<p>造紙</p>', '造紙', '17-11-01 11:01:37', NULL, 'admin'),
(3, '印刷', '<p>印刷</p>', '印刷業', '17-11-01 11:30:32', NULL, 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `makeawish`
--

CREATE TABLE `makeawish` (
  `wishID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `makeawish`
--

INSERT INTO `makeawish` (`wishID`, `title`, `content`, `createdDate`, `updatedDate`, `author`, `status`) VALUES
(1, '球', '球', '2017-10-15', NULL, 'admin', 0),
(2, '球0', '球', '2017-10-15', NULL, 'admin', 0),
(3, '球1', '球', '2017-10-16', NULL, 'admin', 1),
(4, '球2', '球', '2017-10-17', '17-11-01 13:52:25', 'admin', 2),
(5, '球3', '球', '2017-10-18', NULL, 'admin', 3),
(6, '球80', '球', '2017-10-19', NULL, 'admin', 80),
(7, '球99', '球', '2017-10-11', NULL, 'admin', 99),
(8, '球', '球', '2017-10-31', NULL, 'admin', 0),
(9, '球', '球', '2017-10-31', NULL, 'admin', 0),
(10, '球', '球', '2017-10-31', NULL, 'admin', 0),
(11, '球', '球', '2017-10-31', NULL, 'admin', 0),
(12, '球', '球', '2017-10-31', NULL, 'admin', 0),
(13, '球', '球', '2017-10-31', NULL, 'admin', 0),
(14, '球', '球', '2017-10-31', NULL, 'admin', 0),
(15, '球', '球', '2017-10-31', NULL, 'admin', 0),
(16, '球', '球', '2017-10-31', NULL, 'admin', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `brithday` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`memberID`, `account`, `password`, `name`, `picture`, `phone`, `brithday`, `email`, `address`, `createdDate`, `updatedDate`) VALUES
(13, 'test1', 'test1', 'test1', 'test120171101161411.jpg', 'test1', 'test1', 'test1@1', 'test1', NULL, NULL),
(14, 'test2', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL),
(15, 'test3', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL),
(16, 'test4', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL),
(18, 'test6', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL),
(19, 'test7', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL),
(20, 'test8', 'test1', NULL, NULL, NULL, NULL, '', 'test1', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `member_question`
--

CREATE TABLE `member_question` (
  `questionID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdDate` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `member_reply`
--

CREATE TABLE `member_reply` (
  `replyID` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `createdDate` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `nation`
--

CREATE TABLE `nation` (
  `nationID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_cht` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `createdDate` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `nation`
--

INSERT INTO `nation` (`nationID`, `name`, `name_cht`, `area`, `createdDate`, `author`) VALUES
(1, 'United States', '美國', '美洲', '', ''),
(2, 'United Kingdom', '英國', '歐洲', '17-10-31 23:01:58', 'admin'),
(3, 'France', '法國', '歐洲', '17-10-31 23:02:27', 'admin'),
(4, 'China', '中國大陸', '亞洲', '17-10-31 23:02:58', 'admin'),
(5, 'Japan', '日本', '亞洲', '17-10-31 23:03:25', 'admin'),
(6, 'Germany', '德國', '歐洲', '17-10-31 23:06:56', 'admin'),
(7, 'Australia', '澳洲', '大洋洲', '17-11-01 00:48:33', 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publishedDate` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `news`
--

INSERT INTO `news` (`newsID`, `title`, `content`, `publishedDate`, `createdDate`, `updatedDate`) VALUES
(29, 'We Are Writing NEW OPEN!', '<p>HELLO EVERYONE. LET\'S PARTY RIGHT NOW!</p>', '2017-10-31', '17-10-31 17:46:45', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `orderNO` varchar(255) NOT NULL,
  `orderDate` varchar(255) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `order_details`
--

CREATE TABLE `order_details` (
  `order_detailsID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cateID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `postscript` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `subcategoryID` int(11) DEFAULT NULL,
  `brandID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL,
  `picture4` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `nib` varchar(255) DEFAULT NULL,
  `remain` varchar(255) NOT NULL,
  `decription` text NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `store` int(11) NOT NULL DEFAULT '0',
  `sold` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `product_category`
--

CREATE TABLE `product_category` (
  `categoryID` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product_category`
--

INSERT INTO `product_category` (`categoryID`, `category`, `picture`, `createdDate`, `updatedDate`, `author`) VALUES
(11, '鋼筆', NULL, '2017-11-01', NULL, 'admin'),
(12, '墨水', NULL, '2017-11-01', NULL, 'admin'),
(14, '信紙/信封', NULL, '2017-11-01', NULL, 'admin'),
(15, '鉛筆', NULL, '2017-11-01', NULL, 'admin'),
(16, '原子筆', NULL, '2017-11-01', NULL, 'admin'),
(17, '套裝', NULL, '2017-11-01', NULL, 'admin'),
(19, '福袋', NULL, '17-11-01 17:31:17', NULL, '');

-- --------------------------------------------------------

--
-- 資料表結構 `product_subcategory`
--

CREATE TABLE `product_subcategory` (
  `subcategoryID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product_subcategory`
--

INSERT INTO `product_subcategory` (`subcategoryID`, `categoryID`, `subcategory`, `picture`, `createdDate`, `updatedDate`, `author`) VALUES
(1, 11, '沾水筆', NULL, '2017-11-01', NULL, 'admin'),
(2, 11, '按壓墨囊', NULL, '2017-11-01', NULL, 'admin'),
(3, 11, '旋轉上墨', NULL, '2017-11-01', NULL, 'admin'),
(4, 12, '瓶裝', NULL, '2017-11-01', NULL, 'admin'),
(5, 12, '分裝', NULL, '2017-11-01', NULL, 'admin'),
(6, 12, '卡水', NULL, '2017-11-01', NULL, 'admin'),
(7, 12, '福袋', NULL, '2017-11-01', NULL, 'admin'),
(8, 12, '玻璃空瓶', NULL, '2017-11-01', NULL, 'admin'),
(9, 13, '經典', NULL, '2017-11-01', NULL, 'admin'),
(10, 13, '膠裝', NULL, '2017-11-01', NULL, 'admin'),
(11, 13, '線裝', NULL, '2017-11-01', NULL, 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `q_a_category`
--

CREATE TABLE `q_a_category` (
  `categoryID` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `q_a_category`
--

INSERT INTO `q_a_category` (`categoryID`, `category`, `picture`, `createdDate`, `updatedDate`) VALUES
(7, '購物流程', NULL, '17-10-31 15:39:48', NULL),
(8, '帳戶變更', NULL, '17-10-31 15:42:36', NULL),
(9, '訂單相關', NULL, '17-10-31 15:42:48', NULL),
(11, '個資法', NULL, '17-10-31 16:02:07', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `q_a_reply`
--

CREATE TABLE `q_a_reply` (
  `replyID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `reply` text NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `q_a_reply`
--

INSERT INTO `q_a_reply` (`replyID`, `title`, `categoryID`, `reply`, `createdDate`, `updatedDate`, `author`) VALUES
(19, '購物流程1', 7, '<p>購物流程1</p>', '17-10-31 17:08:13', '17-10-31 17:44:22', 'admin'),
(20, '購物流程2', 7, '<p>購物流程2</p>', '17-10-31 17:08:29', NULL, 'admin'),
(21, '帳戶變更1', 8, '<p>帳戶變更1</p>', '17-10-31 17:08:43', NULL, 'admin'),
(22, '帳戶變更1', 8, '<p>帳戶變更1</p>', '17-10-31 17:08:56', NULL, 'admin'),
(23, '訂單相關1', 9, '<p>訂單相關1</p>', '17-10-31 17:09:04', NULL, 'admin'),
(24, '訂單相關2', 9, '<p>訂單相關2</p>', '17-10-31 17:09:16', NULL, 'admin'),
(25, '個資法1', 11, '<p>個資法1</p>', '17-10-31 17:09:29', NULL, 'admin'),
(26, '個資法2', 11, '<p>個資法2</p>', '17-10-31 17:09:40', NULL, 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`userID`, `account`, `password`, `createdDate`) VALUES
(2, 'admin', 'admmin', '2017-10-27');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`pageID`);

--
-- 資料表索引 `acts`
--
ALTER TABLE `acts`
  ADD PRIMARY KEY (`actID`);

--
-- 資料表索引 `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`boardsID`);

--
-- 資料表索引 `boards_reply`
--
ALTER TABLE `boards_reply`
  ADD PRIMARY KEY (`boards_replyID`);

--
-- 資料表索引 `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- 資料表索引 `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`industryID`);

--
-- 資料表索引 `makeawish`
--
ALTER TABLE `makeawish`
  ADD PRIMARY KEY (`wishID`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- 資料表索引 `member_question`
--
ALTER TABLE `member_question`
  ADD PRIMARY KEY (`questionID`);

--
-- 資料表索引 `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`nationID`);

--
-- 資料表索引 `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`);

--
-- 資料表索引 `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detailsID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- 資料表索引 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- 資料表索引 `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD PRIMARY KEY (`subcategoryID`);

--
-- 資料表索引 `q_a_category`
--
ALTER TABLE `q_a_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- 資料表索引 `q_a_reply`
--
ALTER TABLE `q_a_reply`
  ADD PRIMARY KEY (`replyID`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `about`
--
ALTER TABLE `about`
  MODIFY `pageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `acts`
--
ALTER TABLE `acts`
  MODIFY `actID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `boards`
--
ALTER TABLE `boards`
  MODIFY `boardsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `boards_reply`
--
ALTER TABLE `boards_reply`
  MODIFY `boards_replyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用資料表 AUTO_INCREMENT `industry`
--
ALTER TABLE `industry`
  MODIFY `industryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `makeawish`
--
ALTER TABLE `makeawish`
  MODIFY `wishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用資料表 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- 使用資料表 AUTO_INCREMENT `member_question`
--
ALTER TABLE `member_question`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `nation`
--
ALTER TABLE `nation`
  MODIFY `nationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用資料表 AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 使用資料表 AUTO_INCREMENT `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用資料表 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用資料表 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- 使用資料表 AUTO_INCREMENT `product_category`
--
ALTER TABLE `product_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用資料表 AUTO_INCREMENT `product_subcategory`
--
ALTER TABLE `product_subcategory`
  MODIFY `subcategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `q_a_category`
--
ALTER TABLE `q_a_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `q_a_reply`
--
ALTER TABLE `q_a_reply`
  MODIFY `replyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
