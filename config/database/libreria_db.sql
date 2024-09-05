
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 02:37 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.2.12

--
-- Database: `libreria_db`
--
CREATE DATABASE IF NOT EXISTS `libreria_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `libreria_db`;

-- -----------------------------------------------------
-- Table `libreria_db`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `libreria_db`.`categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `libreria_db`.`libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `libreria_db`.`libros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `autor` VARCHAR(100) NOT NULL,
  `disponibilidad` VARCHAR(100) NULL DEFAULT '1',
  `categoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_libros_categorias`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `libreria_db`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `libreria_db`.`miembros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `libreria_db`.`miembros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `libreria_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `libreria_db`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `role` ENUM('Cliente', 'Administrador') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `correo` (`correo` ASC)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;


-- Datos volcados
-- categorias 
INSERT INTO `categorias` (`nombre`) VALUES ('Ficción');
INSERT INTO `categorias` (`nombre`) VALUES ('Historia');
-- libros
INSERT INTO `libros` (`titulo`, `autor`, `disponibilidad`, `categoria_id`) VALUES ('1998', 'Geoge Orwell', '0', 1);
INSERT INTO `libros` (`titulo`, `autor`, `disponibilidad`, `categoria_id`) VALUES ('El arte de la guerra', 'Sun Tzu', '1', 2);
-- miembros
INSERT INTO `miembros` (`name`, `telefono`, `email`, `created_at`) VALUES ('davilson', '3136213124', 'davilson@gmail.com', '2024-08-17 02:09:14');
-- usuarios: contraseña es 123.
insert into users (nombre, password, correo) VALUES ('Juan', '$2y$10$EchWcGNK1q1qGQrq87VureqzSwkrXIqeK5VjmFAga/2V0FX69On.S', 'juan@gmail.com');
insert into users (nombre, password, correo) VALUES ('Manuel', '$2y$10$EchWcGNK1q1qGQrq87VureqzSwkrXIqeK5VjmFAga/2V0FX69On.S', 'manuel@gmail.com');
insert into users (nombre, password, correo) VALUES ('Jhon Jairo', '$2y$10$EchWcGNK1q1qGQrq87VureqzSwkrXIqeK5VjmFAga/2V0FX69On.S', 'jhon.jairo@gmail.com');
insert into users (nombre, password, correo) VALUES ('Javier', '$2y$10$EchWcGNK1q1qGQrq87VureqzSwkrXIqeK5VjmFAga/2V0FX69On.S', 'javier@gmail.com');
