/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL_LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100130
 Source Host           : localhost:3306
 Source Schema         : mail_server_disperindag

 Target Server Type    : MySQL
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 14/03/2018 12:10:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hm_account_profile
-- ----------------------------
DROP TABLE IF EXISTS `hm_account_profile`;
CREATE TABLE `hm_account_profile`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nip` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `subbag_id` int(11) NOT NULL,
  `email_alternatif` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `gender` tinyint(1) NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `in_time_agencies` date NULL DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not yet; 1=seen;',
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `account_id`(`account_id`, `bidang_id`, `subbag_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_account_profile
-- ----------------------------
INSERT INTO `hm_account_profile` VALUES (29, 10, 'PtUyOB1cfJEWlZ93-DiN875bQgP8aYli', '19780801-200312-1-009', 'Arya Pramudhita Pratidina Susetyo', 12, 28, 'arya.indagjatim@gmail.com', NULL, '081802402957', NULL, 1, '1978-08-01', '2003-12-01', 1, 1495121530);
INSERT INTO `hm_account_profile` VALUES (31, 12, 'Mlt_nMrpFKfxRSTg-yyvknXvCqCEGqA5', '19780920-201101-1-005', 'Nur Rosyid Wicaksono', 7, 13, 'nur.rosyid.wicaksono@gmail.com', NULL, '08121613204', NULL, 1, '1978-09-20', '2011-01-01', 1, 1495507553);
INSERT INTO `hm_account_profile` VALUES (33, 14, '2HvX3LXkvy_pOWswCD2i2KqBNZmA6ufo', '12319283-918391-8-239', 'rahmat', 24, 58, 'rahmatheruka@gmail.com', NULL, '082231023315', NULL, 8, '0000-00-00', '0000-00-00', 1, 1495756671);
INSERT INTO `hm_account_profile` VALUES (34, 15, 'i1WSUJsJ3OWwkpqcrH1UdUGP_s83QVgF', '11111111-111111-1-111', 'yasin abdullah', 12, 30, 'yasin.dl9@gmail.com', NULL, '0845213574', NULL, 1, '1111-11-11', '1111-11-01', 1, 1495786892);
INSERT INTO `hm_account_profile` VALUES (35, 16, '7jHhvTblfY50bV4OMjkhkaDPbV1bcacS', '53627282-828282-8-182', 'heruka', 9, 20, 'rahmatheruka@gmail.com', NULL, '09382827271', NULL, 8, '0000-00-00', '0000-00-00', 1, 1506419310);
INSERT INTO `hm_account_profile` VALUES (36, 17, 'vhXw3Prdm663xOoEOKXgi_6Wr_lZFwUs', '12122333-442323-3-322', 'Ade', 7, 13, 'trisanjaya_ruben@yahoo.com', NULL, '087891636123', NULL, 3, '0000-00-00', '0000-00-00', 1, 1506422375);

