SET NAMES utf8mb4;
set character_set_client='utf8';
set character_set_connection='utf8';
set character_set_database='utf8';
set character_set_results='utf8';
set character_set_server='utf8';
-- Creation of the Clients table
CREATE TABLE Clients (
                         ClientID INT AUTO_INCREMENT PRIMARY KEY,
                         LastName VARCHAR(255) NOT NULL,
                         FirstName VARCHAR(255) NOT NULL,
                         Email VARCHAR(255) UNIQUE,
                         PhoneNumber VARCHAR(255) UNIQUE,
                         Address TEXT NOT NULL
);

-- Creation of the Employees table
CREATE TABLE Employees (
                           EmployeeID INT AUTO_INCREMENT PRIMARY KEY,
                           LastName VARCHAR(255) NOT NULL,
                           FirstName VARCHAR(255) NOT NULL
);

-- Creation of the Vehicles table
CREATE TABLE Vehicles (
                          VehicleID VARCHAR(255) PRIMARY KEY,
                          Brand VARCHAR(255) NOT NULL,
                          Model VARCHAR(255) NOT NULL
);

-- Creation of the Equipment table
CREATE TABLE Equipment (
                           EquipmentID INT AUTO_INCREMENT PRIMARY KEY,
                           Label VARCHAR(255) NOT NULL,
                           Brand VARCHAR(255) NOT NULL,
                           Model VARCHAR(255) NOT NULL,
                           SerialNumber VARCHAR(255) UNIQUE
);

-- Creation of the Interventions table
CREATE TABLE Interventions (
                               InterventionID INT AUTO_INCREMENT PRIMARY KEY,
                               EmployeeID INT NOT NULL,
                               ClientID INT NOT NULL,
                               VehicleID VARCHAR(255) NOT NULL,
                               Date DATETIME NOT NULL,
                               Comment TEXT,
                               FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID),
                               FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),
                               FOREIGN KEY (VehicleID) REFERENCES Vehicles(VehicleID)
);

-- Creation of the Intervention_Equipment table to handle the many-to-many relationship
CREATE TABLE Intervention_Equipment (
                                        InterventionID INT NOT NULL,
                                        EquipmentID INT NOT NULL,
                                        Quantity INT NOT NULL DEFAULT 1,
                                        PRIMARY KEY (InterventionID, EquipmentID),
                                        FOREIGN KEY (InterventionID) REFERENCES Interventions(InterventionID),
                                        FOREIGN KEY (EquipmentID) REFERENCES Equipment(EquipmentID)
);
