/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50558
 Source Host           : localhost:3306
 Source Schema         : duoruiji

 Target Server Type    : MySQL
 Target Server Version : 50558
 File Encoding         : 65001

 Date: 09/05/2021 22:49:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for experts
-- ----------------------------
DROP TABLE IF EXISTS `experts`;
CREATE TABLE `experts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `portrait` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `education` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of experts
-- ----------------------------
INSERT INTO `experts` VALUES (1, '宋玉芹', '/upload/expert_thumb/jpg/20210505/202105051952444406_s.jpg', '皮肤科', '副主任医师', '复旦大学附属华山医院皮肤科主任医师', '苏州瑞金白癜风门诊部', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">擅长对白癜风、无色素痣等色素异常性疾病方面有丰富的临床经验及较深的研究。</span></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">本科学历</span></p>', '2021-05-05 19:53:28', '2021-05-05 19:53:28');
INSERT INTO `experts` VALUES (2, '李鹏', '/upload/expert_thumb/jfif/20210505/202105051955051897_s.jfif', '消化科', '主任医师', '友谊医院消化科主任', '北京仁安医院', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">北京仁安医院特聘专家，在临床工作中可进行多项高水平的内镜介入（微创）诊断和治疗项目</span></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">博士</span></p>', '2021-05-05 19:56:53', '2021-05-05 19:56:53');
INSERT INTO `experts` VALUES (3, '陈东', '/upload/expert_thumb/jfif/20210505/202105051958001650_s.jfif', '耳-颅底外科', '副主任医师', '耳整形外科主任', '山东省耳鼻喉医院', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">副主任医师，耳整形外科主任，医学博士，美国斯坦福大学访问学者</span></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">医学博士</span></p>', '2021-05-05 19:59:17', '2021-05-05 19:59:17');
INSERT INTO `experts` VALUES (4, '沈芳芳', '/upload/expert_thumb/jpg/20210507/202105071021205131_s.jpg', '白癜风', '副主任医师', '中国医师协会皮肤分会会员', '苏州瑞金白癜风门诊部', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">中华中医药学会会员，中国非公医协会皮肤专业委员会员。</span></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;PingFang SC&quot;, Helvetica, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, STHeiTi, sans-serif; text-indent: 32px;\">硕士研究生</span></p>', '2021-05-05 20:01:33', '2021-05-07 10:21:26');

-- ----------------------------
-- Table structure for lives
-- ----------------------------
DROP TABLE IF EXISTS `lives`;
CREATE TABLE `lives`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `introduction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  `portrait` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `associate` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eid` int(11) NULL DEFAULT NULL,
  `edepartment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ephoto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lives
-- ----------------------------
INSERT INTO `lives` VALUES (1, '苏州瑞金白癜风研究院宋玉芹《白癜风专家视频问答》第一期', '/upload/video/1.mp4', 1, '<p>白癜风专家视频问答</p>', '2021-05-07 17:55:00', '2021-05-10 17:56:00', '/upload/video_thumb/jfif/20210507/202105071020327078_s.jfif', '宋玉芹', '2021-05-05 20:07:04', '2021-05-08 17:54:39', 1, '皮肤科', '/upload/expert_thumb/jpg/20210505/202105051952444406_s.jpg');
INSERT INTO `lives` VALUES (2, '20180817养生堂视频和笔记:李鹏,胃粘膜,幽门螺杆菌,胃炎,胃溃疡', '/upload/video/2.mp4', 0, '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(248, 248, 248);\">主要介绍胃的年龄究竟由什么决定，胃粘膜被破坏的过程，造成急性胃粘膜损伤的因素等相关内容</span></p>', '2021-05-06 20:10:24', '2021-05-21 00:00:00', '/upload/video_thumb/jpg/20210505/202105052010359537_s.jpg', '李鹏', '2021-05-05 20:10:43', '2021-05-05 20:10:43', 2, '消化科', '/upload/expert_thumb/jfif/20210505/202105051955051897_s.jfif');
INSERT INTO `lives` VALUES (3, ' 告别尴尬的白斑-苏州瑞金白癜风门诊部 ', '/upload/video/3.mp4', 1, '<p>告别白斑，年轻十岁，永葆青春</p>', '2021-04-29 20:15:14', '2021-05-04 00:00:00', '/upload/video_thumb/jpg/20210505/202105052015286287_s.jpg', '沈芳芳', '2021-05-05 20:15:35', '2021-05-05 20:15:35', 4, '白癜风', '/upload/expert_thumb/jpg/20210505/202105052001157872_s.jpg');
INSERT INTO `lives` VALUES (4, '耳鼻喉科患者猛然增加！到底为什么？我们应该怎么防护？ 小橙爱生活爱运动  原创作者2719粉丝  关注', '/upload/video/4.mp4', 0, '<p>治疗耳鼻喉</p>', '2021-05-05 20:20:30', '2021-05-06 00:00:00', '/upload/video_thumb/jpg/20210505/202105052020407453_s.jpg', '陈东', '2021-05-05 20:20:49', '2021-05-05 20:20:49', 3, '耳-颅底外科', '/upload/expert_thumb/jfif/20210505/202105051958001650_s.jfif');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2021_04_27_171444_create_users_table', 1);
INSERT INTO `migrations` VALUES ('2021_04_27_171647_create_lives_table', 1);
INSERT INTO `migrations` VALUES ('2021_04_27_171749_create_experts_table', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$LDM/8PaSDKwmF335YBzcEu7ydNYk.blV.WsPjOU9ROaVkkjuCNQKi', 'wdeF72BEDtlM77Ch5mRubwSXJzDteYCDoMnkO1gDYCgqF8JilUxb5yCI5tjw', '2021-05-04 13:04:58', '2021-05-08 20:14:16');

SET FOREIGN_KEY_CHECKS = 1;
