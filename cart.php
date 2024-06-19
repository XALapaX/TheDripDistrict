<?php
session_start();
include('ligacao.php'); // Database connection

function resumoCarrinho()
{
    if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
        return '<p></p>';
    } else {
        $items = 0;
        foreach ($_SESSION['carrinho'] as $product) {
            $items += array_sum($product);
        }
        $s = ($items > 1) ? 's' : '';
        return '<p>Você tem no seu carrinho:</p>';
    }
}

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
                break;
            case 'delete':
                if (isset($carrinho[$prod][$tamanho])) {
                    unset($carrinho[$prod][$tamanho]);
                    if (empty($carrinho[$prod])) {
                        unset($carrinho[$prod]);
                    }
                }
                break;
            case 'deleteAll':
                $carrinho = array();
                break;
            case 'update':
                foreach ($_POST as $key => $value) {
                    if (stristr($key, 'qty')) {
                        $id = addslashes(str_replace('qty', '', $key));
                        $carrinho[$id] = $value;
                    }
                }
                break;
        }

        $_SESSION['carrinho'] = $carrinho;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
    alteracoesCarrinho();
}

function getCartDetails()
{
    $html = '<div class="cart-summary">' . resumoCarrinho() . '</div>';
    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $html .= '<table><tr><th></th><th></th></tr>';
        
        // Database connection
        include('ligacao.php');

        foreach ($_SESSION['carrinho'] as $id => $sizes) {
            $sql = "SELECT Nome, imagem FROM produtos WHERE Codproduto = '$id'";
            $result = $ligacao->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $productName = $row['Nome'];
                $productImage = $row['imagem'];
            }
            foreach ($sizes as $size => $qty) {
                $html .= '<tr>';
                $html .= '<td><img src="images/' . $productImage . '" alt="' . $productName . '" width="50"></td>';
                $html .= '<td>' . $productName . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="acao" value="delete">
                                <input type="hidden" name="id" value="' . $id . '">
                                <input type="hidden" name="tamanho" value="' . $size . '">
                                <button type="submit">Remover</button>
                            </form>
                          </td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>
                  <div class="clear-cart-button">
                      <form action="cart.php" method="post">
                          <input type="hidden" name="acao" value="deleteAll">
                          <button type="submit">Esvaziar Carrinho</button>
                      </form>
                  </div>';
    } else {
        $html .= '<p>Ups! Estou vazio.</p>';
    }
    return $html;
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
    <style>
        /* Sidebar styles */
        .sidebar {
            position: relative;
            height: 100vh; /* Full height of the viewport */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .checkout-button-container {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        /* Button styles */
        button {
            border-radius: 10px;
            font-family: 'League Spartan', sans-serif;
            font-size: 14px;
            padding: 10px 20px;
            background-color: #111; /* Nike's typical black button */
            color: white;
            border: 2px solid #111; /* Border with the same color as the background */
            cursor: pointer;
            border-radius: 12px; /* Rounded corners */
            transition: background-color 0.7s, color 0.7s, border-color 0.7s;
        }

        button:hover {
            background-color: white;
            color: #111;
            border-color: #111; /* Border color change on hover */
        }

        .clear-cart-button button {
            margin-top: 20px;
        }

        /* Specific styles for the table buttons */
        table form button {
            display: inline-block;
            margin: 5px 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #111; /* Nike's typical black button */
            color: white;
            border: 2px solid #111; /* Border with the same color as the background */
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        table form button:hover {
            background-color: white;
            color: #111;
            border-color: #111; /* Border color change on hover */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Existing sidebar content -->
        <div class="cart-summary">
            <?php echo getCartDetails(); ?>
        </div>
        <div class="checkout-button-container">
            <form action="checkout.php" method="post">
                <button type="submit">Finalizar Compra</button>
            </form>
        </div>
    </div>
</body>
</html>
