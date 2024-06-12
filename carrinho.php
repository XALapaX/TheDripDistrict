<?php

include('ligacao.php');

/*
*	Apresenta um mini-carrinho ou o número de elementos no carrinho.
*/
function resumoCarrinho()
{
	$cart = $_SESSION['carrinho'];
	if (!$cart) {
		return '<p>Não existem elementos no carrinho de momento</p>';
	} else {
		// Parse the cart session variable
		$items = explode(',', $cart);
		$s = (count($items) > 1) ? 's' : '';
		return '<p>Você tem <a href="cart.php">' . count($items) . ' item' . $s . ' no carrinho</a></p>';
	}
}

/*
*	Analisa se houve alterações ao carrinho pelas ações de inserir,
*	apagar e atualizar
*/
function alteracoesCarrinho()
{
	$carrinho = array();
	if (isset($_SESSION['carrinho']))
		$carrinho = $_SESSION['carrinho'];
	if (isset($_POST['acao'])) {
		$action = $_POST['acao'];
		$tamanho='';
		if(isset($_POST['tamanho'])){
			$tamanho=$_POST['tamanho'];
		}
		if(isset($_POST['id'])) {
			$prod = addslashes($_POST['id']);
		}
		switch ($action) {
			case 'add':
				if (isset($carrinho[$prod]) && isset($carrinho[$prod][$tamanho])) {
					
					$carrinho[$prod][$tamanho] += 1;
						
				} else {
					$carrinho[$prod][$tamanho] = 1;
				}
				header("Location: index.php");
				//print_r($carrinho);
				break;
			case 'delete':
				if ($carrinho[$prod][$tamanho]) {
					$carrinho[$prod][$tamanho] = NULL;
					unset($carrinho[$prod]);
				}
				header("Location: verCarrinho.php");
				
				break;
			case 'deleteAll':
				$carrinho=NULL;
				unset($carrinho);
				print_r($_SESSION);
				header("Location: index.php");
				break;
			case 'update':
				if ($carrinho) {
					$newcarrinho = '';
					foreach ($_POST as $key => $value) {
						if (stristr($key, 'qty')) {
							$id = addslashes(str_replace('qty', '', $key));
							$newcarrinho[$id] = $value;
						}
					}
				}
				$carrinho = $newcarrinho;
				break;
			header("Location: verCarrinho.php");
		}

		$_SESSION['carrinho'] = $carrinho;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao'])) {
	alteracoesCarrinho();
}
