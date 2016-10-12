SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `praticaltests_photoviewer` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `praticaltests_photoviewer` ;

-- -----------------------------------------------------
-- Table `praticaltests_photoviewer`.`photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `praticaltests_photoviewer`.`photos` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'ID da foto.',
  `name` VARCHAR(80) NOT NULL COMMENT 'Nome do arquivo.',
  PRIMARY KEY (`id`))
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
