-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tb_city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_city` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_city` (
  `city_ID` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`city_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_company`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_company` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_company` (
  `company ID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `city_ID` INT NOT NULL,
  PRIMARY KEY (`company ID`),
  INDEX `fk_tb_company_tb_city1_idx` (`city_ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_routes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_routes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_routes` (
  `route_number` VARCHAR(5) NOT NULL,
  `starting_point` VARCHAR(60) NOT NULL,
  `ending_point` VARCHAR(60) NOT NULL,
  `fare` VARCHAR(5) NOT NULL,
  `extension` VARCHAR(6) NOT NULL,
  `denomination` VARCHAR(110) NOT NULL,
  `company_ID` INT NOT NULL,
  `city_ID` INT NOT NULL,
  PRIMARY KEY (`route_number`),
  INDEX `fk_tb_routes_tb_company_idx` (`company_ID` ASC),
  INDEX `fk_tb_routes_tb_city1_idx` (`city_ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_schedules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_schedules` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_schedules` (
  `route_number` VARCHAR(5) NOT NULL,
  `schedule` VARCHAR(5) NOT NULL,
  `weekday` VARCHAR(45) NOT NULL,
  `city_ID` INT NOT NULL,
  PRIMARY KEY (`route_number`),
  INDEX `fk_tb_schedules_tb_city1_idx` (`city_ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_privileges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_privileges` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_privileges` (
  `privilege_ID` INT NOT NULL,
  `privilege` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`privilege_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_user` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_user` (
  `user_ID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `fav_routes` VARCHAR(100) NOT NULL,
  `latitude` DOUBLE NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `privilege_ID` INT NOT NULL,
  `city_ID` INT NOT NULL,
  PRIMARY KEY (`user_ID`),
  INDEX `fk_tb_user_tb_privileges1_idx` (`privilege_ID` ASC),
  INDEX `fk_tb_user_tb_city1_idx` (`city_ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_vehicle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_vehicle` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_vehicle` (
  `vehicle_ID` INT NOT NULL,
  `latitude` DOUBLE NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `city_ID` INT NOT NULL,
  `company_ID` INT NOT NULL,
  `route_number` DOUBLE NOT NULL,
  PRIMARY KEY (`vehicle_ID`),
  INDEX `fk_tb_vehicle_tb_city1_idx` (`city_ID` ASC),
  INDEX `fk_tb_vehicle_tb_company1_idx` (`company_ID` ASC),
  INDEX `fk_tb_vehicle_tb_routes1_idx` (`route_number` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
