<?php

// Database connection parameters
$host = 'localhost';
$dbname = 'Roland_Recruit';
$username = 'Roland';
$password = 'Roland@1551@';

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// CRUD (create,read,update,delete) operations

// Create operation
function createUser($name, $email) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute([$name, $email]);
}

// Read operation
function getUsers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Update operation
function updateUser($id, $name, $email) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $id]);
}

// Delete operation
function deleteUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

// Example usage

// Create a new user
createUser("JesuFemi Poly", "jesuf@polyibadan.com");

// Get all users
$users = getUsers();
foreach ($users as $user) {
    echo "ID: " . $user['id'] . ", Name: " . $user['name'] . ", Email: " . $user['email'] . "<br>";
}

// Update user with ID 1
updateUser(1, "Roland", "Rolandfelix70@gmail.com");

// Delete user with ID 2
deleteUser(2);

?>
