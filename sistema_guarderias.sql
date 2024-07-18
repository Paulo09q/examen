/*
Navicat MySQL Data Transfer

Source Server         : conex 3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : sistema_guarderias

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-07-18 10:16:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cuidador
-- ----------------------------
DROP TABLE IF EXISTS `cuidador`;
CREATE TABLE `cuidador` (
  `cuidador_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cuidador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cuidador
-- ----------------------------
INSERT INTO `cuidador` VALUES ('1', 'MARIA PEREZ', 'AMA DE CASA', '987456321', 'MARIA@GMAIL.COM');
INSERT INTO `cuidador` VALUES ('2', 'JUANA QUISPE', 'AMA DE CASA', '998877552', 'JUANA@GMAIL.COM');
INSERT INTO `cuidador` VALUES ('4', 'PRUEBA', 'PRUEBA', '123', 'prueba@gmail.com');

-- ----------------------------
-- Table structure for nino
-- ----------------------------
DROP TABLE IF EXISTS `nino`;
CREATE TABLE `nino` (
  `nino_id` int(11) NOT NULL AUTO_INCREMENT,
  `cuidador_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nino_id`),
  KEY `fk01` (`cuidador_id`),
  CONSTRAINT `fk01` FOREIGN KEY (`cuidador_id`) REFERENCES `cuidador` (`cuidador_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nino
-- ----------------------------
INSERT INTO `nino` VALUES ('1', '1', 'NIÑO 1', 'PEREZ', '2024-07-03', 'SIN ALERGIAS');
INSERT INTO `nino` VALUES ('2', '2', 'NIÑO 2', 'SANCHEZ', '2024-07-04', 'SIN ALERGIAS');
INSERT INTO `nino` VALUES ('3', '4', 'PRUEBA2', 'PRUEBA2', '2024-07-19', 'PRUEBA2');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'admin', 'admin', 'admin', '202cb962ac59075b964b07152d234b70');
INSERT INTO `usuario` VALUES ('2', 'paulo', 'paulo', '1234', '202cb962ac59075b964b07152d234b70');
