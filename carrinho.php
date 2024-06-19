<?php
session_start();
include('ligacao.php'); // Ensure this file contains the database connection code

/*
*   Apresenta um mini-carrinho ou o número de elementos no carrinho.
*/
function resumoCarrinho()
{
    if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
        return '<p>Não existem elementos no carrinho de momento</p>';
    } else {
        $items = 0;
        foreach ($_SESSION['carrinho'] as $product) {
            $items += array_sum($product);
        }
        $s = ($items > 1) ? 's' : '';
        return '<p>Você tem <a href="cart.php">' . $items . ' item' . $s . ' no carrinho</a></p>';
    }
}

/*
*   Analisa se houve alterações ao carrinho pelas ações de inserir,
*   apagar e atualizar
*/
function alteracoesCarrinho()
{
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }
    $carrinho = $_SESSION['carrinho'];
    if (isset($_POST['acao'])) {
        $action = $_POST['acao'];
        $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : '';
        $prod = isset($_POST['id']) ? addslashes($_POST['id']) : '';

        switch ($action) {
            case 'add':
                if (isset($carrinho[$prod][$tamanho])) {
                    $carrinho[$prod][$tamanho] += 1;
                } else {
                    $carrinho[$prod][$tamanho] = 1;
                }
                header("Location: cart.php");
                break;
            case 'delete':
                if (isset($carrinho[$prod][$tamanho])) {
                    unset($carrinho[$prod][$tamanho]);
                    if (empty($carrinho[$prod])) {
                        unset($carrinho[$prod]);
                    }
                }
                header("Location: cart.php");
                break;
            case 'deleteAll':
                $carrinho = array();
                header("Location: cart.php");
                break;
            case 'update':
                foreach ($_POST as $key => $value) {
                    if (stristr($key, 'qty')) {
                        $id = addslashes(str_replace('qty', '', $key));
                        $carrinho[$id] = $value;
                    }
                }
                header("Location: cart.php");
                break;
        }

        $_SESSION['carrinho'] = $carrinho;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    alteracoesCarrinho();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .EC {
            float: left; /* Float left to position the button on the left side */
        }
    </style>
</head>

<body>
    <?php include_once("menu.php"); ?>
    <h1>Seu Carrinho de Compras</h1>
    <div class="cart-summary">
        <?php echo resumoCarrinho(); ?>
    </div>
    <div class="cart-details">
        <?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
            <form action="cart.php" method="post">
                <input type="hidden" name="acao" value="deleteAll">
                <button class="EC" type="submit">Esvaziar Carrinho</button>
            </form>
            <table>
                <tr>
                </tr>
                <?php
                $conn = new mysqli("localhost", "root", "", "thedripdistrict");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                foreach ($_SESSION['carrinho'] as $id => $sizes):
                    $sql = "SELECT Nome, imagem FROM produtos WHERE Codproduto = '$id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $productName = $row['Nome'];
                        $productImage = $row['imagem'];
                    }
                    foreach ($sizes as $size => $qty):
                        ?>
                        <tr>
                            <td><img src="path/to/images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" width="150"></td>
                            <td><?php echo $productName; ?></td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="acao" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="tamanho" value="<?php echo $size; ?>">
                                    <button type="submit">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endforeach;
                $conn->close();
                ?>
            </table>
        <?php else: ?>
            <p>Não existem elementos no carrinho de momento</p>
        <?php endif; ?>
    </div>
</body>
</html>