-- ----------------------------
-- Table structure for hm_accounts
-- ----------------------------
DROP TABLE IF EXISTS `hm_accounts`;
CREATE TABLE `hm_accounts`  (
  `accountid` int(11) NOT NULL AUTO_INCREMENT,
  `accountdomainid` int(11) NOT NULL,
  `accountadminlevel` tinyint(4) NOT NULL,
  `accountaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountpassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountactive` tinyint(4) NOT NULL,
  `accountisad` tinyint(4) NOT NULL,
  `accountaddomain` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountadusername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountmaxsize` int(11) NOT NULL,
  `accountvacationmessageon` tinyint(4) NOT NULL,
  `accountvacationmessage` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountvacationsubject` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountpwencryption` tinyint(4) NOT NULL,
  `accountforwardenabled` tinyint(4) NOT NULL,
  `accountforwardaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountforwardkeeporiginal` tinyint(4) NOT NULL,
  `accountenablesignature` tinyint(4) NOT NULL,
  `accountsignatureplaintext` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountsignaturehtml` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountlastlogontime` datetime(0) NOT NULL,
  `accountvacationexpires` tinyint(3) UNSIGNED NOT NULL,
  `accountvacationexpiredate` datetime(0) NOT NULL,
  `accountpersonfirstname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `accountpersonlastname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`accountid`) USING BTREE,
  UNIQUE INDEX `accountid`(`accountid`) USING BTREE,
  UNIQUE INDEX `accountaddress`(`accountaddress`) USING BTREE,
  INDEX `idx_hm_accounts`(`accountaddress`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_accounts
-- ----------------------------
INSERT INTO `hm_accounts` VALUES (10, 1, 0, 'arya@disperindag.jatimprov.go.id', '7feec3f4287b93c5f40fd7e31a244b94', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '2017-05-23 17:54:10', 0, '2017-05-18 00:00:00', 'Arya', 'Pramudhita');
INSERT INTO `hm_accounts` VALUES (12, 1, 0, 'rosyid78@disperindag.jatimprov.go.id', '384f207fb035db84e67c7e7b9b8ccf21', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '2017-05-23 10:14:19', 0, '2017-05-23 00:00:00', 'Nur', 'Rosyid');
INSERT INTO `hm_accounts` VALUES (14, 1, 0, 'rahmatheruka@disperindag.jatimprov.go.id', 'f0174740237ae919fd160b76cc9576e7', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '2017-09-26 16:54:36', 0, '2017-05-26 00:00:00', 'rahmat', '');
INSERT INTO `hm_accounts` VALUES (15, 1, 0, 'yasin@disperindag.jatimprov.go.id', '1554698cdf30a005f0b69228c54f3155', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '2017-05-26 15:24:02', 0, '2017-05-26 00:00:00', 'yasin', 'abdullah');
INSERT INTO `hm_accounts` VALUES (16, 1, 0, 'heruka@disperindag.jatimprov.go.id', 'f0174740237ae919fd160b76cc9576e7', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '2017-09-26 16:54:08', 0, '2017-09-26 00:00:00', 'heruka', '');
INSERT INTO `hm_accounts` VALUES (17, 1, 0, 'ade@disperindag.jatimprov.go.id', '626e1abef816473b9397bff6972f57e0', 1, 0, '', '', 20000, 0, '', '', 2, 0, '', 0, 0, '', '', '0000-00-00 00:00:00', 0, '2017-09-28 00:00:00', 'Ade', '');
INSERT INTO `hm_accounts` VALUES (18, 1, 0, 'joni@disperindag.jatimprov.go.id', '4d43a59f549e1c95cc75aeb922c8905920f397bc4a5e08b6db300305414702a7d23c0c', 1, 0, '', '', 99999, 0, '', '', 3, 0, '', 0, 0, '', '', '2017-12-18 11:54:28', 0, '2017-12-18 00:00:00', '', '');
INSERT INTO `hm_accounts` VALUES (19, 1, 0, 'jono@disperindag.jatimprov.go.id', '3aa6d38e0bc87d15f919e9d0b907f83f866f30e50ef2b753fc4603a314764b85a5fa30', 1, 0, '', '', 0, 0, '', '', 3, 0, '', 0, 0, '', '', '2017-12-18 10:49:08', 0, '2017-12-18 00:00:00', '', '');

-- ----------------------------
-- Table structure for hm_acl
-- ----------------------------
DROP TABLE IF EXISTS `hm_acl`;
CREATE TABLE `hm_acl`  (
  `aclid` bigint(20) NOT NULL AUTO_INCREMENT,
  `aclsharefolderid` bigint(20) NOT NULL,
  `aclpermissiontype` tinyint(4) NOT NULL,
  `aclpermissiongroupid` bigint(20) NOT NULL,
  `aclpermissionaccountid` bigint(20) NOT NULL,
  `aclvalue` bigint(20) NOT NULL,
  PRIMARY KEY (`aclid`) USING BTREE,
  UNIQUE INDEX `aclid`(`aclid`) USING BTREE,
  UNIQUE INDEX `aclsharefolderid`(`aclsharefolderid`, `aclpermissiontype`, `aclpermissiongroupid`, `aclpermissionaccountid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_aliases
-- ----------------------------
DROP TABLE IF EXISTS `hm_aliases`;
CREATE TABLE `hm_aliases`  (
  `aliasid` int(11) NOT NULL AUTO_INCREMENT,
  `aliasdomainid` int(11) NOT NULL,
  `aliasname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aliasvalue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aliasactive` tinyint(4) NOT NULL,
  PRIMARY KEY (`aliasid`) USING BTREE,
  UNIQUE INDEX `aliasid`(`aliasid`) USING BTREE,
  UNIQUE INDEX `aliasname`(`aliasname`) USING BTREE,
  INDEX `idx_hm_aliases`(`aliasdomainid`, `aliasname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_blocked_attachments
-- ----------------------------
DROP TABLE IF EXISTS `hm_blocked_attachments`;
CREATE TABLE `hm_blocked_attachments`  (
  `baid` bigint(20) NOT NULL AUTO_INCREMENT,
  `bawildcard` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `badescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`baid`) USING BTREE,
  UNIQUE INDEX `baid`(`baid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_blocked_attachments
-- ----------------------------
INSERT INTO `hm_blocked_attachments` VALUES (1, '*.bat', 'Batch processing file');
INSERT INTO `hm_blocked_attachments` VALUES (2, '*.cmd', 'Command file for Windows NT');
INSERT INTO `hm_blocked_attachments` VALUES (3, '*.com', 'Command');
INSERT INTO `hm_blocked_attachments` VALUES (4, '*.cpl', 'Windows Control Panel extension');
INSERT INTO `hm_blocked_attachments` VALUES (5, '*.csh', 'CSH script');
INSERT INTO `hm_blocked_attachments` VALUES (6, '*.exe', 'Executable file');
INSERT INTO `hm_blocked_attachments` VALUES (7, '*.inf', 'Setup file');
INSERT INTO `hm_blocked_attachments` VALUES (8, '*.lnk', 'Windows link file');
INSERT INTO `hm_blocked_attachments` VALUES (9, '*.msi', 'Windows Installer file');
INSERT INTO `hm_blocked_attachments` VALUES (10, '*.msp', 'Windows Installer patch');
INSERT INTO `hm_blocked_attachments` VALUES (11, '*.pif', 'Program Information file');
INSERT INTO `hm_blocked_attachments` VALUES (12, '*.reg', 'Registration key');
INSERT INTO `hm_blocked_attachments` VALUES (13, '*.scf', 'Windows Explorer command');
INSERT INTO `hm_blocked_attachments` VALUES (14, '*.scr', 'Windows Screen saver');

-- ----------------------------
-- Table structure for hm_dbversion
-- ----------------------------
DROP TABLE IF EXISTS `hm_dbversion`;
CREATE TABLE `hm_dbversion`  (
  `value` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_dbversion
-- ----------------------------
INSERT INTO `hm_dbversion` VALUES (5601);

-- ----------------------------
-- Table structure for hm_distributionlists
-- ----------------------------
DROP TABLE IF EXISTS `hm_distributionlists`;
CREATE TABLE `hm_distributionlists`  (
  `distributionlistid` int(11) NOT NULL AUTO_INCREMENT,
  `distributionlistdomainid` int(11) NOT NULL,
  `distributionlistaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `distributionlistenabled` tinyint(4) NOT NULL,
  `distributionlistrequireauth` tinyint(4) NOT NULL,
  `distributionlistrequireaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `distributionlistmode` tinyint(4) NOT NULL,
  PRIMARY KEY (`distributionlistid`) USING BTREE,
  UNIQUE INDEX `distributionlistid`(`distributionlistid`) USING BTREE,
  UNIQUE INDEX `distributionlistaddress`(`distributionlistaddress`) USING BTREE,
  INDEX `idx_hm_distributionlists`(`distributionlistdomainid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_distributionlistsrecipients
-- ----------------------------
DROP TABLE IF EXISTS `hm_distributionlistsrecipients`;
CREATE TABLE `hm_distributionlistsrecipients`  (
  `distributionlistrecipientid` int(11) NOT NULL AUTO_INCREMENT,
  `distributionlistrecipientlistid` int(11) NOT NULL,
  `distributionlistrecipientaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`distributionlistrecipientid`) USING BTREE,
  UNIQUE INDEX `distributionlistrecipientid`(`distributionlistrecipientid`) USING BTREE,
  INDEX `idx_hm_distributionlistsrecipients`(`distributionlistrecipientlistid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_dnsbl
-- ----------------------------
DROP TABLE IF EXISTS `hm_dnsbl`;
CREATE TABLE `hm_dnsbl`  (
  `sblid` int(11) NOT NULL AUTO_INCREMENT,
  `sblactive` tinyint(4) NOT NULL,
  `sbldnshost` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sblresult` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sblrejectmessage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sblscore` int(11) NOT NULL,
  PRIMARY KEY (`sblid`) USING BTREE,
  UNIQUE INDEX `sblid`(`sblid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_dnsbl
-- ----------------------------
INSERT INTO `hm_dnsbl` VALUES (1, 0, 'zen.spamhaus.org', '127.0.0.2-8|127.0.0.10-11', 'Rejected by Spamhaus.', 3);
INSERT INTO `hm_dnsbl` VALUES (2, 0, 'bl.spamcop.net', '127.0.0.2', 'Rejected by SpamCop.', 3);

-- ----------------------------
-- Table structure for hm_domain_aliases
-- ----------------------------
DROP TABLE IF EXISTS `hm_domain_aliases`;
CREATE TABLE `hm_domain_aliases`  (
  `daid` int(11) NOT NULL AUTO_INCREMENT,
  `dadomainid` int(11) NOT NULL,
  `daalias` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`daid`) USING BTREE,
  UNIQUE INDEX `daid`(`daid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_domains
-- ----------------------------
DROP TABLE IF EXISTS `hm_domains`;
CREATE TABLE `hm_domains`  (
  `domainid` int(11) NOT NULL AUTO_INCREMENT,
  `domainname` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainactive` tinyint(4) NOT NULL,
  `domainpostmaster` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainmaxsize` int(11) NOT NULL,
  `domainaddomain` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainmaxmessagesize` int(11) NOT NULL,
  `domainuseplusaddressing` tinyint(4) NOT NULL,
  `domainplusaddressingchar` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainantispamoptions` int(11) NOT NULL,
  `domainenablesignature` tinyint(4) NOT NULL,
  `domainsignaturemethod` tinyint(4) NOT NULL,
  `domainsignatureplaintext` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainsignaturehtml` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domainaddsignaturestoreplies` tinyint(4) NOT NULL,
  `domainaddsignaturestolocalemail` tinyint(4) NOT NULL,
  `domainmaxnoofaccounts` int(11) NOT NULL,
  `domainmaxnoofaliases` int(11) NOT NULL,
  `domainmaxnoofdistributionlists` int(11) NOT NULL,
  `domainlimitationsenabled` int(11) NOT NULL,
  `domainmaxaccountsize` int(11) NOT NULL,
  `domaindkimselector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `domaindkimprivatekeyfile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`domainid`) USING BTREE,
  UNIQUE INDEX `domainid`(`domainid`) USING BTREE,
  UNIQUE INDEX `domainname`(`domainname`) USING BTREE,
  INDEX `idx_hm_domains`(`domainname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_domains
-- ----------------------------
INSERT INTO `hm_domains` VALUES (1, 'disperindag.jatimprov.go.id', 1, '', 0, '', 0, 0, '', 0, 0, 1, 'Dinas Peridustrian dan Perdagangan Jawa Timur', '', 1, 1, 0, 0, 0, 0, 0, '', '');

-- ----------------------------
-- Table structure for hm_fetchaccounts
-- ----------------------------
DROP TABLE IF EXISTS `hm_fetchaccounts`;
CREATE TABLE `hm_fetchaccounts`  (
  `faid` int(11) NOT NULL AUTO_INCREMENT,
  `faactive` tinyint(4) NOT NULL,
  `faaccountid` int(11) NOT NULL,
  `faaccountname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `faserveraddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `faserverport` int(11) NOT NULL,
  `faservertype` tinyint(4) NOT NULL,
  `fausername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fapassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `faminutes` int(11) NOT NULL,
  `fanexttry` datetime(0) NOT NULL,
  `fadaystokeep` int(11) NOT NULL,
  `falocked` tinyint(4) NOT NULL,
  `faprocessmimerecipients` tinyint(4) NOT NULL,
  `faprocessmimedate` tinyint(4) NOT NULL,
  `faconnectionsecurity` tinyint(4) NOT NULL,
  `fauseantispam` tinyint(4) NOT NULL,
  `fauseantivirus` tinyint(4) NOT NULL,
  `faenablerouterecipients` tinyint(4) NOT NULL,
  PRIMARY KEY (`faid`) USING BTREE,
  UNIQUE INDEX `faid`(`faid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_fetchaccounts_uids
-- ----------------------------
DROP TABLE IF EXISTS `hm_fetchaccounts_uids`;
CREATE TABLE `hm_fetchaccounts_uids`  (
  `uidid` int(11) NOT NULL AUTO_INCREMENT,
  `uidfaid` int(11) NOT NULL,
  `uidvalue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uidtime` datetime(0) NOT NULL,
  PRIMARY KEY (`uidid`) USING BTREE,
  UNIQUE INDEX `uidid`(`uidid`) USING BTREE,
  INDEX `idx_hm_fetchaccounts_uids`(`uidfaid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_greylisting_triplets
-- ----------------------------
DROP TABLE IF EXISTS `hm_greylisting_triplets`;
CREATE TABLE `hm_greylisting_triplets`  (
  `glid` bigint(20) NOT NULL AUTO_INCREMENT,
  `glcreatetime` datetime(0) NOT NULL,
  `glblockendtime` datetime(0) NOT NULL,
  `gldeletetime` datetime(0) NOT NULL,
  `glipaddress1` bigint(20) NOT NULL,
  `glipaddress2` bigint(20) NULL DEFAULT NULL,
  `glsenderaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `glrecipientaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `glblockedcount` int(11) NOT NULL,
  `glpassedcount` int(11) NOT NULL,
  PRIMARY KEY (`glid`) USING BTREE,
  UNIQUE INDEX `glid`(`glid`) USING BTREE,
  INDEX `idx_greylisting_triplets`(`glipaddress1`, `glipaddress2`, `glsenderaddress`(40), `glrecipientaddress`(40)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_greylisting_whiteaddresses
-- ----------------------------
DROP TABLE IF EXISTS `hm_greylisting_whiteaddresses`;
CREATE TABLE `hm_greylisting_whiteaddresses`  (
  `whiteid` bigint(20) NOT NULL AUTO_INCREMENT,
  `whiteipaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `whiteipdescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`whiteid`) USING BTREE,
  UNIQUE INDEX `whiteid`(`whiteid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_group_members
-- ----------------------------
DROP TABLE IF EXISTS `hm_group_members`;
CREATE TABLE `hm_group_members`  (
  `memberid` bigint(20) NOT NULL AUTO_INCREMENT,
  `membergroupid` bigint(20) NOT NULL,
  `memberaccountid` bigint(20) NOT NULL,
  PRIMARY KEY (`memberid`) USING BTREE,
  UNIQUE INDEX `memberid`(`memberid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_groups
-- ----------------------------
DROP TABLE IF EXISTS `hm_groups`;
CREATE TABLE `hm_groups`  (
  `groupid` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`groupid`) USING BTREE,
  UNIQUE INDEX `groupid`(`groupid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_imapfolders
-- ----------------------------
DROP TABLE IF EXISTS `hm_imapfolders`;
CREATE TABLE `hm_imapfolders`  (
  `folderid` int(11) NOT NULL AUTO_INCREMENT,
  `folderaccountid` int(10) UNSIGNED NOT NULL,
  `folderparentid` int(11) NOT NULL,
  `foldername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `folderissubscribed` tinyint(3) UNSIGNED NOT NULL,
  `foldercreationtime` datetime(0) NOT NULL,
  `foldercurrentuid` bigint(20) NOT NULL,
  PRIMARY KEY (`folderid`) USING BTREE,
  UNIQUE INDEX `folderid`(`folderid`) USING BTREE,
  UNIQUE INDEX `idx_hm_imapfolders_unique`(`folderaccountid`, `folderparentid`, `foldername`) USING BTREE,
  INDEX `idx_hm_imapfolders`(`folderaccountid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_imapfolders
-- ----------------------------
INSERT INTO `hm_imapfolders` VALUES (34, 10, -1, 'INBOX', 1, '2017-05-18 17:32:10', 1);
INSERT INTO `hm_imapfolders` VALUES (35, 10, -1, 'Drafts', 1, '2017-05-18 22:35:59', 0);
INSERT INTO `hm_imapfolders` VALUES (36, 10, -1, 'Sent', 1, '2017-05-18 22:35:59', 2);
INSERT INTO `hm_imapfolders` VALUES (37, 10, -1, 'Junk', 1, '2017-05-18 22:35:59', 0);
INSERT INTO `hm_imapfolders` VALUES (38, 10, -1, 'Trash', 1, '2017-05-18 22:35:59', 0);
INSERT INTO `hm_imapfolders` VALUES (40, 12, -1, 'INBOX', 1, '2017-05-23 04:45:53', 1);
INSERT INTO `hm_imapfolders` VALUES (42, 12, -1, 'Drafts', 1, '2017-05-23 10:04:45', 0);
INSERT INTO `hm_imapfolders` VALUES (43, 12, -1, 'Sent', 1, '2017-05-23 10:04:45', 0);
INSERT INTO `hm_imapfolders` VALUES (44, 12, -1, 'Junk', 1, '2017-05-23 10:04:45', 0);
INSERT INTO `hm_imapfolders` VALUES (45, 12, -1, 'Trash', 1, '2017-05-23 10:04:45', 0);
INSERT INTO `hm_imapfolders` VALUES (46, 14, -1, 'INBOX', 1, '2017-05-26 01:57:51', 3);
INSERT INTO `hm_imapfolders` VALUES (47, 14, -1, 'Drafts', 1, '2017-05-26 06:58:44', 0);
INSERT INTO `hm_imapfolders` VALUES (48, 14, -1, 'Sent', 1, '2017-05-26 06:58:44', 2);
INSERT INTO `hm_imapfolders` VALUES (49, 14, -1, 'Junk', 1, '2017-05-26 06:58:44', 0);
INSERT INTO `hm_imapfolders` VALUES (50, 14, -1, 'Trash', 1, '2017-05-26 06:58:44', 0);
INSERT INTO `hm_imapfolders` VALUES (51, 15, -1, 'INBOX', 1, '2017-05-26 10:21:32', 1);
INSERT INTO `hm_imapfolders` VALUES (52, 15, -1, 'Drafts', 1, '2017-05-26 15:22:46', 0);
INSERT INTO `hm_imapfolders` VALUES (53, 15, -1, 'Sent', 1, '2017-05-26 15:22:47', 1);
INSERT INTO `hm_imapfolders` VALUES (54, 15, -1, 'Junk', 1, '2017-05-26 15:22:47', 0);
INSERT INTO `hm_imapfolders` VALUES (55, 15, -1, 'Trash', 1, '2017-05-26 15:22:47', 0);
INSERT INTO `hm_imapfolders` VALUES (56, 16, -1, 'INBOX', 1, '2017-09-26 11:48:30', 0);
INSERT INTO `hm_imapfolders` VALUES (57, 16, -1, 'Drafts', 1, '2017-09-26 16:50:08', 0);
INSERT INTO `hm_imapfolders` VALUES (58, 16, -1, 'Sent', 1, '2017-09-26 16:50:08', 2);
INSERT INTO `hm_imapfolders` VALUES (59, 16, -1, 'Junk', 1, '2017-09-26 16:50:08', 0);
INSERT INTO `hm_imapfolders` VALUES (60, 16, -1, 'Trash', 1, '2017-09-26 16:50:08', 0);
INSERT INTO `hm_imapfolders` VALUES (61, 17, -1, 'INBOX', 1, '2017-09-26 12:39:35', 0);
INSERT INTO `hm_imapfolders` VALUES (62, 18, -1, 'INBOX', 1, '2017-10-27 16:13:08', 1);
INSERT INTO `hm_imapfolders` VALUES (63, 18, -1, 'Drafts', 1, '2017-10-27 16:13:55', 0);
INSERT INTO `hm_imapfolders` VALUES (64, 18, -1, 'Sent', 1, '2017-10-27 16:13:55', 2);
INSERT INTO `hm_imapfolders` VALUES (65, 18, -1, 'Junk', 1, '2017-10-27 16:13:55', 0);
INSERT INTO `hm_imapfolders` VALUES (66, 18, -1, 'Trash', 1, '2017-10-27 16:13:55', 0);
INSERT INTO `hm_imapfolders` VALUES (67, 19, -1, 'INBOX', 1, '2017-12-18 10:45:18', 0);
INSERT INTO `hm_imapfolders` VALUES (68, 19, -1, 'Drafts', 1, '2017-12-18 10:45:37', 0);
INSERT INTO `hm_imapfolders` VALUES (69, 19, -1, 'Sent', 1, '2017-12-18 10:45:37', 1);
INSERT INTO `hm_imapfolders` VALUES (70, 19, -1, 'Junk', 1, '2017-12-18 10:45:37', 0);
INSERT INTO `hm_imapfolders` VALUES (71, 19, -1, 'Trash', 1, '2017-12-18 10:45:38', 0);

-- ----------------------------
-- Table structure for hm_incoming_relays
-- ----------------------------
DROP TABLE IF EXISTS `hm_incoming_relays`;
CREATE TABLE `hm_incoming_relays`  (
  `relayid` int(11) NOT NULL AUTO_INCREMENT,
  `relayname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `relaylowerip1` bigint(20) NOT NULL,
  `relaylowerip2` bigint(20) NULL DEFAULT NULL,
  `relayupperip1` bigint(20) NOT NULL,
  `relayupperip2` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`relayid`) USING BTREE,
  UNIQUE INDEX `relayid`(`relayid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_logon_failures
-- ----------------------------
DROP TABLE IF EXISTS `hm_logon_failures`;
CREATE TABLE `hm_logon_failures`  (
  `ipaddress1` bigint(20) NOT NULL,
  `ipaddress2` bigint(20) NULL DEFAULT NULL,
  `failuretime` datetime(0) NOT NULL,
  INDEX `idx_hm_logon_failures_ipaddress`(`ipaddress1`, `ipaddress2`) USING BTREE,
  INDEX `idx_hm_logon_failures_failuretime`(`failuretime`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_message_metadata
-- ----------------------------
DROP TABLE IF EXISTS `hm_message_metadata`;
CREATE TABLE `hm_message_metadata`  (
  `metadata_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `metadata_accountid` int(11) NOT NULL,
  `metadata_folderid` int(11) NOT NULL,
  `metadata_messageid` bigint(20) NOT NULL,
  `metadata_dateutc` datetime(0) NULL DEFAULT NULL,
  `metadata_from` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `metadata_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `metadata_to` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `metadata_cc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`metadata_id`) USING BTREE,
  UNIQUE INDEX `idx_message_metadata_unique`(`metadata_accountid`, `metadata_folderid`, `metadata_messageid`) USING BTREE,
  INDEX `idx_message_metadata_id`(`metadata_messageid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_messagerecipients
-- ----------------------------
DROP TABLE IF EXISTS `hm_messagerecipients`;
CREATE TABLE `hm_messagerecipients`  (
  `recipientid` bigint(20) NOT NULL AUTO_INCREMENT,
  `recipientmessageid` bigint(20) NOT NULL,
  `recipientaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recipientlocalaccountid` int(11) NOT NULL,
  `recipientoriginaladdress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`recipientid`) USING BTREE,
  UNIQUE INDEX `recipientid`(`recipientid`) USING BTREE,
  INDEX `idx_hm_messagerecipients`(`recipientmessageid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_messages
-- ----------------------------
DROP TABLE IF EXISTS `hm_messages`;
CREATE TABLE `hm_messages`  (
  `messageid` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageaccountid` int(11) NOT NULL,
  `messagefolderid` int(11) NOT NULL DEFAULT 0,
  `messagefilename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `messagetype` tinyint(4) NOT NULL,
  `messagefrom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `messagesize` bigint(20) NOT NULL,
  `messagecurnooftries` int(11) NOT NULL,
  `messagenexttrytime` datetime(0) NOT NULL,
  `messageflags` tinyint(4) NOT NULL,
  `messagecreatetime` datetime(0) NOT NULL,
  `messagelocked` tinyint(4) NOT NULL,
  `messageuid` bigint(20) NOT NULL,
  PRIMARY KEY (`messageid`) USING BTREE,
  UNIQUE INDEX `messageid`(`messageid`) USING BTREE,
  INDEX `idx_hm_messages`(`messageaccountid`, `messagefolderid`) USING BTREE,
  INDEX `idx_hm_messages_type`(`messagetype`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_messages
-- ----------------------------
INSERT INTO `hm_messages` VALUES (6, 1, 3, '{B39F7949-52D2-47C2-85E7-8BAEDB99A107}.eml', 2, '', 204619, 0, '1901-01-01 00:00:00', 1, '2017-03-15 09:51:40', 0, 3);
INSERT INTO `hm_messages` VALUES (7, 3, 7, '{999D1BEF-60A2-4189-8985-C6A3688F47D6}.eml', 2, '', 204615, 0, '1901-01-01 00:00:00', 33, '2017-03-15 10:07:41', 0, 1);
INSERT INTO `hm_messages` VALUES (8, 1, 3, '{FF9BA6A6-9264-4504-97AC-FC21201F612C}.eml', 2, '', 410, 0, '1901-01-01 00:00:00', 33, '2017-03-15 10:43:15', 0, 4);
INSERT INTO `hm_messages` VALUES (9, 2, 2, '{70CA6C8D-9200-4AA6-9586-15D851964E5C}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 425, 0, '1901-01-01 00:00:00', 96, '2017-03-16 12:48:40', 1, 1);
INSERT INTO `hm_messages` VALUES (12, 2, 2, '{991B58C4-EE36-47AD-8EFC-09FD0D0C13C0}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 26005, 0, '1901-01-01 00:00:00', 65, '2017-03-16 12:50:03', 0, 3);
INSERT INTO `hm_messages` VALUES (13, 1, 3, '{84E71767-DBEA-4B2B-9FE3-DAF8A7F6A5B9}.eml', 2, '', 25858, 0, '1901-01-01 00:00:00', 33, '2017-03-16 12:50:04', 0, 5);
INSERT INTO `hm_messages` VALUES (15, 1, 1, '{17B7035B-D9D2-4797-9A68-0CCC27D6F552}.eml', 2, 'arya@disperindag.jatimprov.go.id', 26037, 0, '1901-01-01 00:00:00', 65, '2017-03-16 13:34:53', 0, 1);
INSERT INTO `hm_messages` VALUES (16, 2, 4, '{72F4422B-4DBC-4200-890F-F7B4014133E3}.eml', 2, '', 25890, 0, '1901-01-01 00:00:00', 33, '2017-03-16 13:34:55', 0, 3);
INSERT INTO `hm_messages` VALUES (17, 1, 9, '{C571EDEE-DA10-4AE1-BE5C-C0C2CB7B504B}.eml', 2, '', 204645, 0, '1901-01-01 00:00:00', 33, '2017-03-15 09:32:32', 0, 1);
INSERT INTO `hm_messages` VALUES (19, 2, 13, '{4F3E171A-E16B-4507-B5BA-FA906DA8A8FF}.eml', 2, '', 402, 0, '1901-01-01 00:00:00', 33, '2017-03-16 14:33:21', 0, 1);
INSERT INTO `hm_messages` VALUES (20, 2, 16, '{026F2079-AFD5-4B06-BF82-76E6E790EFBB}.eml', 2, '', 204618, 0, '1901-01-01 00:00:00', 33, '2017-03-15 09:28:24', 0, 1);
INSERT INTO `hm_messages` VALUES (21, 2, 16, '{549BFFFC-BE1A-4157-97B5-5CF395BFDD2E}.eml', 2, '', 1273531, 0, '1901-01-01 00:00:00', 33, '2017-03-15 09:29:20', 0, 2);
INSERT INTO `hm_messages` VALUES (23, 2, 2, '{4B39D78A-4FA9-43D2-8008-EA6F0990D23B}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 46858, 0, '1901-01-01 00:00:00', 96, '2017-03-16 15:30:11', 0, 4);
INSERT INTO `hm_messages` VALUES (24, 3, 6, '{C788ABB0-B0AE-42D6-B569-4E48FA5F47CA}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 46858, 0, '1901-01-01 00:00:00', 96, '2017-03-16 15:30:11', 0, 1);
INSERT INTO `hm_messages` VALUES (25, 1, 3, '{782C09EE-2C14-41FB-BA0D-20251C5C0335}.eml', 2, '', 46750, 0, '1901-01-01 00:00:00', 33, '2017-03-16 15:30:12', 0, 6);
INSERT INTO `hm_messages` VALUES (26, 2, 16, '{F07F1F34-6A17-4DDF-B964-1D7CF5E24F8E}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 426, 0, '1901-01-01 00:00:00', 97, '2017-03-16 12:48:49', 0, 3);
INSERT INTO `hm_messages` VALUES (28, 2, 2, '{2D172D97-2F53-4E76-8E2E-8EEC55EE56C8}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 3329, 0, '1901-01-01 00:00:00', 65, '2017-03-16 17:04:22', 0, 5);
INSERT INTO `hm_messages` VALUES (29, 1, 3, '{A21B2148-8D0F-4840-9E08-D5E85E1F2836}.eml', 2, '', 3195, 0, '1901-01-01 00:00:00', 33, '2017-03-16 17:04:23', 0, 7);
INSERT INTO `hm_messages` VALUES (31, 1, 3, '{8CDD9643-D626-4648-B607-A6BFA4CE2411}.eml', 2, '', 3228, 0, '1901-01-01 00:00:00', 33, '2017-03-16 17:42:33', 0, 8);
INSERT INTO `hm_messages` VALUES (33, 1, 3, '{728338D0-2676-414E-99DB-5F93173E7EFE}.eml', 2, '', 3208, 0, '1901-01-01 00:00:00', 33, '2017-03-16 17:46:03', 0, 9);
INSERT INTO `hm_messages` VALUES (35, 2, 2, '{D54F3AD9-CCEB-4C4E-8511-BF59E15B03B1}.eml', 2, 'rahmat@disperindag.jatimprov.go.id', 3427, 0, '1901-01-01 00:00:00', 96, '2017-03-16 17:52:01', 0, 6);
INSERT INTO `hm_messages` VALUES (36, 1, 3, '{B1D85E01-C07B-4968-A2E4-DDBF99E0E15E}.eml', 2, '', 3319, 0, '1901-01-01 00:00:00', 33, '2017-03-16 17:52:02', 0, 10);
INSERT INTO `hm_messages` VALUES (38, 2, 4, '{76A9DC5B-859A-4C07-8824-6AE42B40FED1}.eml', 2, '', 413, 0, '1901-01-01 00:00:00', 33, '2017-03-16 17:54:29', 0, 4);
INSERT INTO `hm_messages` VALUES (41, 1, 1, '{82CEAB07-7A4F-4D2C-8548-42300290384F}.eml', 2, 'arya@disperindag.jatimprov.go.id', 46756, 0, '1901-01-01 00:00:00', 65, '2017-03-20 14:13:09', 0, 2);
INSERT INTO `hm_messages` VALUES (42, 2, 4, '{8DC6EACA-D27D-4EC1-8A56-3AC6DC9313C6}.eml', 2, '', 46609, 0, '1901-01-01 00:00:00', 33, '2017-03-20 14:13:10', 0, 5);
INSERT INTO `hm_messages` VALUES (45, 1, 1, '{34275C06-BA90-44D2-B157-CA90956FD734}.eml', 2, 'arya@disperindag.jatimprov.go.id', 15232, 0, '1901-01-01 00:00:00', 65, '2017-03-20 16:13:09', 0, 3);
INSERT INTO `hm_messages` VALUES (46, 2, 4, '{C630944F-5D2C-422E-B29C-23FCF44AFF53}.eml', 2, '', 15085, 0, '1901-01-01 00:00:00', 33, '2017-03-20 16:13:11', 0, 6);
INSERT INTO `hm_messages` VALUES (48, 1, 3, '{16EA85FC-0760-422F-857E-65B6AAD14F99}.eml', 2, '', 15133, 0, '1901-01-01 00:00:00', 33, '2017-03-21 14:51:23', 0, 11);
INSERT INTO `hm_messages` VALUES (50, 1, 3, '{02183922-775F-4F89-8959-8103D21A6087}.eml', 2, '', 467, 0, '1901-01-01 00:00:00', 33, '2017-03-21 14:57:48', 0, 12);
INSERT INTO `hm_messages` VALUES (52, 5, 19, '{7526C4F8-F823-4EBC-AE31-AC0601E3E89A}.eml', 2, '', 467, 0, '1901-01-01 00:00:00', 33, '2017-05-18 11:47:26', 0, 1);
INSERT INTO `hm_messages` VALUES (54, 10, 36, '{103F7AB5-4ECF-4049-B89F-764C179A7EB3}.eml', 2, '', 591, 0, '1901-01-01 00:00:00', 33, '2017-05-18 23:01:05', 0, 1);
INSERT INTO `hm_messages` VALUES (55, 12, 40, '{49ECEC2E-812C-409E-929E-7DC476C9D50F}.eml', 2, 'arya@disperindag.jatimprov.go.id', 590, 0, '1901-01-01 00:00:00', 96, '2017-05-23 17:53:57', 1, 1);
INSERT INTO `hm_messages` VALUES (56, 10, 36, '{F9BFADCC-E4C2-4D23-82AF-7B1ECF874D1D}.eml', 2, '', 441, 0, '1901-01-01 00:00:00', 33, '2017-05-23 17:53:58', 0, 2);
INSERT INTO `hm_messages` VALUES (58, 10, 34, '{49754AB4-7DED-46F5-81EA-6BB29C1AF4F4}.eml', 2, 'rahmatheruka@disperindag.jatimprov.go.id', 615, 0, '1901-01-01 00:00:00', 96, '2017-05-26 15:18:21', 0, 1);
INSERT INTO `hm_messages` VALUES (59, 14, 48, '{88DFD150-A691-4AE8-9F45-8D26DAD96BD6}.eml', 2, '', 500, 0, '1901-01-01 00:00:00', 33, '2017-05-26 15:18:22', 0, 1);
INSERT INTO `hm_messages` VALUES (61, 15, 53, '{19B0E06C-22A8-4C01-9258-E565079AE498}.eml', 2, '', 467, 0, '1901-01-01 00:00:00', 33, '2017-05-26 15:24:00', 0, 1);
INSERT INTO `hm_messages` VALUES (62, 14, 46, '{7E97E9C4-009B-4E86-B4AC-CD50B364794F}.eml', 2, 'yasin@disperindag.jatimprov.go.id', 621, 0, '1901-01-01 00:00:00', 96, '2017-05-26 15:24:00', 0, 1);
INSERT INTO `hm_messages` VALUES (63, 14, 46, '{4D3B324F-C218-468F-B339-05480BA98D3D}.eml', 2, '', 769, 0, '1901-01-01 00:00:00', 32, '2017-05-26 19:19:03', 1, 2);
INSERT INTO `hm_messages` VALUES (64, 15, 51, '{F085F2D2-38C0-40B8-8990-05FF91487F0D}.eml', 2, '', 730, 0, '1901-01-01 00:00:00', 32, '2017-05-26 19:25:05', 1, 1);
INSERT INTO `hm_messages` VALUES (66, 14, 48, '{40BE0594-55FA-4CB4-8967-AA7102633202}.eml', 2, '', 318, 0, '1901-01-01 00:00:00', 33, '2017-09-26 16:17:32', 0, 2);
INSERT INTO `hm_messages` VALUES (67, 14, 46, '{0097F6BB-C4EE-4205-9595-F6BF823C3B2B}.eml', 2, 'heruka@disperindag.jatimprov.go.id', 578, 0, '1901-01-01 00:00:00', 96, '2017-09-26 16:53:27', 1, 3);
INSERT INTO `hm_messages` VALUES (68, 16, 58, '{95CB5273-D19F-4216-A931-6D9CD634E172}.eml', 2, '', 424, 0, '1901-01-01 00:00:00', 33, '2017-09-26 16:53:28', 0, 1);
INSERT INTO `hm_messages` VALUES (70, 16, 58, '{F5371DAC-58D7-4013-B6AB-C478DEA06B74}.eml', 2, '', 408, 0, '1901-01-01 00:00:00', 33, '2017-09-26 16:54:02', 0, 2);
INSERT INTO `hm_messages` VALUES (72, 18, 64, '{67C01FE9-695E-459C-B769-E821754C10B5}.eml', 2, '', 423, 0, '1901-01-01 00:00:00', 33, '2017-10-27 16:14:43', 0, 1);
INSERT INTO `hm_messages` VALUES (74, 18, 64, '{A31A182C-DCED-4CB9-861C-B250AE134BCA}.eml', 2, '', 401, 0, '1901-01-01 00:00:00', 33, '2017-10-27 16:26:58', 0, 2);
INSERT INTO `hm_messages` VALUES (75, 18, 62, '{FB61D54B-EFCD-4482-9B5B-8B2AA0F2E3F0}.eml', 2, 'jono@disperindag.jatimprov.go.id', 547, 0, '1901-01-01 00:00:00', 65, '2017-12-18 10:46:06', 1, 1);
INSERT INTO `hm_messages` VALUES (76, 19, 69, '{37D1DF02-FF58-4FB0-93D8-35F22C2F6EA0}.eml', 2, '', 409, 0, '1901-01-01 00:00:00', 33, '2017-12-18 10:46:06', 0, 1);

-- ----------------------------
-- Table structure for hm_routeaddresses
-- ----------------------------
DROP TABLE IF EXISTS `hm_routeaddresses`;
CREATE TABLE `hm_routeaddresses`  (
  `routeaddressid` mediumint(9) NOT NULL AUTO_INCREMENT,
  `routeaddressrouteid` int(11) NOT NULL,
  `routeaddressaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`routeaddressid`) USING BTREE,
  UNIQUE INDEX `routeaddressid`(`routeaddressid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_routes
-- ----------------------------
DROP TABLE IF EXISTS `hm_routes`;
CREATE TABLE `hm_routes`  (
  `routeid` int(11) NOT NULL AUTO_INCREMENT,
  `routedomainname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `routedescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `routetargetsmthost` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `routetargetsmtport` int(11) NOT NULL,
  `routenooftries` int(11) NOT NULL,
  `routeminutesbetweentry` int(11) NOT NULL,
  `routealladdresses` tinyint(3) UNSIGNED NOT NULL,
  `routeuseauthentication` tinyint(4) NOT NULL,
  `routeauthenticationusername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `routeauthenticationpassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `routetreatsecurityaslocal` tinyint(4) NOT NULL,
  `routeconnectionsecurity` tinyint(4) NOT NULL,
  `routetreatsenderaslocaldomain` tinyint(4) NOT NULL,
  PRIMARY KEY (`routeid`) USING BTREE,
  UNIQUE INDEX `routeid`(`routeid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_rule_actions
-- ----------------------------
DROP TABLE IF EXISTS `hm_rule_actions`;
CREATE TABLE `hm_rule_actions`  (
  `actionid` int(11) NOT NULL AUTO_INCREMENT,
  `actionruleid` int(11) NOT NULL,
  `actiontype` tinyint(4) NOT NULL,
  `actionimapfolder` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionsubject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionfromname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionfromaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionbody` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionfilename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionsortorder` int(11) NOT NULL,
  `actionscriptfunction` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionheader` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionvalue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `actionrouteid` int(11) NOT NULL,
  PRIMARY KEY (`actionid`) USING BTREE,
  UNIQUE INDEX `actionid`(`actionid`) USING BTREE,
  INDEX `idx_rules_actions`(`actionruleid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_rule_criterias
-- ----------------------------
DROP TABLE IF EXISTS `hm_rule_criterias`;
CREATE TABLE `hm_rule_criterias`  (
  `criteriaid` int(11) NOT NULL AUTO_INCREMENT,
  `criteriaruleid` int(11) NOT NULL,
  `criteriausepredefined` tinyint(4) NOT NULL,
  `criteriapredefinedfield` tinyint(4) NOT NULL,
  `criteriaheadername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `criteriamatchtype` tinyint(4) NOT NULL,
  `criteriamatchvalue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`criteriaid`) USING BTREE,
  UNIQUE INDEX `criteriaid`(`criteriaid`) USING BTREE,
  INDEX `idx_rules_criterias`(`criteriaruleid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_rules
-- ----------------------------
DROP TABLE IF EXISTS `hm_rules`;
CREATE TABLE `hm_rules`  (
  `ruleid` int(11) NOT NULL AUTO_INCREMENT,
  `ruleaccountid` int(11) NOT NULL,
  `rulename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ruleactive` tinyint(4) NOT NULL,
  `ruleuseand` tinyint(4) NOT NULL,
  `rulesortorder` int(11) NOT NULL,
  PRIMARY KEY (`ruleid`) USING BTREE,
  UNIQUE INDEX `ruleid`(`ruleid`) USING BTREE,
  INDEX `idx_rules`(`ruleaccountid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_securityranges
-- ----------------------------
DROP TABLE IF EXISTS `hm_securityranges`;
CREATE TABLE `hm_securityranges`  (
  `rangeid` int(11) NOT NULL AUTO_INCREMENT,
  `rangepriorityid` int(11) NOT NULL,
  `rangelowerip1` bigint(20) NOT NULL,
  `rangelowerip2` bigint(20) NULL DEFAULT NULL,
  `rangeupperip1` bigint(20) NOT NULL,
  `rangeupperip2` bigint(20) NULL DEFAULT NULL,
  `rangeoptions` int(11) NOT NULL,
  `rangename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rangeexpires` tinyint(4) NOT NULL,
  `rangeexpirestime` datetime(0) NOT NULL,
  PRIMARY KEY (`rangeid`) USING BTREE,
  UNIQUE INDEX `rangeid`(`rangeid`) USING BTREE,
  UNIQUE INDEX `rangename`(`rangename`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_securityranges
-- ----------------------------
INSERT INTO `hm_securityranges` VALUES (1, 10, 0, NULL, 4294967295, NULL, 71627, 'Internet', 0, '2001-01-01 00:00:00');
INSERT INTO `hm_securityranges` VALUES (2, 15, 2130706433, NULL, 2130706433, NULL, 71627, 'My computer', 0, '2001-01-01 00:00:00');

-- ----------------------------
-- Table structure for hm_servermessages
-- ----------------------------
DROP TABLE IF EXISTS `hm_servermessages`;
CREATE TABLE `hm_servermessages`  (
  `smid` int(11) NOT NULL AUTO_INCREMENT,
  `smname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `smtext` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`smid`) USING BTREE,
  UNIQUE INDEX `smid`(`smid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_servermessages
-- ----------------------------
INSERT INTO `hm_servermessages` VALUES (1, 'VIRUS_FOUND', 'Virus found');
INSERT INTO `hm_servermessages` VALUES (2, 'VIRUS_ATTACHMENT_REMOVED', 'Virus found:\r\nThe attachment(s) of this message was removed since a virus was detected in at least one of them.\r\n\r\n');
INSERT INTO `hm_servermessages` VALUES (3, 'VIRUS_NOTIFICATION', 'The message below contained a virus and did not\r\nreach some or all of the intended recipients.\r\n\r\n   From: %MACRO_FROM%\r\n   To: %MACRO_TO%\r\n   Sent: %MACRO_SENT%\r\n   Subject: %MACRO_SUBJECT%\r\n\r\nhMailServer\r\n');
INSERT INTO `hm_servermessages` VALUES (4, 'SEND_FAILED_NOTIFICATION', 'Your message did not reach some or all of the intended recipients.\r\n\r\n   Sent: %MACRO_SENT%\r\n   Subject: %MACRO_SUBJECT%\r\n\r\nThe following recipient(s) could not be reached:\r\n\r\n%MACRO_RECIPIENTS%\r\n\r\nhMailServer\r\n');
INSERT INTO `hm_servermessages` VALUES (5, 'MESSAGE_UNDELIVERABLE', 'Message undeliverable');
INSERT INTO `hm_servermessages` VALUES (6, 'MESSAGE_FILE_MISSING', 'The mail server could not deliver the message to you since the file %MACRO_FILE% does not exist on the server.\r\n\r\nThe file may have been deleted by anti virus software running on the server.\r\n\r\nhMailServer');
INSERT INTO `hm_servermessages` VALUES (7, 'ATTACHMENT_REMOVED', 'The attachment %MACRO_FILE% was blocked for delivery by the e-mail server. Please contact your system administrator if you have any questions regarding this.\r\n\r\nhMailServer\r\n');

-- ----------------------------
-- Table structure for hm_settings
-- ----------------------------
DROP TABLE IF EXISTS `hm_settings`;
CREATE TABLE `hm_settings`  (
  `settingid` int(11) NOT NULL AUTO_INCREMENT,
  `settingname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `settingstring` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `settinginteger` int(11) NOT NULL,
  PRIMARY KEY (`settingid`) USING BTREE,
  UNIQUE INDEX `settingid`(`settingid`) USING BTREE,
  UNIQUE INDEX `settingname`(`settingname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_settings
-- ----------------------------
INSERT INTO `hm_settings` VALUES (1, 'maxpop3connections', '', 0);
INSERT INTO `hm_settings` VALUES (2, 'maxsmtpconnections', '', 0);
INSERT INTO `hm_settings` VALUES (3, 'mirroremailaddress', '', 0);
INSERT INTO `hm_settings` VALUES (4, 'relaymode', '', 2);
INSERT INTO `hm_settings` VALUES (5, 'authallowplaintext', '', 1);
INSERT INTO `hm_settings` VALUES (6, 'allowmailfromnull', '', 1);
INSERT INTO `hm_settings` VALUES (7, 'logging', '', 0);
INSERT INTO `hm_settings` VALUES (8, 'logdevice', '', 0);
INSERT INTO `hm_settings` VALUES (9, 'smtpnoofretries', '', 4);
INSERT INTO `hm_settings` VALUES (10, 'smtpminutesbetweenretries', '', 60);
INSERT INTO `hm_settings` VALUES (11, 'protocolimap', '', 1);
INSERT INTO `hm_settings` VALUES (12, 'protocolsmtp', '', 1);
INSERT INTO `hm_settings` VALUES (13, 'protocolpop3', '', 0);
INSERT INTO `hm_settings` VALUES (14, 'welcomeimap', '', 0);
INSERT INTO `hm_settings` VALUES (15, 'welcomepop3', '', 0);
INSERT INTO `hm_settings` VALUES (16, 'welcomesmtp', '', 0);
INSERT INTO `hm_settings` VALUES (17, 'smtprelayer', 'smtp.telkom.net', 0);
INSERT INTO `hm_settings` VALUES (18, 'maxdelivertythreads', '', 10);
INSERT INTO `hm_settings` VALUES (19, 'logformat', '', 0);
INSERT INTO `hm_settings` VALUES (20, 'avclamwinenable', '', 0);
INSERT INTO `hm_settings` VALUES (21, 'avclamwinexec', '', 0);
INSERT INTO `hm_settings` VALUES (22, 'avclamwindb', '', 0);
INSERT INTO `hm_settings` VALUES (23, 'avnotifysender', '', 0);
INSERT INTO `hm_settings` VALUES (24, 'avnotifyreceiver', '', 0);
INSERT INTO `hm_settings` VALUES (25, 'avaction', '', 0);
INSERT INTO `hm_settings` VALUES (26, 'sendstatistics', '', 0);
INSERT INTO `hm_settings` VALUES (27, 'hostname', 'SERVER_DATA', 0);
INSERT INTO `hm_settings` VALUES (28, 'smtprelayerusername', '', 0);
INSERT INTO `hm_settings` VALUES (29, 'smtprelayerpassword', '', 0);
INSERT INTO `hm_settings` VALUES (30, 'usesmtprelayerauthentication', '', 0);
INSERT INTO `hm_settings` VALUES (31, 'smtprelayerport', '', 25);
INSERT INTO `hm_settings` VALUES (32, 'usecustomvirusscanner', '', 0);
INSERT INTO `hm_settings` VALUES (33, 'customvirusscannerexecutable', '', 0);
INSERT INTO `hm_settings` VALUES (34, 'customviursscannerreturnvalue', '', 0);
INSERT INTO `hm_settings` VALUES (35, 'usespf', '', 0);
INSERT INTO `hm_settings` VALUES (36, 'usemxchecks', '', 0);
INSERT INTO `hm_settings` VALUES (37, 'usescriptserver', '', 0);
INSERT INTO `hm_settings` VALUES (38, 'scriptlanguage', 'VBScript', 0);
INSERT INTO `hm_settings` VALUES (39, 'maxmessagesize', '', 20480);
INSERT INTO `hm_settings` VALUES (40, 'usecache', '', 1);
INSERT INTO `hm_settings` VALUES (41, 'domaincachettl', '', 60);
INSERT INTO `hm_settings` VALUES (42, 'accountcachettl', '', 60);
INSERT INTO `hm_settings` VALUES (43, 'awstatsenabled', '', 0);
INSERT INTO `hm_settings` VALUES (44, 'rulelooplimit', '', 5);
INSERT INTO `hm_settings` VALUES (45, 'backupoptions', '', 15);
INSERT INTO `hm_settings` VALUES (46, 'backupdestination', 'D:\\Backup\\mail', 0);
INSERT INTO `hm_settings` VALUES (47, 'defaultdomain', '', 0);
INSERT INTO `hm_settings` VALUES (48, 'avmaxmsgsize', '', 0);
INSERT INTO `hm_settings` VALUES (49, 'smtpdeliverybindtoip', '172.16.16.201', 0);
INSERT INTO `hm_settings` VALUES (50, 'enableimapquota', '', 1);
INSERT INTO `hm_settings` VALUES (51, 'enableimapidle', '', 1);
INSERT INTO `hm_settings` VALUES (52, 'enableimapacl', '', 1);
INSERT INTO `hm_settings` VALUES (53, 'maximapconnections', '', 0);
INSERT INTO `hm_settings` VALUES (54, 'enableimapsort', '', 1);
INSERT INTO `hm_settings` VALUES (55, 'workerthreadpriority', '', 0);
INSERT INTO `hm_settings` VALUES (56, 'ascheckhostinhelo', '', 0);
INSERT INTO `hm_settings` VALUES (57, 'tcpipthreads', '', 15);
INSERT INTO `hm_settings` VALUES (58, 'smtpallowincorrectlineendings', '', 1);
INSERT INTO `hm_settings` VALUES (59, 'usegreylisting', '', 0);
INSERT INTO `hm_settings` VALUES (60, 'greylistinginitialdelay', '', 30);
INSERT INTO `hm_settings` VALUES (61, 'greylistinginitialdelete', '', 24);
INSERT INTO `hm_settings` VALUES (62, 'greylistingfinaldelete', '', 864);
INSERT INTO `hm_settings` VALUES (63, 'antispamaddheaderspam', '', 1);
INSERT INTO `hm_settings` VALUES (64, 'antispamaddheaderreason', '', 1);
INSERT INTO `hm_settings` VALUES (65, 'antispamprependsubject', '', 0);
INSERT INTO `hm_settings` VALUES (66, 'antispamprependsubjecttext', '[SPAM]', 0);
INSERT INTO `hm_settings` VALUES (67, 'enableattachmentblocking', '', 0);
INSERT INTO `hm_settings` VALUES (68, 'maxsmtprecipientsinbatch', '', 100);
INSERT INTO `hm_settings` VALUES (69, 'disconnectinvalidclients', '', 0);
INSERT INTO `hm_settings` VALUES (70, 'maximumincorrectcommands', '', 100);
INSERT INTO `hm_settings` VALUES (71, 'aliascachettl', '', 60);
INSERT INTO `hm_settings` VALUES (72, 'distributionlistcachettl', '', 60);
INSERT INTO `hm_settings` VALUES (73, 'smtprelayerconnectionsecurity', '', 0);
INSERT INTO `hm_settings` VALUES (74, 'adddeliveredtoheader', '', 0);
INSERT INTO `hm_settings` VALUES (75, 'groupcachettl', '', 60);
INSERT INTO `hm_settings` VALUES (76, 'imappublicfoldername', '#Public', 0);
INSERT INTO `hm_settings` VALUES (77, 'antispamenabled', '', 0);
INSERT INTO `hm_settings` VALUES (78, 'usespfscore', '', 3);
INSERT INTO `hm_settings` VALUES (79, 'ascheckhostinheloscore', '', 2);
INSERT INTO `hm_settings` VALUES (80, 'usemxchecksscore', '', 2);
INSERT INTO `hm_settings` VALUES (81, 'spammarkthreshold', '', 5);
INSERT INTO `hm_settings` VALUES (82, 'spamdeletethreshold', '', 20);
INSERT INTO `hm_settings` VALUES (83, 'spamassassinenabled', '', 0);
INSERT INTO `hm_settings` VALUES (84, 'spamassassinscore', '', 5);
INSERT INTO `hm_settings` VALUES (85, 'spamassassinmergescore', '', 0);
INSERT INTO `hm_settings` VALUES (86, 'spamassassinhost', '127.0.0.1', 0);
INSERT INTO `hm_settings` VALUES (87, 'spamassassinport', '', 783);
INSERT INTO `hm_settings` VALUES (88, 'antispammaxsize', '', 1024);
INSERT INTO `hm_settings` VALUES (89, 'ASDKIMVerificationEnabled', '', 0);
INSERT INTO `hm_settings` VALUES (90, 'ASDKIMVerificationFailureScore', '', 5);
INSERT INTO `hm_settings` VALUES (91, 'AutoBanOnLogonFailureEnabled', '', 0);
INSERT INTO `hm_settings` VALUES (92, 'MaxInvalidLogonAttempts', '', 3);
INSERT INTO `hm_settings` VALUES (93, 'LogonAttemptsWithinMinutes', '', 30);
INSERT INTO `hm_settings` VALUES (94, 'AutoBanMinutes', '', 60);
INSERT INTO `hm_settings` VALUES (95, 'IMAPHierarchyDelimiter', '.', 0);
INSERT INTO `hm_settings` VALUES (96, 'MaxNumberOfAsynchronousTasks', '', 15);
INSERT INTO `hm_settings` VALUES (97, 'MessageIndexing', '', 0);
INSERT INTO `hm_settings` VALUES (98, 'BypassGreylistingOnSPFSuccess', '', 1);
INSERT INTO `hm_settings` VALUES (99, 'BypassGreylistingOnMailFromMX', '', 0);
INSERT INTO `hm_settings` VALUES (100, 'MaxNumberOfMXHosts', '', 15);
INSERT INTO `hm_settings` VALUES (101, 'ClamAVEnabled', '', 0);
INSERT INTO `hm_settings` VALUES (102, 'ClamAVHost', 'localhost', 0);
INSERT INTO `hm_settings` VALUES (103, 'ClamAVPort', '', 3310);
INSERT INTO `hm_settings` VALUES (104, 'SmtpDeliveryConnectionSecurity', '', 2);
INSERT INTO `hm_settings` VALUES (105, 'VerifyRemoteSslCertificate', '', 1);
INSERT INTO `hm_settings` VALUES (106, 'SslCipherList', 'ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:DHE-DSS-AES128-GCM-SHA256:kEDH+AESGCM:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:DHE-DSS-AES128-SHA256:DHE-RSA-AES256-SHA256:DHE-DSS-AES256-SHA:DHE-RSA-AES256-SHA:AES128-GCM-SHA256:AES256-GCM-SHA384:ECDHE-RSA-RC4-SHA:ECDHE-ECDSA-RC4-SHA:AES128:AES256:RC4-SHA:HIGH:!aNULL:!eNULL:!EXPORT:!DES:!3DES:!MD5:!PSK;', 0);
INSERT INTO `hm_settings` VALUES (107, 'SslVersions', '', 14);

-- ----------------------------
-- Table structure for hm_sslcertificates
-- ----------------------------
DROP TABLE IF EXISTS `hm_sslcertificates`;
CREATE TABLE `hm_sslcertificates`  (
  `sslcertificateid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sslcertificatename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sslcertificatefile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sslprivatekeyfile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`sslcertificateid`) USING BTREE,
  UNIQUE INDEX `sslcertificateid`(`sslcertificateid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hm_surblservers
-- ----------------------------
DROP TABLE IF EXISTS `hm_surblservers`;
CREATE TABLE `hm_surblservers`  (
  `surblid` int(11) NOT NULL AUTO_INCREMENT,
  `surblactive` tinyint(4) NOT NULL,
  `surblhost` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surblrejectmessage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surblscore` int(11) NOT NULL,
  PRIMARY KEY (`surblid`) USING BTREE,
  UNIQUE INDEX `surblid`(`surblid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_surblservers
-- ----------------------------
INSERT INTO `hm_surblservers` VALUES (1, 0, 'multi.surbl.org', 'Rejected by SURBL.', 3);

-- ----------------------------
-- Table structure for hm_tcpipports
-- ----------------------------
DROP TABLE IF EXISTS `hm_tcpipports`;
CREATE TABLE `hm_tcpipports`  (
  `portid` bigint(20) NOT NULL AUTO_INCREMENT,
  `portprotocol` tinyint(4) NOT NULL,
  `portnumber` int(11) NOT NULL,
  `portaddress1` bigint(20) NOT NULL,
  `portaddress2` bigint(20) NULL DEFAULT NULL,
  `portconnectionsecurity` tinyint(4) NOT NULL,
  `portsslcertificateid` bigint(20) NOT NULL,
  PRIMARY KEY (`portid`) USING BTREE,
  UNIQUE INDEX `portid`(`portid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hm_tcpipports
-- ----------------------------
INSERT INTO `hm_tcpipports` VALUES (1, 1, 25, 0, NULL, 0, 0);
INSERT INTO `hm_tcpipports` VALUES (2, 1, 587, 0, NULL, 0, 0);
INSERT INTO `hm_tcpipports` VALUES (3, 3, 110, 0, NULL, 0, 0);
INSERT INTO `hm_tcpipports` VALUES (4, 5, 143, 0, NULL, 0, 0);

-- ----------------------------
-- Table structure for hm_whitelist
-- ----------------------------
DROP TABLE IF EXISTS `hm_whitelist`;
CREATE TABLE `hm_whitelist`  (
  `whiteid` bigint(20) NOT NULL AUTO_INCREMENT,
  `whiteloweripaddress1` bigint(20) NOT NULL,
  `whiteloweripaddress2` bigint(20) NULL DEFAULT NULL,
  `whiteupperipaddress1` bigint(20) NOT NULL,
  `whiteupperipaddress2` bigint(20) NULL DEFAULT NULL,
  `whiteemailaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `whitedescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`whiteid`) USING BTREE,
  UNIQUE INDEX `whiteid`(`whiteid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
