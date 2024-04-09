<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'executeQuery.php';

$faker = Faker\Factory::create();

// Insert data into Clients table
for ($i = 0; $i < 10; $i++) {
    $lastName = $faker->lastName;
    $firstName = $faker->firstName;
    $email = $faker->email;
    $phoneNumber = $faker->phoneNumber;
    $address = $faker->address;

    $query = "INSERT INTO Clients (LastName, FirstName, Email, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?)";
    executeQuery($query, [$lastName, $firstName, $email, $phoneNumber, $address]);
}

// Insert data into Vehicles table
$brands = ['Toyota', 'Honda', 'Ford', 'Tesla'];
$models = ['Camry', 'Civic', 'Fiesta', 'Model 3'];
for ($i = 0; $i < 10; $i++) {
    $vehicleId = 'VH' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
    $brand = $brands[array_rand($brands)];
    $model = $models[array_rand($models)];

    $query = "INSERT INTO Vehicles (VehicleID, Brand, Model) VALUES (?, ?, ?)";
    executeQuery($query, [$vehicleId, $brand, $model]);
}

// Insert data into Equipment table
$labels = ['Laptop', 'Drill', 'Multimeter', 'Wrench Set'];
$brands = ['Dell', 'Bosch', 'Fluke', 'Craftsman'];
$models = ['XPS 15', 'Professional', '87V', 'Standard'];
for ($i = 0; $i < 10; $i++) {
    $label = $labels[array_rand($labels)];
    $brand = $brands[array_rand($brands)];
    $model = $models[array_rand($models)];
    $serialNumber = 'SN' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);

    $query = "INSERT INTO Equipment (Label, Brand, Model, SerialNumber) VALUES (?, ?, ?, ?)";
    executeQuery($query, [$label, $brand, $model, $serialNumber]);
}

// Insert data into Interventions table
for ($i = 0; $i < 10; $i++) {
    $employeeId = rand(1, 10);
    $clientId = rand(1, 10);
    $vehicleId = 'VH' . str_pad(rand(1, 10), 3, '0', STR_PAD_LEFT);
    $date = $faker->dateTimeThisYear->format('Y-m-d H:i:s');
    $comment = $faker->sentence;

    $query = "INSERT INTO Interventions (EmployeeID, ClientID, VehicleID, Date, Comment) VALUES (?, ?, ?, ?, ?)";
    executeQuery($query, [$employeeId, $clientId, $vehicleId, $date, $comment]);
}