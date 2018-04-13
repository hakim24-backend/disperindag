/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL_LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100130
 Source Host           : localhost:3306
 Source Schema         : mail_roundcube_disperindag

 Target Server Type    : MySQL
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 14/03/2018 12:09:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `cache_key` varchar(128) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `created` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `expires` datetime(0) NULL DEFAULT NULL,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `expires_index`(`expires`) USING BTREE,
  INDEX `user_cache_index`(`user_id`, `cache_key`) USING BTREE,
  CONSTRAINT `user_id_fk_cache` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cache_index
-- ----------------------------
DROP TABLE IF EXISTS `cache_index`;
CREATE TABLE `cache_index`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `mailbox` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `expires` datetime(0) NULL DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 0,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`user_id`, `mailbox`) USING BTREE,
  INDEX `expires_index`(`expires`) USING BTREE,
  CONSTRAINT `user_id_fk_cache_index` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cache_messages
-- ----------------------------
DROP TABLE IF EXISTS `cache_messages`;
CREATE TABLE `cache_messages`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `mailbox` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `expires` datetime(0) NULL DEFAULT NULL,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`, `mailbox`, `uid`) USING BTREE,
  INDEX `expires_index`(`expires`) USING BTREE,
  CONSTRAINT `user_id_fk_cache_messages` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cache_shared
-- ----------------------------
DROP TABLE IF EXISTS `cache_shared`;
CREATE TABLE `cache_shared`  (
  `cache_key` varchar(255) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `created` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `expires` datetime(0) NULL DEFAULT NULL,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `expires_index`(`expires`) USING BTREE,
  INDEX `cache_key_index`(`cache_key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cache_thread
-- ----------------------------
DROP TABLE IF EXISTS `cache_thread`;
CREATE TABLE `cache_thread`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `mailbox` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `expires` datetime(0) NULL DEFAULT NULL,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`user_id`, `mailbox`) USING BTREE,
  INDEX `expires_index`(`expires`) USING BTREE,
  CONSTRAINT `user_id_fk_cache_thread` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for contactgroupmembers
-- ----------------------------
DROP TABLE IF EXISTS `contactgroupmembers`;
CREATE TABLE `contactgroupmembers`  (
  `contactgroup_id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `created` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`contactgroup_id`, `contact_id`) USING BTREE,
  INDEX `contactgroupmembers_contact_index`(`contact_id`) USING BTREE,
  CONSTRAINT `contact_id_fk_contacts` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contactgroup_id_fk_contactgroups` FOREIGN KEY (`contactgroup_id`) REFERENCES `contactgroups` (`contactgroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for contactgroups
-- ----------------------------
DROP TABLE IF EXISTS `contactgroups`;
CREATE TABLE `contactgroups`  (
  `contactgroup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `changed` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `del` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`contactgroup_id`) USING BTREE,
  INDEX `contactgroups_user_index`(`user_id`, `del`) USING BTREE,
  CONSTRAINT `user_id_fk_contactgroups` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `changed` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `del` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `surname` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `vcard` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `words` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`contact_id`) USING BTREE,
  INDEX `user_contacts_index`(`user_id`, `del`) USING BTREE,
  CONSTRAINT `user_id_fk_contacts` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for dictionary
