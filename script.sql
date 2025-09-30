-- Drop the database if it exists and create a new database
DROP DATABASE IF EXISTS veterinary_record;
CREATE DATABASE veterinary_record;
USE veterinary_record;

-- Create the species table
CREATE TABLE species (
    cd_species INT, 
    nm_species VARCHAR(50),
    CONSTRAINT pk_species PRIMARY KEY (cd_species)
);

-- Create the animal table
CREATE TABLE animal (
    cd_animal INT,
    nm_animal VARCHAR(100),
    cd_species INT,
    CONSTRAINT pk_animal PRIMARY KEY (cd_animal),
    CONSTRAINT fk_animal_species FOREIGN KEY (cd_species) REFERENCES species (cd_species)
);

-- Create the treatment table
CREATE TABLE treatment (
    cd_treatment INT,
    nm_treatment VARCHAR(100),
    ds_treatment TEXT,
    CONSTRAINT pk_treatment PRIMARY KEY (cd_treatment)
);

-- Create the veterinary record table
CREATE TABLE veterinary_record (
    cd_animal INT,
    cd_treatment INT,
    dt_treatment DATETIME,
    ds_observation TEXT,
    CONSTRAINT pk_veterinary_record PRIMARY KEY (cd_animal, cd_treatment, dt_treatment),
    CONSTRAINT fk_veterinary_record_animal FOREIGN KEY (cd_animal) REFERENCES animal (cd_animal),
    CONSTRAINT fk_veterinary_record_treatment FOREIGN KEY (cd_treatment) REFERENCES treatment (cd_treatment)
);

-- Insert example data into the species table
INSERT INTO species (cd_species, nm_species) VALUES 
(1, 'Dog'),
(2, 'Cat'),
(3, 'Bird');

-- Insert example data into the animal table
INSERT INTO animal (cd_animal, nm_animal, cd_species) VALUES 
(1, 'Rex', 1),
(2, 'Fluffy', 2),
(3, 'Tweety', 3);

-- Insert example data into the treatment table
INSERT INTO treatment (cd_treatment, nm_treatment, ds_treatment) VALUES 
(1, 'Vaccination', 'Annual vaccination against common diseases'),
(2, 'Surgery', 'Surgical procedure for injury treatment'),
(3, 'Checkup', 'Routine health checkup');

-- Insert example data into the veterinary_record table
INSERT INTO veterinary_record (cd_animal, cd_treatment, dt_treatment, ds_observation) VALUES 
(1, 1, '2025-09-01 10:00:00', 'Vaccination went smoothly, no complications'),
(2, 2, '2025-09-05 15:00:00', 'Surgery successful, recovery to follow'),
(3, 3, '2025-09-10 09:00:00', 'Routine checkup, all vital signs normal');
