-- Drop the database if it exists and create a new one
DROP DATABASE IF EXISTS veterinary_record;
CREATE DATABASE veterinary_record;
USE veterinary_record;

-- Create the species table
CREATE TABLE species (
    id_species INT,
    name_species VARCHAR(50),
    CONSTRAINT pk_species PRIMARY KEY (id_species)
);

-- Create the animal table
CREATE TABLE animal (
    id_animal INT,
    name_animal VARCHAR(100),
    id_species INT,
    CONSTRAINT pk_animal PRIMARY KEY (id_animal),
    CONSTRAINT fk_animal_species FOREIGN KEY (id_species) REFERENCES species (id_species)
);

-- Create the treatment table
CREATE TABLE treatment (
    id_treatment INT,
    name_treatment VARCHAR(100),
    description_treatment TEXT,
    CONSTRAINT pk_treatment PRIMARY KEY (id_treatment)
);

-- Create the service record table
CREATE TABLE service_record (
    id_animal INT,
    id_treatment INT,
    treatment_date DATETIME,
    observation TEXT,
    CONSTRAINT pk_service_record PRIMARY KEY (id_animal, id_treatment, treatment_date),
    CONSTRAINT fk_servrec_animal FOREIGN KEY (id_animal) REFERENCES animal (id_animal),
    CONSTRAINT fk_servrec_treatment FOREIGN KEY (id_treatment) REFERENCES treatment (id_treatment)
);

-- Insert example data into the species table
INSERT INTO species (id_species, name_species) VALUES 
(1, 'Bulldog'),
(2, 'Dalmatian'),
(3, 'Mackerel Tabby'),
(4, 'Beagle'),
(5, 'Californian'),
(6, 'Terrier');

-- Insert example data into the animal table
INSERT INTO animal (id_animal, name_animal, id_species) VALUES 
(1, 'Brutus', 1),
(2, 'Flocos', 2),
(3, 'Luna', 3),
(4, 'Meg', 4),
(5, 'Rico', 5),
(6, 'Tico', 6);

-- Insert example data into the treatment table
INSERT INTO treatment (id_treatment, name_treatment, description_treatment) VALUES 
(1, 'Vaccination', 'Annual vaccination against common diseases'),
(2, 'Surgery', 'Surgical procedure for injury treatment'),
(3, 'Checkup', 'Routine health checkup');

-- Insert example data into the service_record table
INSERT INTO service_record (id_animal, id_treatment, treatment_date, observation) VALUES 
(1, 1, '2025-09-01 10:00:00', 'Vaccination went smoothly, no complications'),
(2, 2, '2025-09-05 15:00:00', 'Surgery successful, recovery to follow'),
(3, 3, '2025-09-10 09:00:00', 'Routine checkup, all vital signs normal');
