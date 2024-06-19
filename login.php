<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/tdd-removebg-preview.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>TheDripDistrict</title>
</head>

<body>

    <header>
        <a href="index.php"><img id="logo" src="images/Logo.png" alt="Site's logo"></a>
    </header>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST">
                <h1>Criar conta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>ou use o seu email para registar</span>
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Palavra-passe" required>
                <button type="submit" name="register">Registar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST">
                <h1>Entrar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>ou use o seu email e palavra-passe</span>
                <input type="email" name="login_email" placeholder="Email" required>
                <input type="password" name="login_password" placeholder="Palavra-passe" required>
                <a href="update_password.php">Esqueceu-se da palavra-passe?</a>
                <button type="submit" name="login">Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Olá de novo!</h1>
                    <p>Introduza os seus dados para comprar no site</p>
                    <button id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá, Amigo!</h1>
                    <p>Registe-se para comprar no site!</p>
                    <button id="register">Registe-se</button>
                </div>
            </div>
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['register'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $stmt = $conn->prepare("INSERT INTO clientes (Nome, Email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $password);

            if ($stmt->execute()) {
                echo "Novo registro criado com sucesso";
            } else {
                echo "Erro: " . $stmt->error;
            }

            $stmt->close();
        } elseif (isset($_POST['login'])) {
            $email = $_POST['login_email'];
            $password = md5($_POST['login_password']);

            $stmt = $conn->prepare("SELECT * FROM clientes WHERE Email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                echo "Login failed: Invalid email or password";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <script src="login.js" defer></script>
</body>

</html>
