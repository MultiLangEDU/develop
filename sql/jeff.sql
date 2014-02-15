/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : jeff

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-02-15 22:13:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('1', 'PHP', 'asdasdasdasdasd', '0000-00-00');
INSERT INTO `courses` VALUES ('2', 'MYSQL', '', '0000-00-00');
INSERT INTO `courses` VALUES ('3', 'JavaScript', '', '0000-00-00');
INSERT INTO `courses` VALUES ('4', 'Phyton', '', '0000-00-00');
INSERT INTO `courses` VALUES ('5', 'CSS', 'ASDASDASDAS', '0000-00-00');
INSERT INTO `courses` VALUES ('6', 'CodeIgniter', '', '0000-00-00');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `pass_reset_token` varchar(255) DEFAULT NULL,
  `activation_token` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test@test.com', '$2a$08$aZJQyzQ6cRsXifvA90wuqOcbT9GVuumSIlwlAU/0GgC79cvxy1U2C', '1', '', '', 'Arsen', 'Bagratyan', 'asd', 'Yerevan', '0018', 'Armenia', '09789', '2013-11-26');
INSERT INTO `users` VALUES ('2', 'test1@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', 'Addresssssssss', 'Yerevan', '0018', 'Armenia', '', '2013-11-26');
INSERT INTO `users` VALUES ('4', 'test3@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('5', 'test4@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('6', 'test5@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('7', 'test6@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('8', 'test7@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('9', 'test8@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('13', 'student@gmail.com', '$2a$08$ivKCjbiKpJOByY90xYfLke5nLKLJj1mEQADyQbFVA3QpyYJVCNHXO', '3', null, null, 'Student', 'Student', 'Address', 'Yerevan', '0018', 'Armenia', '64564765856875', '2014-02-15');
INSERT INTO `users` VALUES ('11', 'test8@test.com', '$2a$08$pfLxuHROODRBGl1FRB05WeOb55vPkMHUKuV9dqRaYHOPnfreBNqOu', '1', null, null, 'Arsen', 'Bagratyan', null, 'Yerevan', '0018', 'Armenia', null, '2013-11-26');
INSERT INTO `users` VALUES ('12', 'testik@test.com', '$2a$08$boOveVybHp2bc3WmzVnkp.a2GKqCZVybA.wL1kl8BOXc6/PYVhwmu', '1', null, null, 'testik', 'Test', 'Address', 'City', 'Zip', 'Country', 'Phone', '2014-02-15');

-- ----------------------------
-- Table structure for `users_types`
-- ----------------------------
DROP TABLE IF EXISTS `users_types`;
CREATE TABLE `users_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_types
-- ----------------------------
INSERT INTO `users_types` VALUES ('1', 'Admin');
INSERT INTO `users_types` VALUES ('2', 'Curric');
INSERT INTO `users_types` VALUES ('3', 'Student');
