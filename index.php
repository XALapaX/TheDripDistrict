<?php
include('cart.php');

// Check if user is logged in
if (isset($_SESSION['email'])) {
    // Retrieve client's name from the database based on the email stored in session
    $email = $_SESSION['email'];
    $consulta_cliente = "SELECT Nome FROM clientes WHERE Email = '$email'";
    $result_cliente = $ligacao->query($consulta_cliente);

    // If a row is returned, set the Nome session variable
    if ($result_cliente->num_rows > 0) {
        $cliente = $result_cliente->fetch_assoc();
        $_SESSION['Nome'] = $cliente['Nome'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheDripDistrict.</title>
    <link rel="icon" href="images/tdd-removebg-preview.png">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
    <script src="js/slideshow.js" defer></script>
    <script src="https://kit.fontawesome.com/cc217ac7a1.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<<<<<<< HEAD
<style>
        footer {
            background-color: #1a1a1a;
            color: #f1f1f1;
            padding: 40px 0;
            text-align: center;
            font-family: 'League Spartan', sans-serif;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3);
        }

        .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-left h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .footer-left p {
            font-size: 14px;
        }

        .footer-center, .footer-right {
            margin: 20px 0;
        }

        .footer-center p, .footer-right p {
            margin: 5px 0;
            font-size: 14px;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: #f1f1f1;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: blue;
        }

        .footer-center strong, .footer-right strong {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }

        .footer-right a {
            color: #f1f1f1;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-right a:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            .footer-container {
                flex-direction: row;
                justify-content: space-between;
            }

            .footer-left, .footer-center, .footer-right {
                margin: 0;
            }

            .footer-left, .footer-center, .footer-right {
                flex: 1;
                padding: 0 20px;
            }
        }

        @media (min-width: 576px) {
            .product-container {
                flex: 1 1 calc(50% - 20px); /* Half width for small screens */
            }
        }

        @media (min-width: 768px) {
            .product-container {
                flex: 1 1 calc(33.33% - 20px); /* Third width for medium screens */
            }
        }

        @media (min-width: 992px) {
            .product-container {
                flex: 1 1 calc(25% - 20px); /* Quarter width for large screens */
            }
        }
</style>
=======

>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
<body>

    <?php include_once("menu.php"); ?>

<<<<<<< HEAD
    <div id="userSidebar" class="sidebar">
=======
    <div id="sidebar" class="sidebar">
>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
        <div class="sidebar-content">
            <?php if (isset($_SESSION['email'])) : ?>
                <p>Olá, <?php echo $_SESSION['Nome']; ?></p>
                <!-- Additional client information can be displayed here -->
            <?php endif; ?>
        </div>
    </div>

<<<<<<< HEAD
    <div id="cartSidebar" class="sidebar">
        <div class="sidebar-content">
            <?php echo getCartDetails(); ?>
        </div>
        <div class="checkout-button-container">
            <form action="checkout.php" method="post">
                <button type="submit">Finalizar Compra</button>
            </form>
        </div>
    </div>

=======
>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
    <section class="slide">
        <div class="slide-content">
            <div class="slide-box">
                <img class="img-desktop" src="images/Nike.png" alt="slide 1">
            </div>
            <div class="slide-box">
                <img class="img-desktop" src="images/Adidas.png" alt="slide 2">
            </div>
            <div class="slide-box">
                <img class="img-desktop" src="images/TNF.png" alt="slide 3">
            </div>
            <div class="slide-box">
                <img class="img-desktop" src="images/Champion.png" alt="slide 4">
            </div>
        </div>
    </section>

    <section class="produtos">
        <h1>PRODUTOS.</h1>
        <section>
            <div class="product-container">
                <?php
                $consulta = "SELECT * FROM produtos";
                $resProdutos = $ligacao->query($consulta);
                while ($produto = $resProdutos->fetch_assoc()) {
                ?>
                    <div class="product-item">
                        <a href="buymenu.php?cod=<?= $produto['Codproduto'] ?>">
                            <img class="product-img" src="images/<?= $produto['imagem'] ?>" alt="<?= $produto['Nome'] ?>">
                            <div class="innerProduct">
                                <h4><?= $produto['Nome'] ?></h4>
                                <h5><?= $produto['Preco'] ?>€</h5>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </section>
    <!-- <footer>teste</footer> -->
<<<<<<< HEAD
    
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <h3>TheDripDistrict.</h3>
                <p>&copy; 2024 TheDripDistrict. All rights reserved.</p>
            </div>
            <div class="footer-center">
                <p><strong>Contactos</strong></p>
                <p>Email: support@thedripdistrict.com</p>
                <p>Phone: +123 456 7890</p>
                <p>Address: 123 Drip Street, Fashion City, FC 12345</p>
            </div>
            <div class="footer-right">
                <p><strong>Segue-nos</strong></p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <p><a href="privacy.php">Politicas de Privacidade</a></p>
            </div>
        </div>
    </footer>

    <script>
        function toggleSidebar2() {
            var sidebar = document.getElementById("cartSidebar");
            if (sidebar.style.width === "500px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "500px";
            }
        }

        document.getElementById('cartIcon').addEventListener('click', toggleSidebar2);

        function toggleSidebar() {
            var sidebar = document.getElementById("userSidebar");
=======
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "250px";
            }
        }
    </script>
<<<<<<< HEAD

    
</body>

</html>
=======
</body>

</html>
>>>>>>> ed697891fd5aa89578363c592c731786af1ed493
