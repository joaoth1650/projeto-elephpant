<?php
require 'Product.php';
require 'Cart.php';

session_start();

$cart = new Cart();
$addProductsInMenu = $cart->getCart();

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
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>

<body>
  <div class="d-flex justify-content-start">
    <button class="btn btn btn-outline-warning"><a href="/index.php">Go to Home</a></button>
  </div>
  <div class="container">
    <form action="cad.php" method="post">
      <label for="id">ID</label>
      <input type="text" name="id">
      <label for="name">Nome</label>
      <input type="text" name="name">
      <label for="price">Preço</label>
      <input type="text" name="price">
      <label for="quantity">Quantidade</label>
      <input type="text" name="quantity">
      <input type="submit" value="Enviar">
    </form>
  </div>
</body>

</html>