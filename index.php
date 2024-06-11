<?php
include('ligacao.php');
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
<body>  

<header>
    <div class="header">
        <img id="logo" src="images/Logo.png" alt="Site Logo">
        <?php if(isset($_SESSION['email'])): ?>
            <a href="login.php" class="icon2"><i class="fas fa-user"></i></a>
            <a href="logout.php" class="icon"><i class="fas fa-sign-out-alt"></i></a>
        <?php else: ?>
            <a href="login.php" class="icon"><i class="fas fa-user"></i></a>
        <?php endif; ?>
    </div>
</header>

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
        while($produto = $resProdutos->fetch_assoc()){
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
</body>
</html>
