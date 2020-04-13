-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2015 at 11:40 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saidhaf_projectsmgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_text`
--

CREATE TABLE IF NOT EXISTS `chat_text` (
  `ChatTextId` int(11) NOT NULL,
  `FromId` int(11) NOT NULL,
  `ToId` int(11) NOT NULL,
  `ChatText` text NOT NULL,
  `TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_text`
--

INSERT INTO `chat_text` (`ChatTextId`, `FromId`, `ToId`, `ChatText`, `TS`, `Status`) VALUES
(1, 6, 11, 'hjhj', '2015-07-27 04:51:36', 1),
(2, 6, 11, 'hjhj', '2015-07-27 04:52:07', 1),
(3, 6, 11, 'hjhj', '2015-07-27 04:52:22', 1),
(4, 6, 11, 'hjhj', '2015-07-27 04:52:23', 1),
(5, 6, 11, 'hjhj', '2015-07-27 04:52:44', 1),
(6, 6, 11, 'hjhj', '2015-07-27 04:52:45', 1),
(7, 6, 11, 'hjhj', '2015-07-27 04:54:15', 1),
(8, 6, 11, 'hjhj', '2015-07-27 04:55:37', 1),
(9, 6, 11, 'hjhj', '2015-07-27 04:55:38', 1),
(10, 6, 11, 'hjhj', '2015-07-27 04:55:38', 1),
(11, 6, 11, 'hjhj', '2015-07-27 04:55:39', 1),
(12, 6, 11, 'hjhj', '2015-07-27 04:56:01', 1),
(13, 6, 11, 'hjhj', '2015-07-27 04:56:02', 1),
(14, 6, 11, 'hjhj', '2015-07-27 05:08:26', 1),
(15, 6, 13, 'jkjk', '2015-07-27 05:11:35', 1),
(16, 6, 12, 'jkjk', '2015-07-27 05:11:41', 0),
(17, 6, 12, 'jkjkj', '2015-07-27 05:11:46', 0),
(18, 6, 12, 'aaaa', '2015-07-27 05:11:50', 0),
(19, 6, 12, 'aaaa', '2015-07-27 05:12:39', 0),
(20, 6, 13, 'aaaa', '2015-07-27 05:12:54', 1),
(21, 6, 13, 'bbbbb', '2015-07-27 05:13:03', 1),
(22, 6, 13, 'ccccc', '2015-07-27 05:13:14', 1),
(23, 6, 12, 'sdsdsd', '2015-07-27 05:14:04', 0),
(24, 6, 12, 'gfhfyhtyry', '2015-07-27 05:14:17', 0),
(25, 6, 12, 'aaaa', '2015-07-27 05:16:36', 0),
(26, 6, 13, 'dddddddddddddd', '2015-07-27 05:17:48', 1),
(27, 6, 11, 'aaa', '2015-07-27 05:31:59', 1),
(28, 6, 11, 'sdas', '2015-07-29 01:33:30', 1),
(29, 6, 12, 'aa', '2015-07-29 01:36:46', 0),
(30, 6, 16, 'hi\n', '2015-08-08 11:47:40', 0),
(31, 6, 18, 'hi\n', '2015-08-25 04:09:00', 1),
(32, 18, 6, 'hi\n', '2015-08-25 04:09:17', 1),
(33, 6, 22, 'vv', '2015-08-31 08:03:57', 1),
(34, 6, 22, 'vv', '2015-08-31 08:04:00', 1),
(35, 32, 6, 'hi\n', '2015-09-18 16:17:00', 1),
(36, 32, 6, 'i need smal help\n', '2015-09-18 16:17:04', 1),
(37, 6, 32, 'yes tell me\n', '2015-09-18 16:17:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `CommentId` int(11) NOT NULL,
  `ParentId` int(11) NOT NULL,
  `TaskId` int(11) NOT NULL,
  `CommentText` text NOT NULL,
  `CommentCreatedOn` datetime NOT NULL,
  `CommentCreatedBy` int(11) NOT NULL,
  `CommentAttachment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentId`, `ParentId`, `TaskId`, `CommentText`, `CommentCreatedOn`, `CommentCreatedBy`, `CommentAttachment`) VALUES
(1, 0, 2, 'bha problem che', '2015-09-18 11:11:57', 6, ''),
(2, 0, 2, 'done check kari lo pachi hu task complate karu', '2015-09-18 11:15:53', 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `ExpenseId` int(11) NOT NULL,
  `ExpenseTypeId` int(11) NOT NULL,
  `Expense_Desc` text NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `ExpenseBy` varchar(255) NOT NULL,
  `TransactionRef` varchar(255) NOT NULL,
  `PaymentTo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`ExpenseId`, `ExpenseTypeId`, `Expense_Desc`, `Amount`, `Date`, `ExpenseBy`, `TransactionRef`, `PaymentTo`) VALUES