-- ----------------------------
DROP TABLE IF EXISTS `dictionary`;
CREATE TABLE `dictionary`  (
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `language` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  UNIQUE INDEX `uniqueness`(`user_id`, `language`) USING BTREE,
  CONSTRAINT `user_id_fk_dictionary` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for identities
-- ----------------------------
DROP TABLE IF EXISTS `identities`;
CREATE TABLE `identities`  (
  `identity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `changed` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `del` tinyint(1) NOT NULL DEFAULT 0,
  `standard` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `organization` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reply-to` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bcc` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `signature` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `html_signature` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`identity_id`) USING BTREE,
  INDEX `user_identities_index`(`user_id`, `del`) USING BTREE,
  INDEX `email_identities_index`(`email`, `del`) USING BTREE,
  CONSTRAINT `user_id_fk_identities` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of identities
-- ----------------------------
INSERT INTO `identities` VALUES (1, 1, '2017-03-15 09:18:50', 0, 1, '', '', 'rahmat@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (2, 2, '2017-03-15 09:26:34', 0, 1, '', '', 'arya@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (3, 3, '2017-03-15 10:04:15', 0, 1, '', '', 'bari@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (4, 4, '2017-03-16 14:35:16', 0, 1, '', '', 'ruben@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (5, 5, '2017-03-29 12:27:52', 0, 1, '', '', 'rahmatheruka@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (6, 6, '2017-03-30 14:09:59', 0, 1, '', '', 'matt@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (7, 7, '2017-05-17 10:23:15', 0, 1, '', '', 'adedwi@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (8, 8, '2017-05-23 10:04:45', 0, 1, '', '', 'rosyid78@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (9, 9, '2017-05-26 15:16:40', 0, 1, '', '', 'rahmatheruka@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (10, 10, '2017-05-26 15:22:46', 0, 1, '', '', 'yasin@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (11, 11, '2017-09-26 16:50:08', 0, 1, '', '', 'heruka@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (12, 12, '2017-10-27 16:13:55', 0, 1, '', '', 'joni@disperindag.jatimprov.go.id', '', '', NULL, 0);
INSERT INTO `identities` VALUES (13, 13, '2017-12-18 10:45:37', 0, 1, '', '', 'jono@disperindag.jatimprov.go.id', '', '', NULL, 0);

-- ----------------------------
-- Table structure for searches
-- ----------------------------
DROP TABLE IF EXISTS `searches`;
CREATE TABLE `searches`  (
  `search_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` int(3) NOT NULL DEFAULT 0,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`search_id`) USING BTREE,
  UNIQUE INDEX `uniqueness`(`user_id`, `type`, `name`) USING BTREE,
  CONSTRAINT `user_id_fk_searches` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session`  (
  `sess_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `changed` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vars` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`sess_id`) USING BTREE,
  INDEX `changed_index`(`changed`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of session
-- ----------------------------
INSERT INTO `session` VALUES ('0dg2k1953agq4ebh88bm4v3pe5', '2017-10-31 13:38:44', '2017-10-31 13:38:44', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlRvNW10R1JwNm5meXZCcnV0VmVsQmdQZWk1NTFDRkNuIjs=');
INSERT INTO `session` VALUES ('0drlfou2selflgnt4svt4a3801', '2017-10-27 21:02:38', '2017-10-27 22:15:25', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJpZF9JRCI7c2tpbnxzOjU6ImxhcnJ5IjtpbWFwX25hbWVzcGFjZXxhOjQ6e3M6ODoicGVyc29uYWwiO2E6MTp7aTowO2E6Mjp7aTowO3M6MDoiIjtpOjE7czoxOiIuIjt9fXM6NToib3RoZXIiO047czo2OiJzaGFyZWQiO2E6MTp7aTowO2E6Mjp7aTowO3M6NzoiI1B1YmxpYyI7aToxO3M6MToiLiI7fX1zOjEwOiJwcmVmaXhfb3V0IjtzOjA6IiI7fWltYXBfZGVsaW1pdGVyfHM6MToiLiI7dXNlcl9pZHxzOjI6IjEyIjt1c2VybmFtZXxzOjMyOiJqb25pQGRpc3BlcmluZGFnLmphdGltcHJvdi5nby5pZCI7c3RvcmFnZV9ob3N0fHM6MTE6IlNFUlZFUl9EQVRBIjtzdG9yYWdlX3BvcnR8aToxNDM7c3RvcmFnZV9zc2x8TjtwYXNzd29yZHxzOjMyOiJRV0gzQ1ZlMGxNVHRRSHdQaHA3NW9Gd1NsQWVyb3JqZyI7bG9naW5fdGltZXxpOjE1MDkxMTI5NjY7dGltZXpvbmV8czoxMjoiQXNpYS9KYWthcnRhIjtTVE9SQUdFX1NQRUNJQUwtVVNFfGI6MDthdXRoX3NlY3JldHxzOjI2OiJtMGJJNzNEWnZ6T25mWklTeTV4VUk2RkJ5WSI7cmVxdWVzdF90b2tlbnxzOjMyOiJ6SHFlR3RBZWRuNzhOMUhNUm1jU0czSkZTdVVGRGxrUyI7dGFza3xzOjQ6Im1haWwiO2ltYXBfaG9zdHxzOjExOiJTRVJWRVJfREFUQSI7bWJveHxzOjQ6IlNlbnQiO3NvcnRfY29sfHM6MDoiIjtzb3J0X29yZGVyfHM6NDoiREVTQyI7U1RPUkFHRV9USFJFQUR8YjowO1NUT1JBR0VfUVVPVEF8YjoxO1NUT1JBR0VfTElTVC1FWFRFTkRFRHxiOjA7cXVvdGFfZGlzcGxheXxzOjQ6InRleHQiO2xpc3RfYXR0cmlifGE6Njp7czo0OiJuYW1lIjtzOjg6Im1lc3NhZ2VzIjtzOjI6ImlkIjtzOjExOiJtZXNzYWdlbGlzdCI7czo1OiJjbGFzcyI7czo0ODoicmVjb3Jkcy10YWJsZSBtZXNzYWdlbGlzdCBzb3J0aGVhZGVyIGZpeGVkaGVhZGVyIjtzOjE1OiJvcHRpb25zbWVudWljb24iO3M6NDoidHJ1ZSI7czoxNToiYXJpYS1sYWJlbGxlZGJ5IjtzOjIyOiJhcmlhLWxhYmVsLW1lc3NhZ2VsaXN0IjtzOjc6ImNvbHVtbnMiO2E6ODp7aTowO3M6NzoidGhyZWFkcyI7aToxO3M6Nzoic3ViamVjdCI7aToyO3M6Njoic3RhdHVzIjtpOjM7czo2OiJmcm9tdG8iO2k6NDtzOjQ6ImRhdGUiO2k6NTtzOjQ6InNpemUiO2k6NjtzOjQ6ImZsYWciO2k6NztzOjEwOiJhdHRhY2htZW50Ijt9fXBhZ2V8aToxO3Vuc2Vlbl9jb3VudHxhOjU6e3M6NToiSU5CT1giO2k6MDtzOjY6IkRyYWZ0cyI7aTowO3M6NDoiU2VudCI7aTowO3M6NDoiSnVuayI7aTowO3M6NToiVHJhc2giO2k6MDt9Zm9sZGVyc3xhOjU6e3M6NToiSU5CT1giO2E6Mjp7czozOiJjbnQiO2k6MDtzOjY6Im1heHVpZCI7aTowO31zOjY6IkRyYWZ0cyI7YToyOntzOjM6ImNudCI7aTowO3M6NjoibWF4dWlkIjtpOjA7fXM6NDoiU2VudCI7YToyOntzOjM6ImNudCI7aToyO3M6NjoibWF4dWlkIjtpOjI7fXM6NDoiSnVuayI7YToyOntzOjM6ImNudCI7aTowO3M6NjoibWF4dWlkIjtpOjA7fXM6NToiVHJhc2giO2E6Mjp7czozOiJjbnQiO2k6MDtzOjY6Im1heHVpZCI7aTowO319');
INSERT INTO `session` VALUES ('0rib551l5thjep7682a3p0m6u1', '2017-09-27 17:46:19', '2017-09-27 17:46:19', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ijg0WDJpa1V4QlZGSXB0Rm1hVm1RR1ZyV205Qklmak9CIjs=');
INSERT INTO `session` VALUES ('0rnoemkm02salotlk3nsnslrb6', '2017-09-27 17:49:58', '2017-09-27 17:49:58', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjVmaUxMUGI3TWZITmw2OVBVWmJ4aUd5aFVEbEptamRBIjs=');
INSERT INTO `session` VALUES ('0udma0454huevqvr39sj1sghk5', '2017-09-27 17:29:29', '2017-09-27 17:29:29', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkJQcXV0U1N0Tnd6dmMyNUlYd2xhS1Q3MzB1eHNlNktXIjs=');
INSERT INTO `session` VALUES ('1o9qk7h4g17pr31q1jtqjboi41', '2017-09-27 17:43:04', '2017-09-27 17:43:04', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlhsOGV1YnNSaFhlaVlsYzhRU0VWa3M4M0FoOUFDcWpuIjs=');
INSERT INTO `session` VALUES ('1rkisclb2652rli3d3nrbcqvk0', '2018-03-13 16:38:11', '2018-03-13 16:38:11', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Imp3Mm9rZ1BUUVNDQVpNQ01zVWxBUEV2N0plbEU5aEI5Ijs=');
INSERT INTO `session` VALUES ('20du5o5k6t2beu37v0fsuokucm', '2018-03-14 09:56:38', '2018-03-14 09:56:38', '::1', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlkxTlN2S0lSOWdCeTVuTlRkN3pHYWVmQ0gzQnF5TW5hIjs=');
INSERT INTO `session` VALUES ('2k6tpvr03qc517qmda8cnnhji6', '2017-09-27 17:43:36', '2017-09-27 17:43:36', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlVtMmdMNnFIc3RYZ2t4bDhjSVBDcFljMWE0c2FmcFAzIjs=');
INSERT INTO `session` VALUES ('2l6ifj4utdf9v72hgbqr86jqd5', '2017-09-27 17:46:22', '2017-09-27 17:46:22', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IldNcnRFRVZlYTEyRUFlbU9DZUkwUnhDNGd5ZTdERzNMIjs=');
INSERT INTO `session` VALUES ('2mnia3indb08cihidum7fitq03', '2017-09-27 17:46:25', '2017-09-27 17:46:25', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IklzdFN0eGlHWEdaNDM4TjlEQXR2dmt5d3RweW55NldnIjs=');
INSERT INTO `session` VALUES ('2ptufhactlpjv501ju16t1jll4', '2017-09-27 17:44:59', '2017-09-27 17:44:59', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InZsVnRzN2RobmI4WFNIdWpVbWMyN1JTWE5CUUE0NWN1Ijs=');
INSERT INTO `session` VALUES ('2rmjmf88jq4htg6q6d4883uia1', '2017-09-27 17:44:55', '2017-09-27 17:44:55', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkZUVUhoazZQbmVTaGcxU05DZHBuMUhUTmo3TExPaURNIjs=');
INSERT INTO `session` VALUES ('34j83lpcpe5rh37p77v1uchad4', '2017-09-27 17:46:17', '2017-09-27 17:46:17', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkRIeG04WUhCTWFCN3hmV2FEV2l2SGFtNEpsYVQxT0Y1Ijs=');
INSERT INTO `session` VALUES ('3c05lbb2bn9chpkl6uvmc7k0c4', '2017-09-27 17:46:56', '2017-09-27 17:46:56', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkFJMzFxckt5aGVGY2wwR1c0V0xtNkN2UXlkaGczdTZsIjs=');
INSERT INTO `session` VALUES ('3plfsuvr6q05hvlmtvianhmmr6', '2017-09-27 17:46:21', '2017-09-27 17:46:21', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkNRTFZ1SnM0NTZnNnpPT2gzR2IzTEUza3Rwczd2d2xNIjs=');
INSERT INTO `session` VALUES ('4bbbvcdhqq9bpgn6itt6p4ie75', '2017-09-27 17:46:24', '2017-09-27 17:46:24', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IldlaDRiZFZObzNwZWc1ZURBcWxuVElpUnBSUHY2MlNXIjs=');
INSERT INTO `session` VALUES ('4ubkhu0jnhrhen19hsqbb336f5', '2017-09-27 17:49:05', '2017-09-27 17:49:05', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlpqbkJ6NUJaRjY0RmVaRnNtdENWU2ltTFZoeG1LS2U2Ijs=');
INSERT INTO `session` VALUES ('5ccibhfsfdtgq8hq9um3466h05', '2017-09-27 17:46:52', '2017-09-27 17:46:52', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ik9od0dyQVJNN2V3NkZQYU5CRjBVUG5rVks4dlVXSWh4Ijs=');
INSERT INTO `session` VALUES ('5cpo3pfmcp5coh31j5qg42fv37', '2017-09-27 17:45:43', '2017-09-27 17:45:43', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJDdWlRdUF2TjVQM3V6b2RZYTlobTJSSTJVQndMSGJrQSI7');
INSERT INTO `session` VALUES ('5fnhlslpqe742f7bd593eqcg54', '2017-09-27 17:37:49', '2017-09-27 17:37:49', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InVGWVFVb3pnRWtLa2hPdG9obnpDNkE3cUtKVDJDQVhGIjs=');
INSERT INTO `session` VALUES ('5hnmss530oed52ce8irc8cdo76', '2017-09-27 17:48:34', '2017-09-27 17:48:34', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjRGSVlwd1JFcFVDWHAzWG5la1BVOUZ3eUtYZ3pNa1oyIjs=');
INSERT INTO `session` VALUES ('5qivvq59o74dalvo4bjv7e4c40', '2017-09-27 17:46:24', '2017-09-27 17:46:24', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjZPQnRDT0JoaFRRT1dSU2pBb0p5UVM3RXo0TUpwbGl0Ijs=');
INSERT INTO `session` VALUES ('6bqg8v52oafhgbqg484h0f9qf7', '2017-09-27 17:46:17', '2017-09-27 17:46:17', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Indpbk5ZSzY3enhSYjBsc2NCalFiS3F6NkU2M1VRQzltIjs=');
INSERT INTO `session` VALUES ('6fh6ok4pr0mlbrtk0nklrp1072', '2017-09-27 17:37:36', '2017-09-27 17:37:36', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Inh5T0RHVE5DTXZGZEdNelVETVh3YURxWHZsOWtaeWZGIjs=');
INSERT INTO `session` VALUES ('6j7bb6tid5c2jv7datcq0hda07', '2017-11-07 16:06:14', '2017-11-07 16:06:14', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjBacTh3cldJYWMzaHI0WFpNR05OR0kzTklyeXBDcktrIjs=');
INSERT INTO `session` VALUES ('6l9h1tumi559jpuvr3s9jf71r7', '2017-09-27 17:29:30', '2017-09-27 17:29:30', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJmZktQVzRIQkJIbHc3MjlHdmdEcFBIV1dXWUNzYkl2RSI7');
INSERT INTO `session` VALUES ('6sva9hqehkit6ej8hhosg9a1j6', '2017-09-27 17:47:02', '2017-09-27 17:47:02', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ilp6Njk4NjFMcFNNZDFXYkxVVzl5ZFFzMUx1QTRXZDI4Ijs=');
INSERT INTO `session` VALUES ('70ktqb3nnaljbstmajim1lueo2', '2017-09-27 17:37:36', '2017-09-27 17:37:36', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InY3MWRkUkFTOWNkbFFmQTQ3VXhHckdlRlNscW5MQ0dYIjs=');
INSERT INTO `session` VALUES ('77vgonqe4njrgd3ikn70hslcg3', '2017-09-27 17:44:59', '2017-09-27 17:44:59', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjhZQjBINmZpOWRUMjdmMUJuem8wSEZvTDl2SXVicE90Ijs=');
INSERT INTO `session` VALUES ('79ijf3s1o1l2vljvmpitse0mu7', '2017-09-27 17:46:54', '2017-09-27 17:46:54', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkEwMVdqWTdwZUxJNm53TUxBVUtxMkg0eVhrckF0cHd6Ijs=');
INSERT INTO `session` VALUES ('7htqlablomqt6reqfg3s2q55g2', '2017-09-27 17:47:16', '2017-09-27 17:47:16', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImNEMWtPTTVTNUw3aEs4YW4ydUZQRVJBZUJJN2lJcVZDIjs=');
INSERT INTO `session` VALUES ('7kup97hjrblai5dllhe7g3vsk0', '2017-09-27 17:47:52', '2017-09-27 17:47:52', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InhJYWJrOFJyRmRHWTIyMWkyamlrYlJuTk55N05UYVdTIjs=');
INSERT INTO `session` VALUES ('7ljb2dc8a5ap837mhvo8mrl367', '2017-09-27 17:48:40', '2017-09-27 17:48:40', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ik5EbG9ES1hFeHJQMXkyQU5PMWc5cGZ4UmhaT1p1ckNDIjs=');
INSERT INTO `session` VALUES ('7lm1p6869flfsbc86uj270ruv0', '2017-12-08 15:21:46', '2017-12-08 15:21:46', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InFEeGtFRlY0SDlQcmM3UVRwM091bFdycDB1akpZT2NzIjs=');
INSERT INTO `session` VALUES ('7sk7n2bqtda689408ig79rasa7', '2017-09-27 17:49:32', '2017-09-27 17:49:32', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkRXNDZmUFNBdTM0amhWdnF0Q2JwQzQ1WDV4WHRWV2ZPIjs=');
INSERT INTO `session` VALUES ('7t4gl0l3abp8ammgj30bosbkm5', '2017-09-27 17:48:52', '2017-09-27 17:48:52', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImVQODN3cjBBOVBCdU9BVEM0c29XeHM0ejlkZWxHMzF1Ijs=');
INSERT INTO `session` VALUES ('8e9uupd359b7u44vp43f7vkkm0', '2017-10-27 14:49:29', '2017-10-27 14:49:29', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Im5MTFBLZW9JVFcwaXYydmp2TXVTV3hpUVB5a0s2dEVBIjs=');
INSERT INTO `session` VALUES ('8l6pkcjbuoiuajjmr1e2mp5gr5', '2017-09-27 17:34:17', '2017-09-27 17:34:17', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Im04SFJWM0p3STZDODFWaHNacE52MUE2YTNiaFdsdXRmIjs=');
INSERT INTO `session` VALUES ('8oa2he55ehpn3dp1j6imkkaif7', '2017-09-27 17:52:24', '2017-09-27 17:52:24', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImQ1M2dvaEF6UVk2ZEFUTHBCVjJTV0R4akpoS1M1bjA1Ijs=');
INSERT INTO `session` VALUES ('8oett7l8ghcviii5vi3j3dl6v0', '2017-09-27 17:47:02', '2017-09-27 17:47:02', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJLODROR0RQTERwQUthRGZHYjA0UmI1TjFsM1lHSTFmQyI7');
INSERT INTO `session` VALUES ('93ti0hphm8pauht10p0088s9u3', '2017-09-27 17:38:02', '2017-09-27 17:38:02', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InN1ZkJHVkZ3bUs2TWtDaFBhRTdVODQxMXpkaXNEUzRiIjs=');
INSERT INTO `session` VALUES ('97ifvlcvgqu02d9fdq59g5shg1', '2017-09-27 17:48:48', '2017-09-27 17:48:48', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImhvZEJDRkFnUFVQcXVna3JyeHY0cHVoajk5TVhmOHN3Ijs=');
INSERT INTO `session` VALUES ('98a40gk79sllmbff1r5f41r8p3', '2017-12-08 16:57:15', '2017-12-08 16:57:15', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkYzdmNlc3FIc05tOGtOVnhGeDdDR1RpMFhEZDJqTEtqIjs=');
INSERT INTO `session` VALUES ('9eq8ro80e55v8mmu3h7843hdu2', '2017-09-27 17:37:50', '2017-09-27 17:37:50', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjJ2Z0tGaVA1NDhBd0V0RjlzNVdYcjRXNGk0ZWFyV0xMIjs=');
INSERT INTO `session` VALUES ('9ls7robenhsamq100lac677rt3', '2017-09-27 17:45:00', '2017-09-27 17:45:00', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjM0TjF0WXZUNEt1aXBqVWFlNkhjR1QzVW9wQmFxdnN6Ijs=');
INSERT INTO `session` VALUES ('a3o3tn93pre698vtg33kqrn772', '2017-10-30 16:04:38', '2017-10-30 16:04:38', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkhpanRZTDZzTEFtV1J6aTJZQjBJS2RNQXpaMDdmV0MyIjs=');
INSERT INTO `session` VALUES ('a8hn2rdjkhqdgd45g6rq4hrn94', '2017-09-27 17:40:52', '2017-09-27 17:40:52', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImFROTU0RXJkdWZtRFNYeWI1OVF4M2pCNHVFUDlpanBaIjs=');
INSERT INTO `session` VALUES ('akr0ksrlob83nvpsd10o72kfm6', '2017-09-27 17:29:31', '2017-09-27 17:29:31', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImRDZ3Rna2VJMm55dWxXajBXQ0tJeEg0RGF6UldyUTM5Ijs=');
INSERT INTO `session` VALUES ('al8a3o63mbu0nk7847709ctlv7', '2017-09-27 17:39:44', '2017-09-27 17:39:44', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ild4ckdxdjBXaTZJZEQ0d2ZtNmRCUDZQM2Q2ZnFLOXFoIjs=');
INSERT INTO `session` VALUES ('apkiebrieinru3ckqg7cab8eg7', '2017-09-27 17:37:48', '2017-09-27 17:37:48', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImxjRFlNakthbzdQcU9pak9weUl6Tm1yU2dtUFp6MlBSIjs=');
INSERT INTO `session` VALUES ('au6268qjuqmdd1p5g4ktm975n3', '2017-09-27 17:46:20', '2017-09-27 17:46:20', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IldwaFNZbzNmV0RoR1dKYUdQSk5USW1sZmhBcWxzTmVRIjs=');
INSERT INTO `session` VALUES ('b1i1795312lgktjmnqrmi1o0s1', '2017-09-27 17:44:57', '2017-09-27 17:44:57', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjZLRDAyUm10bUg4ZUh0VlM4UzhlRDc4WmxXSUtDMTVoIjs=');
INSERT INTO `session` VALUES ('b4askke5obn5pktn53lseqe3h1', '2017-09-27 17:37:35', '2017-09-27 17:37:35', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImVQbkNKV2tuUjJoTFFuSTRHblNOd0d1Slk1N1RrbktOIjs=');
INSERT INTO `session` VALUES ('b54315tibi8q6r9skc4etbu2r6', '2017-09-27 17:46:26', '2017-09-27 17:46:26', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Im5jOHVwbW41MnVqelFFVGEwVUFXcHZpYm5JUFFxNDFpIjs=');
INSERT INTO `session` VALUES ('b6ki4qcr4h9eoiih1bjq3g93n7', '2017-09-27 17:46:46', '2017-09-27 17:46:46', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlBTQXVXVXU4bjJaeEY0UG1RaGhJalR0TzJSNEhXQjMwIjs=');
INSERT INTO `session` VALUES ('bb73cise0vgqkq6vbf8as9ri76', '2017-09-27 17:46:18', '2017-09-27 17:46:18', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjRIdDB2UlhyNmcwUjgyV3ZyeWRTY0dRd2xWZHcwTHZBIjs=');
INSERT INTO `session` VALUES ('bcu6h8ntt7de7ortakcc8p1md1', '2017-09-27 17:43:44', '2017-09-27 17:43:44', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJoRnZtQVloMWRoeENabE1EQ2plWFE5ejZLalVZT2xyNSI7');
INSERT INTO `session` VALUES ('biaie4dqe16lfhfjqs93mtf3q7', '2017-09-27 17:48:37', '2017-09-27 17:48:37', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Im83R2FhU3NxRWJUckthVnh0SDlsS1VZVW5TbnF5cHVZIjs=');
INSERT INTO `session` VALUES ('bn1ki60am3e0a2au9852cvoj81', '2017-09-27 17:46:16', '2017-09-27 17:46:16', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InJUYlNqVGZ1dkFyYkFCQlZuU0s1MWppTlM2QkVCTXFpIjs=');
INSERT INTO `session` VALUES ('bu6k7jkidlj255ipb5penc9747', '2017-09-27 17:38:56', '2017-09-27 17:38:56', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IldjRnFjNmpmZHpxTVA1cFdYUlAwZzJUWGhySFZPZTBkIjs=');
INSERT INTO `session` VALUES ('bvi7s8jhoiqjqb1do27slpi981', '2017-09-27 17:45:34', '2017-09-27 17:45:34', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlpETWE3QUNYSDgxaFNSN3VyWVNmV3AzUkhWUmhsd1JDIjs=');
INSERT INTO `session` VALUES ('c5an49k37lb2thp5sa167djmd3', '2017-09-27 17:46:23', '2017-09-27 17:46:23', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IktmUVFISE9MQWh1VkowdmNXaTZQTFpnZzhNZjZ4OTViIjs=');
INSERT INTO `session` VALUES ('ck7ji3dev7ftgc6kcg580squ81', '2017-09-27 17:46:18', '2017-09-27 17:46:18', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Im81MllBR0NhZHBJMnN6RWxIc1dpdDBNSTdrN083cEJVIjs=');
INSERT INTO `session` VALUES ('cktcofb4539a369g6ekejdi0q1', '2017-09-27 17:47:10', '2017-09-27 17:47:10', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjVabTdjanJPaGRrVlBaSElTS2hZWlByRE16aFlDY0pGIjs=');
INSERT INTO `session` VALUES ('d25pkhri2mosh8ut568t3jnl82', '2017-09-27 17:43:20', '2017-09-27 17:43:20', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InpBVjl1Wm4ySUl4a1V4aWdIUnJ0NEVMOGphQzdRQk45Ijs=');
INSERT INTO `session` VALUES ('d3q5lgr9br10l2tmmpg0sgrsr3', '2017-09-27 17:45:01', '2017-09-27 17:45:01', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjFKVjRic1pDbDZxdHZBd0ZFeXR3b1hET0tHMFp5ZmwzIjs=');
INSERT INTO `session` VALUES ('dabnj7rqaq3pvpdibprca8tcc1', '2017-09-27 17:43:41', '2017-09-27 17:43:41', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ikt1d1hoUlV4T1h3RG5IOWp4d2pyM3ZBRlNzcjZwOUpSIjs=');
INSERT INTO `session` VALUES ('dojudtng5c1glhvclb878a4297', '2017-09-27 17:37:03', '2017-09-27 17:37:03', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InlKaWE4OFI2NnZMTTdVMEVtWHZEVG4xcXVEbHdEMWpoIjs=');
INSERT INTO `session` VALUES ('dov9c2jn8s5sumj2s6n3gvva74', '2017-09-27 17:46:22', '2017-09-27 17:46:22', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlFvYlJyWEFrZmJJVjRqMXMyOURpRmFVV1ZxV3F6RnRvIjs=');
INSERT INTO `session` VALUES ('dr85b3nv6ri78l0jrnlip94g41', '2017-09-27 17:39:57', '2017-09-27 17:39:57', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImtiMzNNcVlRbEp5MUY3TzNDOEwwSThUVHBlYkkzUGlnIjs=');
INSERT INTO `session` VALUES ('e0n565q1ojrhlvqopgd1ttpmm1', '2017-09-27 17:46:21', '2017-09-27 17:46:21', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Im9XRUIyTnByazFVZTBMTjdndUlkUldpc2dRM1NZUmQxIjs=');
INSERT INTO `session` VALUES ('e18me36qu5ck7omk9d8qosrsi0', '2017-10-30 08:05:34', '2017-10-30 08:05:34', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImhLVlJsajlvS1FrSUk3aGhIQ3pxWG1lYUZTVjhLdEJOIjs=');
INSERT INTO `session` VALUES ('e3k26npnu44m2nit3nss6fh4o0', '2017-12-18 10:35:26', '2017-12-18 11:50:22', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJpZF9JRCI7c2tpbnxzOjU6ImxhcnJ5IjtpbWFwX25hbWVzcGFjZXxhOjQ6e3M6ODoicGVyc29uYWwiO2E6MTp7aTowO2E6Mjp7aTowO3M6MDoiIjtpOjE7czoxOiIuIjt9fXM6NToib3RoZXIiO047czo2OiJzaGFyZWQiO2E6MTp7aTowO2E6Mjp7aTowO3M6NzoiI1B1YmxpYyI7aToxO3M6MToiLiI7fX1zOjEwOiJwcmVmaXhfb3V0IjtzOjA6IiI7fWltYXBfZGVsaW1pdGVyfHM6MToiLiI7dXNlcl9pZHxzOjI6IjEyIjt1c2VybmFtZXxzOjMyOiJqb25pQGRpc3BlcmluZGFnLmphdGltcHJvdi5nby5pZCI7c3RvcmFnZV9ob3N0fHM6MTE6IlNFUlZFUl9EQVRBIjtzdG9yYWdlX3BvcnR8aToxNDM7c3RvcmFnZV9zc2x8TjtwYXNzd29yZHxzOjI0OiJjRUJwb3V3b1I1cnd6S2NnZDRXYnVBPT0iO2xvZ2luX3RpbWV8aToxNTEzNTY4MTI2O3RpbWV6b25lfHM6MTI6IkFzaWEvSmFrYXJ0YSI7U1RPUkFHRV9TUEVDSUFMLVVTRXxiOjA7YXV0aF9zZWNyZXR8czoyNjoidlp0TUJMZ2s5OVVZVU5NM0FYajZMdFVnaTQiO3JlcXVlc3RfdG9rZW58czozMjoiNnI5UzAwdG4zTDZJdW1jaWZNcUZUbkFpOU1ZckdEcUkiO3Rhc2t8czo0OiJtYWlsIjtpbWFwX2hvc3R8czoxMToiU0VSVkVSX0RBVEEiO21ib3h8czo1OiJJTkJPWCI7c29ydF9jb2x8czowOiIiO3NvcnRfb3JkZXJ8czo0OiJERVNDIjtTVE9SQUdFX1RIUkVBRHxiOjA7U1RPUkFHRV9RVU9UQXxiOjE7U1RPUkFHRV9MSVNULUVYVEVOREVEfGI6MDtxdW90YV9kaXNwbGF5fHM6NDoidGV4dCI7bGlzdF9hdHRyaWJ8YTo2OntzOjQ6Im5hbWUiO3M6ODoibWVzc2FnZXMiO3M6MjoiaWQiO3M6MTE6Im1lc3NhZ2VsaXN0IjtzOjU6ImNsYXNzIjtzOjQ4OiJyZWNvcmRzLXRhYmxlIG1lc3NhZ2VsaXN0IHNvcnRoZWFkZXIgZml4ZWRoZWFkZXIiO3M6MTU6Im9wdGlvbnNtZW51aWNvbiI7czo0OiJ0cnVlIjtzOjE1OiJhcmlhLWxhYmVsbGVkYnkiO3M6MjI6ImFyaWEtbGFiZWwtbWVzc2FnZWxpc3QiO3M6NzoiY29sdW1ucyI7YTo4OntpOjA7czo3OiJ0aHJlYWRzIjtpOjE7czo3OiJzdWJqZWN0IjtpOjI7czo2OiJzdGF0dXMiO2k6MztzOjY6ImZyb210byI7aTo0O3M6NDoiZGF0ZSI7aTo1O3M6NDoic2l6ZSI7aTo2O3M6NDoiZmxhZyI7aTo3O3M6MTA6ImF0dGFjaG1lbnQiO319cGFnZXxpOjE7dW5zZWVuX2NvdW50fGE6NTp7czo1OiJJTkJPWCI7aTowO3M6NjoiRHJhZnRzIjtpOjA7czo0OiJTZW50IjtpOjA7czo0OiJKdW5rIjtpOjA7czo1OiJUcmFzaCI7aTowO31mb2xkZXJzfGE6NTp7czo2OiJEcmFmdHMiO2E6Mjp7czozOiJjbnQiO2k6MDtzOjY6Im1heHVpZCI7aTowO31zOjQ6IlNlbnQiO2E6Mjp7czozOiJjbnQiO2k6MjtzOjY6Im1heHVpZCI7aToyO31zOjQ6Ikp1bmsiO2E6Mjp7czozOiJjbnQiO2k6MDtzOjY6Im1heHVpZCI7aTowO31zOjU6IlRyYXNoIjthOjI6e3M6MzoiY250IjtpOjA7czo2OiJtYXh1aWQiO2k6MDt9czo1OiJJTkJPWCI7YToyOntzOjM6ImNudCI7aToxO3M6NjoibWF4dWlkIjtpOjE7fX1icm93c2VyX2NhcHN8YTozOntzOjM6InBkZiI7czoxOiIxIjtzOjU6ImZsYXNoIjtzOjE6IjAiO3M6MzoidGlmIjtzOjE6IjAiO31zYWZlX21lc3NhZ2VzfGE6MTp7czo3OiJJTkJPWDoxIjtiOjA7fXdyaXRlYWJsZV9hYm9va3xiOjE7');
INSERT INTO `session` VALUES ('e6n24f97if86sk8kfp5rvv2hf4', '2017-09-27 17:35:35', '2017-09-27 17:35:35', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ink3UDU2UEVzWWlzekViYjJSTFRNNVN1SmlZMzk1Q3U5Ijs=');
INSERT INTO `session` VALUES ('e9198bjook20odrq861ro19au4', '2017-09-27 17:46:48', '2017-09-27 17:46:48', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJNYVFrRUxmS09wMU54Y2ZkYlhKRFExS01ld1VpWWNVaSI7');
INSERT INTO `session` VALUES ('ejoj60fofno91mcfc0iq1t1tt1', '2017-09-27 17:48:40', '2017-09-27 17:48:40', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJGNFp0TkJ2QUJWNFd0RThXWUpiYUFTQ3QwdEo4NFdneiI7');
INSERT INTO `session` VALUES ('en63s9ajtn3v0r3v20mbk75996', '2017-09-27 17:51:48', '2017-09-27 17:51:48', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkpzcjY4b1FwclpEZ0U2RHZHZ1dMWW81ZFRHdUpTVkoxIjs=');
INSERT INTO `session` VALUES ('eoj79rqo7a1s06kpmgjv7trie0', '2017-09-27 17:43:44', '2017-09-27 17:43:44', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkE0SUhjTFVqeE92QmIzZUdwTk9JbE90Mjl5aW1uZEJTIjs=');
INSERT INTO `session` VALUES ('eru036vk0ebi0smpkejsu815f2', '2017-09-27 17:29:34', '2017-09-27 17:29:34', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjNsU292eFhvQVdzb25VbkdVWnY3dnBYVEdqWUpVNm8wIjs=');
INSERT INTO `session` VALUES ('etln2m2674496b8938uba59nq3', '2017-09-27 17:46:19', '2017-09-27 17:46:19', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjhqUlkyZ3g0SlI1V1pvTXIzMUZWZEpJWDB5ZFdrakY5Ijs=');
INSERT INTO `session` VALUES ('etp2afrcks6eauk8t9mh1hkhd7', '2017-09-27 17:46:22', '2017-09-27 17:46:22', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InlkaWwwQTNxYUQxQ25RWDY0UlF3VDNrUERmbXBkTHBtIjs=');
INSERT INTO `session` VALUES ('fm701atiu0e08jq5titngv1d87', '2017-09-27 17:46:44', '2017-09-27 17:46:44', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjJhcGU2MjRhQldjc2dUMkgxY3VpY25wd0Vndm9qSU1YIjs=');
INSERT INTO `session` VALUES ('fop500hamfah61ppkauo1urrd5', '2017-10-27 14:20:09', '2017-10-27 14:20:09', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJpZF9JRCI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjB0YnBFOW1rVEVEcWNmVVI2cEFNeFFxQk1jNERTQlpOIjs=');
INSERT INTO `session` VALUES ('fqgaujthuhunqe2a28fca91ov7', '2017-09-27 17:36:54', '2017-09-27 17:36:54', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlFyZGdpcGFPaHZmemQwU0NyS0xGQkhIVDBtS3dVTG82Ijs=');
INSERT INTO `session` VALUES ('frhu64knu8us46dg0bt2hhebq7', '2017-09-27 17:29:35', '2017-09-27 17:29:35', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ild1TTBIeDZBMG5vMEhqSUFGUlRnYUdBNFpXTlNNNFpMIjs=');
INSERT INTO `session` VALUES ('fumclsepms4i090ff7cr9181d0', '2017-09-27 17:46:25', '2017-09-27 17:46:25', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InE4cGNOcWpOd3JOdmo0Smo4cUhKMGgydXJ2M1J3OEZTIjs=');
INSERT INTO `session` VALUES ('g0bibbn53j5s8j1eavnk8k1gr6', '2017-09-27 17:29:37', '2017-09-27 17:29:37', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkVQbE9tcmR5U3pYYVFlQWRpQ0RUNTlzRG92N0QzbzVRIjs=');
INSERT INTO `session` VALUES ('g1n7otm8l7hcclg62tmgj7nln1', '2017-12-18 10:45:38', '2017-12-18 10:46:15', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJpZF9JRCI7c2tpbnxzOjU6ImxhcnJ5IjtpbWFwX25hbWVzcGFjZXxhOjQ6e3M6ODoicGVyc29uYWwiO2E6MTp7aTowO2E6Mjp7aTowO3M6MDoiIjtpOjE7czoxOiIuIjt9fXM6NToib3RoZXIiO047czo2OiJzaGFyZWQiO2E6MTp7aTowO2E6Mjp7aTowO3M6NzoiI1B1YmxpYyI7aToxO3M6MToiLiI7fX1zOjEwOiJwcmVmaXhfb3V0IjtzOjA6IiI7fWltYXBfZGVsaW1pdGVyfHM6MToiLiI7dXNlcl9pZHxzOjI6IjEzIjt1c2VybmFtZXxzOjMyOiJqb25vQGRpc3BlcmluZGFnLmphdGltcHJvdi5nby5pZCI7c3RvcmFnZV9ob3N0fHM6MTE6IlNFUlZFUl9EQVRBIjtzdG9yYWdlX3BvcnR8aToxNDM7c3RvcmFnZV9zc2x8TjtwYXNzd29yZHxzOjI0OiJZampZbFhMbHlma1BMNnNPaGVqWmp3PT0iO2xvZ2luX3RpbWV8aToxNTEzNTY4NzM4O3RpbWV6b25lfHM6MTI6IkFzaWEvSmFrYXJ0YSI7U1RPUkFHRV9TUEVDSUFMLVVTRXxiOjA7YXV0aF9zZWNyZXR8czoyNjoiODRzTkJ2NU1VOE9IN1Z1OHdlVDhXTGdTZTIiO3JlcXVlc3RfdG9rZW58czozMjoiYlRjSEdQY1NWTnF0WWxKUnhma2JIeVBmWkhPVk5CaVQiO3Rhc2t8czo0OiJtYWlsIjtpbWFwX2hvc3R8czoxMToiU0VSVkVSX0RBVEEiO21ib3h8czo0OiJTZW50Ijtzb3J0X2NvbHxzOjA6IiI7c29ydF9vcmRlcnxzOjQ6IkRFU0MiO1NUT1JBR0VfVEhSRUFEfGI6MDtTVE9SQUdFX1FVT1RBfGI6MTtTVE9SQUdFX0xJU1QtRVhURU5ERUR8YjowO3F1b3RhX2Rpc3BsYXl8czo0OiJ0ZXh0IjtsaXN0X2F0dHJpYnxhOjY6e3M6NDoibmFtZSI7czo4OiJtZXNzYWdlcyI7czoyOiJpZCI7czoxMToibWVzc2FnZWxpc3QiO3M6NToiY2xhc3MiO3M6NDg6InJlY29yZHMtdGFibGUgbWVzc2FnZWxpc3Qgc29ydGhlYWRlciBmaXhlZGhlYWRlciI7czoxNToib3B0aW9uc21lbnVpY29uIjtzOjQ6InRydWUiO3M6MTU6ImFyaWEtbGFiZWxsZWRieSI7czoyMjoiYXJpYS1sYWJlbC1tZXNzYWdlbGlzdCI7czo3OiJjb2x1bW5zIjthOjg6e2k6MDtzOjc6InRocmVhZHMiO2k6MTtzOjc6InN1YmplY3QiO2k6MjtzOjY6InN0YXR1cyI7aTozO3M6NjoiZnJvbXRvIjtpOjQ7czo0OiJkYXRlIjtpOjU7czo0OiJzaXplIjtpOjY7czo0OiJmbGFnIjtpOjc7czoxMDoiYXR0YWNobWVudCI7fX1wYWdlfGk6MTtmb2xkZXJzfGE6Mjp7czo1OiJJTkJPWCI7YToyOntzOjM6ImNudCI7aTowO3M6NjoibWF4dWlkIjtpOjA7fXM6NDoiU2VudCI7YToyOntzOjM6ImNudCI7aToxO3M6NjoibWF4dWlkIjtpOjE7fX11bnNlZW5fY291bnR8YTo1OntzOjU6IklOQk9YIjtpOjA7czo2OiJEcmFmdHMiO2k6MDtzOjQ6IlNlbnQiO2k6MDtzOjQ6Ikp1bmsiO2k6MDtzOjU6IlRyYXNoIjtpOjA7fVNUT1JBR0VfQUNMfGI6MTtsYXN0X2NvbXBvc2Vfc2Vzc2lvbnxzOjIyOiI0NzcyODExNzk1YTM3MzllNzJiMmU4Ijs=');
INSERT INTO `session` VALUES ('gahqgr8vj1cuakmb56es0i8ck5', '2017-09-27 17:37:37', '2017-09-27 17:37:37', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjN3TlBDUkZDT1FvOWwyWWphTmJHR0xNRzNZbFRWUmxuIjs=');
INSERT INTO `session` VALUES ('gfmqv2cbt8jpje5tivan1tjev6', '2017-09-27 17:33:38', '2017-09-27 17:33:38', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjVaMmpIUFFYY0RuSTJDdzI1SnRqR0Nqckp4NnhLd3lNIjs=');
INSERT INTO `session` VALUES ('ghkn7vl50s3lbt85j15ftlvtj5', '2017-11-08 07:44:14', '2017-11-08 07:44:14', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Imk1b0ZaNDdMcE5wRlhsSEI3bW44Nm15c2JsdlI4UzdnIjs=');
INSERT INTO `session` VALUES ('giq33qsfk1ucnvcq3qopa8ar26', '2017-09-27 17:43:56', '2017-09-27 17:43:56', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImpDTGpaaFo1ODRQakNZaFpKMldTcFpGMHNEMDdCcDJRIjs=');
INSERT INTO `session` VALUES ('gvn9rd2dgev6ejee13d8a673f5', '2017-09-27 17:44:48', '2017-09-27 17:44:49', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkFaSnBWMG43SmYxVlhNMjNCTEFWR3ZmRG52UzJCZWNSIjt0YXNrfHM6NToibG9naW4iOw==');
INSERT INTO `session` VALUES ('h4j0ok85k299ut7ervt76alce0', '2017-09-27 17:37:35', '2017-09-27 17:37:35', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InhncHNYRERGektod0NDRFFXNFJsak9zak0yeklUczd2Ijs=');
INSERT INTO `session` VALUES ('h5avcbco8msfe6qjo2leisla47', '2017-09-27 17:28:18', '2017-09-27 17:28:18', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImtNV2h2M0w3ZjZMMTEzY2xaRHZLRWJNblRzWXJMVjJoIjs=');
INSERT INTO `session` VALUES ('hf17ps0hfvmgn302pfaee1i2q1', '2017-09-27 17:47:12', '2017-09-27 17:47:12', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjFGaFhyVUJ0QU9HbW5Ea3YyRDRMeHBLcGNOc0oycnpJIjs=');
INSERT INTO `session` VALUES ('hkisf7b469so1b3ccbdr7ip204', '2017-09-27 17:44:58', '2017-09-27 17:44:58', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjBHR3Z3djR0YklsWDlOOTVsRVFlWUhNNDYwd0NGemdYIjs=');
INSERT INTO `session` VALUES ('hs4mh8v39mpa19f5jjinfg4135', '2017-09-27 17:38:56', '2017-09-27 17:38:56', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImR6QldlMldsdFF5MnUwc3p5cHVxUHBwamtqQm5PUXBvIjs=');
INSERT INTO `session` VALUES ('htc1vl6hhpfb5r3mr1holglvs0', '2017-09-27 17:43:09', '2017-09-27 17:43:09', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkF4eGppYjlOeGNRRDgyN3p4ODJxbFRDOEpxdTdWZDR5Ijs=');
INSERT INTO `session` VALUES ('ieefr2mn4qo9vo9dt1feu9qnn7', '2017-09-27 17:37:48', '2017-09-27 17:37:48', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkVJNXdQTzVYUTlCdzJ0R0Z2THZETEUwcXJFUVlWN045Ijs=');
INSERT INTO `session` VALUES ('ik2qcjfv2ku74dkl0a8ue01764', '2017-09-27 17:38:58', '2017-09-27 17:38:58', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IktPRWNacGpUclo4MjhLb0RkbVNOemVJWmxsTDN3OE9sIjs=');
INSERT INTO `session` VALUES ('io1mr1vh237rrql44sbqdrnlv1', '2017-09-27 17:46:46', '2017-09-27 17:46:46', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImZ6VGtqYzFleHpHdDdRQVVaSkYxam5OUVpQTnNMQzhCIjs=');
INSERT INTO `session` VALUES ('iqiosipmuu215t179lsnva3qd2', '2017-09-27 17:30:38', '2017-09-27 17:30:38', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ik4xeFlvZ0tyVktpNmlzd0xScVpCc09RdGkxSzRINVJEIjs=');
INSERT INTO `session` VALUES ('is1spl20rt98ppdbnplu1rvmba', '2018-03-13 17:44:52', '2018-03-13 17:44:52', '::1', 'bGFuZ3VhZ2V8czo1OiJpZF9JRCI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InFETTB4Y0FScm5CdkMxYlZ3RlhUcXIwWDV2TzlkWEs3Ijs=');
INSERT INTO `session` VALUES ('itqbeb0bjeoc6sjvrekp288bk0', '2017-09-27 17:28:54', '2017-09-27 17:28:54', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ijh3Mm9yR1FoRmlyVUQwS211MlFkTXhjVWhNRGVXU2pFIjs=');
INSERT INTO `session` VALUES ('iu58k32l3c68gnlv6720s1nk25', '2017-09-27 17:44:58', '2017-09-27 17:44:58', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InR3eE1XZ1NCZURjNnptZU9teDY4MnYwZjBOUzdUQm9MIjs=');
INSERT INTO `session` VALUES ('j0rr8nud31ota9lvajb155ken4', '2017-09-27 17:47:44', '2017-09-27 17:47:44', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkN0Q004NWZnNVkwemxGREpzOWgzTGhTamFFRUpkemlLIjs=');
INSERT INTO `session` VALUES ('j9l24rqbmsp2oh5s5gsg4m4pp1', '2017-09-27 17:29:41', '2017-09-27 17:29:41', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IktVeFdYbUx1UjEyRGNEMVl4VEZIdk1NR0ZHU2pJRXdHIjs=');
INSERT INTO `session` VALUES ('jdbfchf2tohaot4rvn0i3t20r4', '2017-09-27 17:48:47', '2017-09-27 17:48:47', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InBrWGxkMERUUFQ3R3B0ZXBBSkdqdkxSak1idlZTY0hlIjs=');
INSERT INTO `session` VALUES ('jg88jdckem17f3i70nad12a8b7', '2017-09-27 17:43:37', '2017-09-27 17:43:37', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlVjU00zZEhhVXVObzU2cGlTbnFxbDNmakhoQno5MHp5Ijs=');
INSERT INTO `session` VALUES ('jmarm64jbkku78e07l9unilap4', '2017-09-27 17:46:59', '2017-09-27 17:46:59', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IndVVUh3Q3FVdkxqNDdvaTBnOU9NSlhwbmU0VFp2MnFlIjs=');
INSERT INTO `session` VALUES ('k1dtsv5p6eeq2b743b4c1m5is5', '2017-09-27 17:46:20', '2017-09-27 17:46:20', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlhrdktMM0VSN3RxMTJFcGphR0xlaHlhMHRyQno4WDdXIjs=');
INSERT INTO `session` VALUES ('k2tq18234kk18vsmbk4dv8ng90', '2017-09-27 17:28:25', '2017-09-27 17:28:25', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlA4MExLUkpLZFpKWmRTRnZRRVlNQmdGOVRYdmNYdTFwIjs=');
INSERT INTO `session` VALUES ('k53pli008egc9khutel6rs3d24', '2017-09-27 17:48:02', '2017-09-27 17:48:02', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InY3YVlrY2hjaDA1QzlDVkFsZVF4aVlld1FscW1RbmZ0Ijs=');
INSERT INTO `session` VALUES ('ka7pccrsvj1rud7603ja7ub7u0', '2017-09-27 17:46:18', '2017-09-27 17:46:18', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ill0WUo0TjZWVGJSM2RETWFSUTJaMjhTTklnN3ppQTJNIjs=');
INSERT INTO `session` VALUES ('kbuhnnl4lvoa7q9dl6ftk6quh0', '2017-09-27 17:43:50', '2017-09-27 17:43:50', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ik9kcDlrSm52U2k3UWNLVmRSamlDZ3hhd1p3RWllSUczIjs=');
INSERT INTO `session` VALUES ('kdf610403nok5erh62cv5vvjj1', '2017-09-27 17:35:39', '2017-09-27 17:35:39', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlZvQ0NsOVUwaXE1aGx5UmQzQ2JDR1FINFpKRjFUTjBrIjs=');
INSERT INTO `session` VALUES ('kdm5i8rirkpb01eorgqmp3i5h0', '2017-09-27 17:46:09', '2017-09-27 17:46:09', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Indha1NXNnRma2hMbTVGNXVTMVNLT09XRUFOSm1YTjBKIjs=');
INSERT INTO `session` VALUES ('kikvmdiiihhjf95f3uej7ijh60', '2017-09-27 17:35:12', '2017-09-27 17:35:12', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InNsWHE5eTRubHdUMFhiUTZYMlpQOEZhOE1HSUdrV0tEIjs=');
INSERT INTO `session` VALUES ('ld6gtjf2549i8lornbdle90gb3', '2017-09-27 17:45:59', '2017-09-27 17:45:59', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkZjang4aW1nTnVUVTlVeW9BM1FGa1Zld0NTUHBwYXpmIjs=');
INSERT INTO `session` VALUES ('li9b4eqq1lpg7n3vamis3ve884', '2017-10-25 15:54:07', '2017-10-25 15:54:07', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJpZF9JRCI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ijk2UXNiMm1raGVxTlc3R05jMmZOa0lyTmNqeUhUelMzIjs=');
INSERT INTO `session` VALUES ('lk7jdil40rqkqbocrr1rk0mth5', '2017-09-27 17:46:19', '2017-09-27 17:46:19', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImhiaWQyTUx0RmVZU09MVFl5TzY4c2lBZ3dUNm1PQzMxIjs=');
INSERT INTO `session` VALUES ('lkajinrl5ai7kq3lkvkriata21', '2017-11-07 13:35:37', '2017-11-07 13:35:37', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlBST2hadTMyaEJydjFsNDhFVld1T2pNcUJ0WXVvTFpRIjs=');
INSERT INTO `session` VALUES ('lre1k20uj9cl3p4vtiojs6r6v5', '2018-03-13 16:53:18', '2018-03-13 16:53:18', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJpZF9JRCI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkhPR1JwVlBLRVFXa2hzN2xqOWEySlZXMXlCRndPcDRnIjs=');
INSERT INTO `session` VALUES ('m2n7p2ng7pofjcvegdhv7p1i90', '2017-09-27 17:37:49', '2017-09-27 17:37:49', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InJQMWwxcmRrV0NQRXhNdlcycURhU2p6enpESTR4Y3pjIjs=');
INSERT INTO `session` VALUES ('m6f3vsgc3ohehch9ujm0nqq2r7', '2017-09-27 17:46:15', '2017-09-27 17:46:15', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlBwZThRVm9FZFRrSTRNaW8xaFBsenI3OWFEMmY3bmFBIjs=');
INSERT INTO `session` VALUES ('mer6tcijhfmflacceqpvu6mjt3', '2017-09-27 17:48:45', '2017-09-27 17:48:45', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlJranBMN2JRYXlvMjROcWhEZDMyTzF6MEkyck5YRXozIjs=');
INSERT INTO `session` VALUES ('mketcmklj8t63lft8c0ac2cuj0', '2017-09-27 17:29:33', '2017-09-27 17:29:33', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjRsQWwzOEpxVUxFYlpOSkk3MjBNY0M1RlpXeFNBdURXIjs=');
INSERT INTO `session` VALUES ('n9u7dav5d28u19adjtq27df2a5', '2017-09-27 17:46:21', '2017-09-27 17:46:21', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjI0REVBOXVwRDI5VVJXMXJ4RmthWXlxeGhQZXJ5WHpDIjs=');
INSERT INTO `session` VALUES ('nas4jrurqi5a4uus7r0r6btkf7', '2017-09-27 17:48:01', '2017-09-27 17:48:01', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImhQa2VMTDM2Q01YeDhTOXVHa0lxOVZxa3hvblI3NVVPIjs=');
INSERT INTO `session` VALUES ('ncmnk2d2t23nbo4g0bsfql30v5', '2017-09-27 17:29:36', '2017-09-27 17:29:36', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlRDUklWN1hwMnFMVW9LeWt5cDVqVkVYMGVoSmYzNTJtIjs=');
INSERT INTO `session` VALUES ('ne687frcr3uc9b8rtfireld491', '2017-09-27 17:45:02', '2017-09-27 17:45:02', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IlhHU2xWTE9wY3BjbXEybEdPdUhZUEprejJFN0xqNkE0Ijs=');
INSERT INTO `session` VALUES ('npm5r0oe1hgroc7jef5pep4lo0', '2017-09-27 17:35:22', '2017-09-27 17:35:22', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ilc0TmlzTXNKNkltSldIMGF5Z0E5bEJHNGRnWWwxM0RTIjs=');
INSERT INTO `session` VALUES ('ntjjrrtav9dbkhbuffc04krfb7', '2017-09-27 17:29:38', '2017-09-27 17:29:38', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7cmVxdWVzdF90b2tlbnxzOjMyOiJWYXVLOHVaUmoyZ3pYblgyRnNpS1RscElOOHBTdWFhdSI7');
INSERT INTO `session` VALUES ('o03hfqg9f4t0n499s6ohkg1qg0', '2017-09-27 17:32:41', '2017-09-27 17:32:41', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImtIc1E2aVdEdHE5V0c0b25QUWFxMEZSd0p3U1VRYmJNIjs=');
INSERT INTO `session` VALUES ('odpfomca17cv8c9al9qredes20', '2017-09-27 17:46:20', '2017-09-27 17:46:20', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkJyd0plTmFDZzNSQ2FHRHV5dTNQYkxJT1ZMUVNXdkMzIjs=');
INSERT INTO `session` VALUES ('oirtbjiq2d0k76r7op523kens3', '2017-09-27 17:48:49', '2017-09-27 17:48:49', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlFMdzdQa3VVajVhSUFuY2k1Y2MyYzBOZVJPMnJjdlNrIjs=');
INSERT INTO `session` VALUES ('on2u4v9pm1b5p5dlhej8lti927', '2017-09-27 17:46:21', '2017-09-27 17:46:21', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IjJsenNUQjh6elFja3ZpME8yTXM5MGNvZzdNUUJwV3BjIjs=');
INSERT INTO `session` VALUES ('p04ss970bienvl4iv8a68fpl27', '2017-09-27 17:31:55', '2017-09-27 17:31:55', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImxDU3R0TFl2eUxaZTNDWUlZZ1JzQWIyakZvcnFpak5uIjs=');
INSERT INTO `session` VALUES ('p84qh9op2jn3hphiq087g70tk4', '2017-09-27 17:44:56', '2017-09-27 17:44:56', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImZGQjZWdmdSNlNXSnBZVmV3dWFIQlhSMHkwVEhBRm8zIjs=');
INSERT INTO `session` VALUES ('pu4skt5h7fefplrqj1m5hvl4u2', '2017-09-27 17:37:08', '2017-09-27 17:37:08', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6InlicTNtc1NCYkVNVWlyVXV0ZjVDeVdzYlVFR0tVQzdFIjs=');
INSERT INTO `session` VALUES ('q38vuqjmcqi0hp99q6hglsg3n3', '2018-03-13 16:57:59', '2018-03-13 16:57:59', '::1', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjZMbEt2bjdKUXo5UEROV3QyT2ZERkZCMzdGZTNSOVRoIjs=');
INSERT INTO `session` VALUES ('q6cfritfv1oas71l35enr99l73', '2017-09-27 17:48:39', '2017-09-27 17:48:39', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlR0aXBkQ1F5cVlVVjRRaUlLR2ltN2RPck02REVCQVBLIjs=');
INSERT INTO `session` VALUES ('qh447l0iu4j2jt9o10n3ktfpn4', '2017-09-27 17:46:50', '2017-09-27 17:46:50', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IndYdmRJcncybExPemxiNWNUVGJNclNwQmVBZEpjYjdrIjs=');
INSERT INTO `session` VALUES ('qrbo1c3e2ffa4rtv1bicb8hcs2', '2017-09-27 17:47:06', '2017-09-27 17:47:06', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlNrTXo3TVdiRDFXd3pXM3ZZQ3Q0dW1JbEc3bTgxd1lzIjs=');
INSERT INTO `session` VALUES ('r0alr6dqh56mm8blbo95v9b7q7', '2017-11-06 13:50:55', '2017-11-06 13:50:55', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImJBRk1wYVpIZUJYQ2d0Znk2emNteFNiZHloTVF5WFMzIjs=');
INSERT INTO `session` VALUES ('r23ioeif1gjl3q50i0c39hhlp5', '2017-09-27 17:38:47', '2017-09-27 17:38:47', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImgxamU3UE9oajN2TmtTOFhpWHlvVU80WWxsM1RIdDR0Ijs=');
INSERT INTO `session` VALUES ('r2ma6tdrl5dudp5o7akt5ojl01', '2017-09-27 17:29:28', '2017-09-27 17:29:28', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Ik1SaWloOXBUTXZPSHB1dTYzd3VsTjRJdDBJdmhOR1gyIjs=');
INSERT INTO `session` VALUES ('rbo2t0fkfffe51a658ir6edus5', '2017-11-01 09:41:43', '2017-11-01 09:41:43', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6ImNocFNZUWNkTUdKTDdKaWhSTnRVVDNwVmJHSjJacWRqIjs=');
INSERT INTO `session` VALUES ('rempl5bplpueammt2764lbkpn4', '2017-09-27 17:46:16', '2017-09-27 17:46:16', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlF4SUdtRzlETENRbm1oeDRnRFNzbEJzZDUwSmFvTGx3Ijs=');
INSERT INTO `session` VALUES ('rptvhs6ud5l72bpsirljv6c6l7', '2017-09-27 17:44:56', '2017-09-27 17:44:56', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6InlkemlCYjJuQk42SkpmSlZZcE1HY2ttZ1dnQUZ2V2d2Ijs=');
INSERT INTO `session` VALUES ('s0htii0apov2605dlp1affcga7', '2017-09-27 17:37:37', '2017-09-27 17:37:37', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Imh2WU5QOFVZeWx4aTZqSHM5dkg1YnJDdFRkNzJJdnpYIjs=');
INSERT INTO `session` VALUES ('skoo29c21d4l7k6nrg8qbphe43', '2017-09-27 17:46:20', '2017-09-27 17:46:20', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkhOS0Q0NTQ3eGllWFdzczJzenNHSjJzRnE1U3dJZHB3Ijs=');
INSERT INTO `session` VALUES ('so2urm2t5k6sv7dbp1vj7mct70', '2017-09-27 17:44:00', '2017-09-27 17:44:00', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImNKNGhhYlZxNGIwZmNyeHA1WUJ4S3JsRmszR0U1Q29vIjs=');
INSERT INTO `session` VALUES ('svvb03ctmc4l5o88uf73ndo7a5', '2017-09-27 17:43:53', '2017-09-27 17:43:53', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImtBb0k5dGlpa2ZuN2JoMWJ4cDFiMnpyQ1FnTG14Rnh6Ijs=');
INSERT INTO `session` VALUES ('t7mqcol8dlcfft143kedkn2ld0', '2017-09-27 17:46:27', '2017-09-27 17:46:27', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IlZFaTNrSDJIMHdUaWZOT1pqc0pHblR3UzU5MHUzZU82Ijs=');
INSERT INTO `session` VALUES ('tbo8ro6keiabf03ullrdmk5t52', '2017-09-27 17:47:08', '2017-09-27 17:47:08', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Ildrd0J6Z1BkeDFHaldYRXJZb2lVZmJ6bGNaU0dablAxIjs=');
INSERT INTO `session` VALUES ('tk7vki7q47rg268fhb86k142t6', '2017-09-27 17:29:40', '2017-09-27 17:29:40', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6Im02U3huMjFmZnppRUo1ZTBpdWNXRUNWRDNITmJiY3dRIjs=');
INSERT INTO `session` VALUES ('tv7o8v565upkfqt8ngiovh2oa2', '2017-09-27 17:44:55', '2017-09-27 17:44:55', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6Im1qNnVsaExUdFFNMGhWMmhBYVFKWUxrckxCdDZka2x4Ijs=');
INSERT INTO `session` VALUES ('u2nmtn9pkm5adn6sbp6qrfms86', '2017-09-27 17:29:42', '2017-09-27 17:29:42', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6ImMxZzZ4dVIzSlZXTGEwMU5MUXNGYVF5akdTZkhCcnp1Ijs=');
INSERT INTO `session` VALUES ('u7h6qoak3t9tn1qjt0g320qmr0', '2017-09-27 17:45:25', '2017-09-27 17:45:25', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkpjRHdTb2NuaGJ3MkkxUjVJb29mblhPSHJlY0Q0dEFkIjs=');
INSERT INTO `session` VALUES ('u8cpu1o9b7rfks3cs9gaunbgn5', '2017-09-27 17:37:34', '2017-09-27 17:37:34', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkVidGx1MHJuQlRpRWcyOGhCT0NjTnZYdWhsVmgxRFlDIjs=');
INSERT INTO `session` VALUES ('ua76cpdpjmcnc4h19dgmkippn7', '2017-09-27 17:44:57', '2017-09-27 17:44:57', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IkhiUnVRQVhNS29KTU9OVEg5MGhtYUxqcDdoM2RuS2JxIjs=');
INSERT INTO `session` VALUES ('uh1prf2nr43cluok28jiiim866', '2017-09-27 17:30:37', '2017-09-27 17:30:37', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkxUdVpOUEd4bUEyZThsRGpLNkw5bThBN2d5ME1GNnpjIjs=');
INSERT INTO `session` VALUES ('v39p9ok5a7auogte4650oje983', '2017-09-27 17:29:39', '2017-09-27 17:29:39', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IkIydFF5MlMxR1pRanJBcWlvaGQxYmVkUW01eFN3dHJaIjs=');
INSERT INTO `session` VALUES ('vg4tjqv7op6flbdtj77h8tif60', '2017-09-27 17:46:24', '2017-09-27 17:46:24', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IndWM253bEdrYWFHQlRKN3V4emR3c0Fidk5OS1NPOGV1Ijs=');
INSERT INTO `session` VALUES ('vkffks34vo43pm1v0ica2tjiq7', '2017-09-27 17:37:35', '2017-09-27 17:37:35', '172.16.16.10', 'dGVtcHxiOjE7bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGFza3xzOjU6ImxvZ2luIjtyZXF1ZXN0X3Rva2VufHM6MzI6IjZmajFLSUxlc3oxWXdIdFlzcGo4M3RRWVVicnJLY3E3Ijs=');
INSERT INTO `session` VALUES ('vriuln0bd3t7sqdpqhvun4l5q3', '2017-09-27 17:45:43', '2017-09-27 17:45:43', '172.16.16.10', 'bGFuZ3VhZ2V8czo1OiJlbl9VUyI7dGVtcHxiOjE7c2tpbnxzOjU6ImxhcnJ5IjtyZXF1ZXN0X3Rva2VufHM6MzI6IllGbjc0NWVxVzJ3OGlsTXhJblV4RVlyeXU5aDNQVmJHIjs=');

-- ----------------------------
-- Table structure for system
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system
-- ----------------------------
INSERT INTO `system` VALUES ('roundcube-version', '2015111100');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mail_host` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime(0) NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_login` datetime(0) NULL DEFAULT NULL,
  `failed_login` datetime(0) NULL DEFAULT NULL,
  `failed_login_counter` int(10) UNSIGNED NULL DEFAULT NULL,
  `language` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `preferences` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `username`(`username`, `mail_host`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'rahmat@disperindag.jatimprov.go.id', 'localhost', '2017-03-15 09:18:50', '2017-03-23 06:43:09', '2018-03-13 11:44:51', 1, 'en_US', 'a:5:{s:8:\"timezone\";s:4:\"auto\";s:11:\"date_format\";s:5:\"d-m-Y\";s:4:\"skin\";s:5:\"larry\";s:9:\"date_long\";s:9:\"d-m-Y H:i\";s:11:\"client_hash\";s:32:\"1c609fe4b3d68dbff8c454df4c9ac770\";}');
INSERT INTO `users` VALUES (2, 'arya@disperindag.jatimprov.go.id', 'localhost', '2017-03-15 09:26:34', '2017-05-23 17:53:03', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"73f66c2415c9c91836abefb73c19fb2d\";}');
INSERT INTO `users` VALUES (3, 'bari@disperindag.jatimprov.go.id', 'localhost', '2017-03-15 10:04:15', '2017-03-15 10:04:15', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"71b323dd4420e92cee37475cc45fc386\";}');
INSERT INTO `users` VALUES (4, 'ruben@disperindag.jatimprov.go.id', 'localhost', '2017-03-16 14:35:16', '2017-03-16 14:35:16', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"38fdf18a5b5594c315a42491c722b8d1\";}');
INSERT INTO `users` VALUES (5, 'rahmatheruka@disperindag.jatimprov.go.id', 'localhost', '2017-03-29 12:27:52', '2017-05-26 06:58:44', '2017-05-18 06:43:56', 1, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"8dbecef4a130fd315e7b7841bc4fa9fe\";}');
INSERT INTO `users` VALUES (6, 'matt@disperindag.jatimprov.go.id', 'localhost', '2017-03-30 14:09:59', '2017-04-06 15:01:26', '2017-04-06 10:00:18', 1, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"bec589bb1e895aed9f071e0212b8cc63\";}');
INSERT INTO `users` VALUES (7, 'adedwi@disperindag.jatimprov.go.id', 'localhost', '2017-05-17 10:23:15', '2017-05-17 10:23:15', NULL, NULL, 'id_ID', 'a:1:{s:11:\"client_hash\";s:32:\"b8b6649f7bb2d7b883ac2666ae526137\";}');
INSERT INTO `users` VALUES (8, 'rosyid78@disperindag.jatimprov.go.id', 'localhost', '2017-05-23 10:04:45', '2017-05-23 10:04:45', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"7a931f1f574689edce4bc11a9c1e8da6\";}');
INSERT INTO `users` VALUES (9, 'rahmatheruka@disperindag.jatimprov.go.id', 'SERVER_DATA', '2017-05-26 15:16:40', '2017-09-26 16:54:34', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"8212f3fcb76f0cd1745d63157826bb57\";}');
INSERT INTO `users` VALUES (10, 'yasin@disperindag.jatimprov.go.id', 'SERVER_DATA', '2017-05-26 15:22:46', '2017-05-26 15:22:46', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"a7058dd6508c458590879c01592a8d61\";}');
INSERT INTO `users` VALUES (11, 'heruka@disperindag.jatimprov.go.id', 'SERVER_DATA', '2017-09-26 16:50:08', '2017-09-26 16:50:08', NULL, NULL, 'en_US', 'a:1:{s:11:\"client_hash\";s:32:\"b699cc70482fd26220c18aa84501ca79\";}');
INSERT INTO `users` VALUES (12, 'joni@disperindag.jatimprov.go.id', 'SERVER_DATA', '2017-10-27 16:13:55', '2017-12-18 10:35:25', '2017-12-18 04:34:42', 1, 'id_ID', 'a:1:{s:11:\"client_hash\";s:32:\"7540ce5b95b45b128e4f25b11597658e\";}');
INSERT INTO `users` VALUES (13, 'jono@disperindag.jatimprov.go.id', 'SERVER_DATA', '2017-12-18 10:45:37', '2017-12-18 10:45:37', NULL, NULL, 'id_ID', 'a:1:{s:11:\"client_hash\";s:32:\"92b63330050325863003853c1313d01c\";}');

SET FOREIGN_KEY_CHECKS = 1;
