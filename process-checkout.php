<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "thedripdistrict";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare data from the form
$dataVenda = $_POST['dataVenda'];
$nome = $_POST['nome'];
$total = $_POST['total'];
$morada = $_POST['morada'];
$email = $_POST['email'];

// Insert data into database
$sql = "INSERT INTO vendas (DataVenda, Nome, Total, Morada, Email) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sids", $dataVenda, $nome, $total, $morada, $email);

if ($stmt->execute()) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
