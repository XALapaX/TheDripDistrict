<?php
include('ligacao.php');
?>
<?php
$consulta = "SELECT * FROM produtos WHERE Codproduto=" . $_GET['cod'];
$resProdutos = $ligacao->query($consulta);
$produto = $resProdutos->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* CSS Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'League Spartan', sans-serif;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #fff;
}

#logo {
    width: 150px;
    height: auto;
}

.icon, .icon2 {
    font-size: 24px;
    color: #231f10;
    text-decoration: none;
}

.icon:hover, .icon2:hover {
    color: #555; /* Adjust as needed */
}

.section {
    padding: 20px;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px;
}

.product-image {
    flex: 1 1 50%;
    max-width: 50%;
    padding: 10px;
}

.product-image img {
    width: 100%;
    height: auto;
}

.product-details {
    flex: 1 1 50%;
    max-width: 50%;
    padding: 10px;
}

.product-details h4 {
    font-size: 2em;
    margin-bottom: 10px;
}

.product-details form {
    display: flex;
    flex-direction: column;
}

.product-details label, .product-details select, .product-details .preco, .product-details .button {
    margin-bottom: 10px;
}

.product-details .button {
    padding: 10px;
    background-color: #000;
    color: #fff;
    border: none;
    cursor: pointer;
}

.product-details .button:hover {
    background-color: #444;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-container {
        flex-direction: column;
        align-items: center;
    }

    .product-image, .product-details {
        max-width: 100%;
        padding: 10px 0;
    }

    
}

@media (max-width: 480px) {
    .product-details h4 {
        font-size: 1em;
    }

    .icon, .icon2 {
        font-size: 20px;
    }

    .product-details .button {
        font-size: 16px;
    }
}

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheDripDistrict</title>
    <link rel="stylesheet" href="buymenu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png">
    <script src="https://kit.fontawesome.com/cc217ac7a1.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once("menu.php"); ?>

<section>
    <a href="index.php" class="icon9"><i class="fa-solid fa-arrow-left" style="color: #231f10;"></i></a>
</section>

<section class="product-container">
    <div class="product-image">
        <img src="images/<?= $produto['imagem'] ?>" alt="<?= $produto['Nome'] ?>">
    </div>
    <div class="product-details">
        <h4><?= $produto['Nome'] ?></h4>
        <form id="compraForm"  action="carrinho.php" method="post">
            <label for="tamanho">Escolha o tamanho:</label>
            <select id="tamanho" name="tamanho">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="3XL">3XL</option>
            </select>
            <br>
            <div class="preco">Preço: <?= $produto['Preco'] ?>€</div>
            <a href="#"><button class="button">Adicionar ao carrinho</button></a>
            <input type="hidden" name="id" value="<?= $produto['Codproduto'] ?>" />
            <input type="hidden" name="acao" value="add" />
        </form>
    </div>
</section>

</body>
</html>