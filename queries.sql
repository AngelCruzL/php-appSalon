CREATE DATABASE IF NOT EXISTS app_salon;

USE app_salon;

CREATE TABLE users(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(60),
  lastname VARCHAR(60),
  email VARCHAR(30) NOT NULL,
  password CHAR(60) NOT NULL,
  phone VARCHAR(10),
  is_admin TINYINT(1) DEFAULT 0,
  is_confirmed TINYINT(1) DEFAULT 0,
  token VARCHAR(15)
);

CREATE TABLE services(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60),
  price DECIMAL(5,2)
);

INSERT INTO services (name, price) VALUES
('Corte de Cabello Mujer', 90.00),
('Corte de Cabello Hombre', 80.00),
('Corte de Cabello Niño', 60.00),
('Peinado Mujer', 80.00),
('Peinado Hombre', 60.00),
('Peinado Niño', 60.00),
('Corte de Barba', 60.00),
('Tinte Mujer', 300.00),
('Uñas', 400.00),
('Lavado de Cabello', 50.00),
('Tratamiento Capilar', 150.00);

CREATE TABLE dates(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date DATE NOT NULL,
  time TIME NOT NULL,
  user_id INT(11) NOT NULL REFERENCES users(id) ON UPDATE SET NULL ON DELETE SET NULL
);

CREATE TABLE dates_services(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date_id INT(11) REFERENCES dates(id) ON UPDATE SET NULL ON DELETE SET NULL,
  service_id INT(11) REFERENCES services(id) ON UPDATE SET NULL ON DELETE SET NULL
);
