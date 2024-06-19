<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "thedripdistrict");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all records from 'vendas' table
$query = "SELECT * FROM vendas";
$result = mysqli_query($con, $query);

// Close connection (optional, as the script will end after this)
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            min-width: 250px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Sidebar</h2>
            <a href="index.php">Adicionar Telefone</a>
            <!-- Add more sidebar links if needed -->
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <div class="container">
                <h2>Checkout</h2>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Morada</th>
                                    <th>Email</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Loop through each row of data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['Nome']}</td>";
                                    echo "<td>{$row['Morada']}</td>";
                                    echo "<td>{$row['Email']}</td>";
                                    echo "<td>{$row['Total']}</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
