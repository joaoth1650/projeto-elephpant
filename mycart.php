<?php
require 'Product.php';
require 'Cart.php';

session_start();

$cart = new Cart();
$productsInCart = $cart->getCart();

// var_dump($productsInCart);

if (isset($_GET['id'])) {
	$id = strip_tags($_GET['id']);
	$cart->remove($id);
	header('Location: mycart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<title>Document</title>
</head>

<body>
	<div class="d-flex justify-content-end">
		<button class="btn btn btn-outline-warning"><a href="/index.php">Go to Home</a></button>
	</div>
	<ul>
		<?php if (count($productsInCart) <= 0) : ?>
			Nenhum produto carrinho.
		<?php endif; ?>
		<?php foreach ($productsInCart as $product) : ?>
			<li><?= $product->getName(); ?>
				<input type="text" value="<?= $product->getQuantity(); ?>">
				Price: R$ <?= number_format($product->getPrice(), 2, ',', '.'); ?>
				Subtotal:R$ <?= number_format($product->getPrice() * $product->getQuantity(), 2, ',', '.'); ?>
				<a href="?id=<?= $product->getId(); ?>">remove</a>
			</li>
		<?php endforeach ?>
		<li>
			Total: <?= number_format($cart->getTotal()); ?>
		</li>
	</ul>
</body>

</html>