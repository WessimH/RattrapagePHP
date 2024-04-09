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

INSERT INTO Clients (LastName, FirstName, Email, PhoneNumber, Address) VALUES
                                                                           ('Smith', 'John', 'john.smith@example.com', '123-456-7890', '123 Elm St, Springfield'),
                                                                           ('Doe', 'Jane', 'jane.doe@example.com', '321-654-0987', '456 Oak St, Anytown'),
                                                                           ('Johnson', 'Emily', 'emily.johnson@example.com', '231-564-8970', '789 Pine St, Metropolis'),
                                                                           ('Brown', 'Michael', 'michael.brown@example.com', '312-645-0789', '101 Maple St, Gotham');
INSERT INTO Vehicles (VehicleID, Brand, Model) VALUES
                                                   ('VH001', 'Toyota', 'Camry'),
                                                   ('VH002', 'Honda', 'Civic'),
                                                   ('VH003', 'Ford', 'Fiesta'),
                                                   ('VH004', 'Tesla', 'Model 3');
INSERT INTO Equipment (Label, Brand, Model, SerialNumber) VALUES
                                                              ('Laptop', 'Dell', 'XPS 15', 'SN001'),
                                                              ('Drill', 'Bosch', 'Professional', 'SN002'),
                                                              ('Multimeter', 'Fluke', '87V', 'SN003'),
                                                              ('Wrench Set', 'Craftsman', 'Standard', 'SN004');
INSERT INTO Interventions (EmployeeID, ClientID, VehicleID, Date, Comment) VALUES
                                                                               (1, 1, 'VH001', '2024-04-10 10:00:00', 'Regular maintenance'),
                                                                               (2, 2, 'VH002', '2024-04-11 11:00:00', 'Oil change'),
                                                                               (3, 3, 'VH003', '2024-04-12 09:30:00', 'Brake inspection'),
                                                                               (4, 4, 'VH004', '2024-04-13 14:00:00', 'Battery replacement');