(1, 1, 'Salary of month June', '2000', '2015-07-08', 'Axis Bank', 'ASIX1090909', 'Employe no 11'),
(2, 1, 'Salary of june month', '4000', '2015-07-07', 'Axis Bank', 'Axis2343242', 'Employee no 14'),
(3, 2, 'Purchased Stationary Item By Rohit Patel ', '350', '2015-08-05', 'Cash', '1032', 'Ambika Traders'),
(4, 2, 'Purchased Keybord and Mouse Combo', '450', '2015-05-12', 'Cash', 'FLK789789789', 'Flipkart COD'),
(5, 3, 'given on condition', '4000', '2015-08-05', 'Kotak Bank', '', 'Prashant  Patel'),
(6, 3, 'Purchase matirial', '1200', '2015-03-04', 'Cash', '', 'Asisk fashion');

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `ExpenseTypeId` int(11) NOT NULL,
  `ExpenseType` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`ExpenseTypeId`, `ExpenseType`) VALUES
(1, 'Sallary'),
(2, 'Office Expance'),
(3, 'Other Expance');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE IF NOT EXISTS `industry` (
  `IndustryId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`IndustryId`, `Name`, `Status`) VALUES
(10, 'IT', 1),
(11, 'NON IT', 1),
(12, 'ITs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `InvoiceId` int(11) NOT NULL,
  `InvoiceNo` varchar(255) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `From` varchar(255) NOT NULL,
  `ToAddress` text NOT NULL,
  `InvoiceDate` date NOT NULL,
  `IECode` varchar(255) NOT NULL,
  `SalesPerson` varchar(255) NOT NULL,
  `PONumber` varchar(255) NOT NULL,
  `ShippedVia` varchar(255) NOT NULL,
  `Currency` varchar(255) NOT NULL,
  `Terms` varchar(255) NOT NULL,
  `InvoiceDetails` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `DueDay` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`InvoiceId`, `InvoiceNo`, `ProjectId`, `From`, `ToAddress`, `InvoiceDate`, `IECode`, `SalesPerson`, `PONumber`, `ShippedVia`, `Currency`, `Terms`, `InvoiceDetails`, `Amount`, `DueDay`) VALUES
(1, '101', 30, 'VPN SOLUTION', 'chiledreach international', '2015-09-18', 'ica654321', 'manish', '654789', 'Internet', 'USD', 'one time', '[["20 blog posting","5","100"],["email designing","1","50"]]', 150, 4);

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE IF NOT EXISTS `lead` (
  `Id` int(11) NOT NULL,
  `Industry` varchar(255) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `ContactName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `SkypId` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `LandLine` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Area` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Zipcode` varchar(255) NOT NULL,
  `LeadSource` varchar(255) NOT NULL,
  `LeadStage` varchar(255) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` date NOT NULL,
  `LastVisitOn` date DEFAULT NULL,
  `NextVisitOn` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`Id`, `Industry`, `Company`, `Title`, `ContactName`, `Email`, `Website`, `SkypId`, `Mobile`, `LandLine`, `Address`, `Area`, `City`, `Zipcode`, `LeadSource`, `LeadStage`, `CreatedBy`, `CreatedOn`, `LastVisitOn`, `NextVisitOn`) VALUES
(1, '11', 'hhh', 'Director', 'jhhkhkh', 'aaa@aa.com', 'werr.gjhgj.hjk', 'raj', '1231231231', '1231321123', 'hkhhk', 'hj', 'hj', '2950036', 'Website', 'Proccessing', 6, '2015-08-28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msg_inbox`
--

CREATE TABLE IF NOT EXISTS `msg_inbox` (
  `InboxId` int(10) NOT NULL,
  `FromId` int(10) NOT NULL,
  `ToId` int(10) NOT NULL,
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Attachment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InboxStatus` int(1) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_inbox`
--

INSERT INTO `msg_inbox` (`InboxId`, `FromId`, `ToId`, `Subject`, `Message`, `Attachment`, `Date`, `InboxStatus`, `Type`) VALUES
(1, 6, 8, 'vfc', 'dfds', '', '2015-07-06 12:13:53', 1, 0),
(2, 6, 8, 'fgdd', 'dfds', '1436164484_Chrysanthemum.jpg|1436164484_Desert.jpg', '2015-07-06 12:13:37', 1, 0),
(4, 12, 11, 'For Project', 'hi....', '1436445313_Desert.jpg', '2015-07-13 05:53:27', 1, 0),
(5, 11, 10, 'testing purpose', 'lorem ispum lorem ispum lorem ispum lorem ispum lorem ispum', '1436762182_Tulips.jpg', '2015-07-13 04:36:22', 0, 0),
(6, 6, 10, 'asas', 'dfdsf', '1437548151_Chrysanthemum.jpg|1437548151_Desert.jpg', '2015-07-22 06:55:52', 0, 0),
(7, 6, 10, 'asas', 'dfdsf', '1437548164_Chrysanthemum.jpg|1437548164_Desert.jpg', '2015-07-22 06:56:04', 0, 0),
(8, 6, 11, 'asas', 'hgjghj', '1437548533_Desert.jpg', '2015-07-29 04:04:37', 1, 0),
(9, 6, 10, 'sdsd', 'sdsd', '1437548964_Chrysanthemum.jpg', '2015-07-22 07:09:24', 0, 0),
(10, 6, 10, 'aaaaaaaaaaaaaa', 'aaaaaaaaaaaa', '1437549053_Jellyfish.jpg', '2015-07-22 07:10:53', 0, 0),
(11, 6, 8, 'Re: hello', 'ghgh', '1437635038_Chrysanthemum.jpg', '2015-07-23 07:03:59', 0, 0),
(12, 6, 8, 'Re: hello', 'fdgfdgfg', '1437635073_Chrysanthemum.jpg', '2015-07-23 07:04:33', 0, 0),
(14, 6, 8, 'Re: hello', 'fgfgfg', '', '2015-07-23 07:15:32', 0, 0),
(15, 6, 11, 'Frd: hello', 'f', '|', '2015-07-29 04:04:22', 2, 0),
(18, 6, 18, 'test', 'test', '', '2015-08-25 03:58:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg_sentbox`
--

CREATE TABLE IF NOT EXISTS `msg_sentbox` (
  `SentboxId` int(10) NOT NULL,
  `FromId` int(10) NOT NULL,
  `ToId` int(10) NOT NULL,
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Attachment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SentboxStatus` int(1) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_sentbox`
--

INSERT INTO `msg_sentbox` (`SentboxId`, `FromId`, `ToId`, `Subject`, `Message`, `Attachment`, `Date`, `SentboxStatus`, `Type`) VALUES
(1, 6, 8, 'vfc', 'dfds', '', '2015-07-04 10:11:31', 0, 1),
(3, 8, 6, 'hello', 'f', '', '2015-07-06 10:31:41', 0, 1),
(4, 12, 11, 'For Project', 'hi....', '1436445313_Desert.jpg', '2015-07-09 12:36:36', 1, 1),
(5, 11, 10, 'testing purpose', 'lorem ispum lorem ispum lorem ispum lorem ispum lorem ispum', '1436762182_Tulips.jpg', '2015-07-13 04:36:22', 0, 1),
(6, 6, 10, 'asas', 'dfdsf', '1437548151_Chrysanthemum.jpg|1437548151_Desert.jpg', '2015-07-24 09:10:52', 1, 1),
(13, 6, 6, 'Frd: hello', 'f', '|', '2015-07-24 09:13:31', 1, 1),
(16, 11, 6, 'dsd', 'sdsd', '', '2015-07-23 08:41:42', 0, 1),
(17, 11, 6, 'aaaaaaaaaaa', 'aaaaaaaaaaaaaa', '', '2015-07-23 08:41:53', 0, 1),
(18, 6, 18, 'test', 'test', '', '2015-08-25 03:57:44', 0, 1),
(19, 22, 6, 'hhh', 'hhh', '', '2015-08-31 04:25:36', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `Id` int(11) NOT NULL,
  `leadId` int(11) NOT NULL,
  `CreatedBy` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`Id`, `leadId`, `CreatedBy`, `CreatedOn`, `Note`) VALUES
(1, 1, 'Manish Narola', '2015-08-28 11:04:41', 'vbvbvb'),
(2, 1, 'Manish Narola', '2015-08-28 11:04:44', 'vbbvbvb');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `description`, `created_date`, `modified_date`, `status`) VALUES
(1, 'hellos fgfgf\r\nfgfg', '2015-08-28 11:03:58', '2015-08-31 06:03:32', 1),
(4, 'Happy B''day VPN..\r\n\r\n', '2015-08-28 12:43:47', '0000-00-00 00:00:00', 1),
(5, 'well come navratri 2015', '2015-09-18 11:26:06', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `PayModeId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`PayModeId`, `Name`) VALUES
(1, 'Cash'),
(2, 'Axis Bank'),
(3, 'Kotak Bank'),
(4, 'Paypal');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `ProjectId` int(11) NOT NULL,
  `ProjectCategoryId` int(11) NOT NULL,
  `ProjectClientName` varchar(255) NOT NULL,
  `ProjectPriority` varchar(255) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `ProjectDesc` text NOT NULL,
  `ProjectAttachment` text NOT NULL,
  `EstimateTime` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `FinishDate` datetime DEFAULT NULL,
  `ProjectCreatedOn` datetime NOT NULL,
  `ProjectCreatedBy` int(11) NOT NULL,
  `ProjectAssignedTo` int(11) NOT NULL,
  `ProjectStage` varchar(255) NOT NULL,
  `ProjectStatus` int(11) DEFAULT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectId`, `ProjectCategoryId`, `ProjectClientName`, `ProjectPriority`, `ProjectName`, `ProjectDesc`, `ProjectAttachment`, `EstimateTime`, `StartDate`, `FinishDate`, `ProjectCreatedOn`, `ProjectCreatedBy`, `ProjectAssignedTo`, `ProjectStage`, `ProjectStatus`, `Note`) VALUES
(30, 8, 'Childreach International', 'High', 'Childreach', 'test test test --- ', '', 10, '2015-09-09 11:55:41', '2015-09-13 11:09:42', '2015-09-07 05:42:50', 6, 29, 'Under Analysis', 1, ''),
(31, 9, 'manish', 'High', 'vpn infotech', 'oakoasjf', '', 1, '2015-09-24 09:46:24', '2015-09-24 09:51:24', '2015-09-18 10:55:06', 6, 30, 'Requirment Collected', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `ProjectCategoryId` int(11) NOT NULL,
  `ProjectCategoryName` varchar(255) NOT NULL,
  `ProjectCategoryStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`ProjectCategoryId`, `ProjectCategoryName`, `ProjectCategoryStatus`) VALUES
(8, 'Management Support', 1),
(9, 'IT return', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qa`
--

CREATE TABLE IF NOT EXISTS `qa` (
  `qa_id` int(11) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `TaskId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `CommentCreatedOn` datetime NOT NULL,
  `ParentId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa`
--

INSERT INTO `qa` (`qa_id`, `ProjectId`, `TaskId`, `UserId`, `Comment`, `CommentCreatedOn`, `ParentId`) VALUES
(2, 10, 11, 15, 'fghgfhfghfgh', '0000-00-00 00:00:00', 0),
(3, 12, 12, 15, 'dfsfsdfsdfsfzzzzzzzzz', '0000-00-00 00:00:00', 0),
(4, 12, 12, 15, 'dfsfsdfsdfsf', '0000-00-00 00:00:00', 0),
(5, 12, 12, 15, 'dfsfsdfsdfsf', '0000-00-00 00:00:00', 0),
(6, 10, 11, 15, 'Tested', '0000-00-00 00:00:00', 0),
(7, 10, 11, 15, 'Tested', '0000-00-00 00:00:00', 0),
(8, 12, 12, 15, 'dfsfsdfsdfsf dfrwerwer', '0000-00-00 00:00:00', 0),
(9, 12, 12, 15, 'dfsfsdfsdfsf dfrwerwer', '0000-00-00 00:00:00', 0),
(11, 10, 11, 15, 'ABCDEFGHIJK', '2015-07-12 02:10:14', 0),
(15, 18, 43, 15, 'vbcgfcgdfgdfg', '2015-07-13 13:59:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
  `ReceiptId` int(11) NOT NULL,
  `InvoiceNo` varchar(255) NOT NULL,
  `PayBy` varchar(255) NOT NULL,
  `TransactionRef` varchar(255) NOT NULL,
  `AccName` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Currency` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `ReceiptDate` date NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`ReceiptId`, `InvoiceNo`, `PayBy`, `TransactionRef`, `AccName`, `Amount`, `Currency`, `Status`, `ReceiptDate`, `Note`) VALUES
(1, '101', 'Cash', '3003231', 'dfsdfsdfs', 100, 'USD', '0', '2015-08-11', 'no comment'),
(2, '103', 'Cash', 'sds', 'ddf', 400, 'USD', '0', '2015-08-05', 'sds'),
(3, '101', 'Axis Bank', 'asdsa', 'ffdf', 80, 'USD', '0', '2015-08-05', 'dsf'),
(4, '102', 'Kotak Bank', 'rewr', 'fgd', 1000, 'USD', '0', '2015-08-19', 'gfdg');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `RoleId` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL,
  `RoleStatus` int(11) NOT NULL DEFAULT '1',
  `TabAccess` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleId`, `RoleName`, `RoleStatus`, `TabAccess`) VALUES
(1, 'Admin', 1, ''),
(2, 'Project Manager', 1, 'Projects|Add Project|Edit Project|Update Project Status|Add User|Add Designation|Edit Designation|Project Categories|Add Project Category|Edit Project Category|Task Sheet|Add Task|Edit Task|Delete Task|Employee Chat|Email|QA Sheet'),
(5, 'Tester', 1, 'QA Sheet|Add QA|Edit QA|Delete QA'),
(6, 'Marketing executive', 1, 'Manage Lead'),
(7, 'BDM', 1, 'Projects|Add Project|Edit Project|Update Project Status|Edit Project Category|Task Sheet|Add Task|Edit Task|Employee Chat|Email|Manage Lead'),
(8, 'Team Leader', 1, 'Projects|Edit Project|Update Project Status|Edit User|Task Sheet|Add Task|Edit Task|Delete Task|Employee Chat|Email'),
(10, 'Sr. PHP Developer', 1, 'Update Project Status|Task Sheet|Add Task|Edit Task|Employee Chat|Email'),
(11, 'Web Designer', 1, 'Update Project Status|Task Sheet|Add Task|Edit Task'),
(12, 'Jr.PHP Developer', 1, 'Task Sheet|Employee Chat|Email'),
(13, 'SEO Exucative ', 1, 'Update Project Status|Task Sheet|Add Task|Edit Task'),
(14, 'PSD Designer', 1, ''),
(17, 'Account manager', 1, 'Projects|Update Project Status|Task Sheet|Add Task|Edit Task|Employee Chat|Email'),
(18, 'VAT manager', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `TaskId` int(11) NOT NULL,
  `TaskNo` varchar(255) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `TaskPriority` varchar(255) NOT NULL,
  `TaskName` varchar(255) NOT NULL,
  `TaskDesc` text NOT NULL,
  `TaskAttachment` text NOT NULL,
  `TaskAssignedBy` int(11) NOT NULL,
  `TaskAssignedOn` datetime NOT NULL,
  `TaskEstimateTime` int(11) NOT NULL DEFAULT '0',
  `TaskFinishTime` int(11) NOT NULL,
  `TaskStatus` varchar(255) NOT NULL,
  `TaskPercentage` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskId`, `TaskNo`, `ProjectId`, `UserId`, `TaskPriority`, `TaskName`, `TaskDesc`, `TaskAttachment`, `TaskAssignedBy`, `TaskAssignedOn`, `TaskEstimateTime`, `TaskFinishTime`, `TaskStatus`, `TaskPercentage`) VALUES
(1, 'AA0001', 30, 30, 'High', 'I t return ', 'Y', '', 6, '2015-09-16 12:26:02', 12, 0, 'Pending', 0),
(2, 'AA0002', 31, 32, 'High', 'recipt banglore send', 'today urgutn', '', 6, '2015-09-18 11:01:15', 1, 1, 'In Progress', 100),
(3, 'AA0003', 30, 32, 'Medium', 'data collection', 'anc', '', 6, '2015-09-18 11:01:51', 16, 0, 'Pending', 0),
(4, 'AA0004', 30, 30, 'High', 'I T Return of lalitbhai- file no. 383', 'for IDBI bank account opening purpose', '', 6, '2015-10-02 00:26:58', 8, 0, 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Avtar` varchar(255) NOT NULL,
  `UserCreatedOn` datetime NOT NULL,
  `UserStatus` int(11) NOT NULL DEFAULT '0',
  `LastLogin` datetime NOT NULL,
  `LastAccess` datetime NOT NULL,
  `LoginStatus` int(11) NOT NULL DEFAULT '0',
  `TypingStatus` int(11) NOT NULL DEFAULT '0',
  `ActivationCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `RoleId`, `UserName`, `Password`, `Name`, `Gender`, `Address`, `Email`, `Phone`, `Avtar`, `UserCreatedOn`, `UserStatus`, `LastLogin`, `LastAccess`, `LoginStatus`, `TypingStatus`, `ActivationCode`) VALUES
(6, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Said Hafiz', 'male', 'London', 's.hafiz@aimitc.com', '07956925407', '22dc75bf4f77ee525563d9c45b368c1d.jpg', '2015-07-08 00:00:00', 1, '2015-10-02 00:15:25', '2015-10-02 00:29:30', 1, 0, '248366'),
(30, 17, 'Ashish123', 'a15f2c0ef7b4bd3c06bfc0ea172a6e78', 'Ashish', 'male', 'T', '', '', '', '2015-09-16 12:22:24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, NULL),
(31, 6, 'Nikunj123', 'a2b7639b928c80376f1c2da45778ba88', 'Nikunj', 'male', 'T', '', '', '', '2015-09-16 12:24:37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, NULL),
(32, 17, 'vkvpn', 'ae6054d34f65c26d56e5b0c1636d838f', 'vishal', 'male', 'sdsaf', 'manish@gmail.com', '66565', '', '2015-09-18 10:59:27', 1, '2015-09-18 11:12:57', '2015-09-18 11:21:40', 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_text`
--
ALTER TABLE `chat_text`
  ADD PRIMARY KEY (`ChatTextId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentId`), ADD KEY `TaskId` (`TaskId`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ExpenseId`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`ExpenseTypeId`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`IndustryId`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceId`), ADD KEY `ProjectId` (`ProjectId`);

--
-- Indexes for table `lead`
--
ALTER TABLE `lead`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `msg_inbox`
--
ALTER TABLE `msg_inbox`
  ADD PRIMARY KEY (`InboxId`);

--
-- Indexes for table `msg_sentbox`
--
ALTER TABLE `msg_sentbox`
  ADD PRIMARY KEY (`SentboxId`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`PayModeId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ProjectId`), ADD KEY `ProjectCategoryId` (`ProjectCategoryId`), ADD KEY `ProjectStageId` (`ProjectStage`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`ProjectCategoryId`);

--
-- Indexes for table `qa`
--
ALTER TABLE `qa`
  ADD PRIMARY KEY (`qa_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`ReceiptId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskId`), ADD KEY `ProjectId` (`ProjectId`), ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`), ADD KEY `RoleId` (`RoleId`), ADD KEY `UserName` (`UserName`), ADD KEY `Password` (`Password`), ADD KEY `LoginStatus` (`LoginStatus`), ADD KEY `UserStatus` (`UserStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_text`
--
ALTER TABLE `chat_text`
  MODIFY `ChatTextId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ExpenseId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `ExpenseTypeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `IndustryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `msg_inbox`
--
ALTER TABLE `msg_inbox`
  MODIFY `InboxId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `msg_sentbox`
--
ALTER TABLE `msg_sentbox`
  MODIFY `SentboxId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `PayModeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ProjectId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `ProjectCategoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `qa`
--
ALTER TABLE `qa`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `ReceiptId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`TaskId`) REFERENCES `task` (`TaskId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`ProjectId`) REFERENCES `project` (`ProjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`ProjectCategoryId`) REFERENCES `project_category` (`ProjectCategoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`ProjectId`) REFERENCES `project` (`ProjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleId`) REFERENCES `role` (`RoleId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
