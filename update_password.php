<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <style>
        .form-container input {
            border: 1px solid #231f10;
            padding: 10px;
            margin: 5px 0;
            width: 60%;
            box-sizing: border-box;
        }

        .form-container button {
            border: none;
            padding: 10px;
            margin: 5px 0;
            width: 60%;
            box-sizing: border-box;
            background-color: #231f10;
            color: #fff;
            cursor: pointer;
        }

        .form-container {
            width: 100%;
            margin: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            top:15%;
            position: absolute;
            font-family:League Spartan;
        }
    </style>
    <title>Update Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <a href="index.php"><img id="logo" src="images/Logo.png" alt="Site's logo"></a>
    </header>

    <div class="container" id="container">
        <div class="form-container update-password">
            <form method="POST">
                <h1>Atualizar Palavra-passe</h1>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="new_password" placeholder="Nova palavra-passe" required>
                <input type="password" name="confirm_password" placeholder="Confirme a nova palavra-passe" required>
                <button type="submit" name="update_password">Atualizar</button>
            </form>
        </div>
    </div>

    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thedripdistrict";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            echo "As novas palavras-passe não coincidem.";
        } else {
            $stmt = $conn->prepare("SELECT * FROM clientes WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $new_password_hashed = md5($new_password);
                $update_stmt = $conn->prepare("UPDATE clientes SET password = ? WHERE Email = ?");
                $update_stmt->bind_param("ss", $new_password_hashed, $email);

                if ($update_stmt->execute()) {
                    echo "Palavra-passe atualizada com sucesso.";
                } else {
                    echo "Erro ao atualizar a palavra-passe: " . $update_stmt->error;
                }

                $update_stmt->close();
            } else {
                echo "Email não encontrado.";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <script src="login.js"></script>
</body>

</html>
