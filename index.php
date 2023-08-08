<?php

require 'Cart.php';
require 'Product.php';

session_start();

$cart = new Cart();
$productsInCart = $cart->getCart();

$products = [
  1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000, 'quantity' => 1],
  2 => ['id' => 2, 'name' => 'mouse', 'price' => 100, 'quantity' => 1],
  3 => ['id' => 3, 'name' => 'teclado', 'price' => 10, 'quantity' => 1],
  4 => ['id' => 4, 'name' => 'monitor', 'price' => 50, 'quantity' => 1],
];


if (isset($_GET['id'])) {
  $id = strip_tags($_GET['id']);
  $productInfo = $products[$id];
  $product = new Product;
  $product->setId($productInfo['id']);
  $product->setName($productInfo['name']);
  $product->setPrice($productInfo['price']);
  $product->setQuantity($productInfo['quantity']);

  (new Cart)->add($product);
  header('Location: index.php');
}

// var_dump($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>
  <div class="d-flex justify-content-between">
    <div class="d-flex justify-content-center">
      <button class="btn btn btn-outline-warning"><a href="/addProduct.php">add new product</a></button>
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn btn btn-outline-warning"><a href="/mycart.php">Go to cart</a></button>
    </div>
  </div>
  <div class="container card mt-3">
    <ul class="list-group list-group-flush">
      <?php
      $contandoCar = 0;
      if (count($productsInCart) < 4 || empty($productsInCart)) {
        echo "<body>   
          <ul class='list-group list-group-flush'>
            <li class='list-group-item'>Geladeira R$ 1000  <a href='?id=1' onClick='" . $contandoCar++ . "'>Add</a></li>
            <li class='list-group-item'>Mouse R$ 2000  <a href='?id=2' onClick='" . $contandoCar++ . "'>Add</a></li>
            <li class='list-group-item'>Teclado R$ 100  <a href='?id=3' onClick='" . $contandoCar++ . "'>Add</a></li>
            <li class='list-group-item'>Monitor $50 <a href='?id=4' onClick='" . $contandoCar++ . "'>Add</a></li>
          </ul>
        </body>";
      }
      ?>

      <?php if (count($productsInCart) == 4) : ?>
        <?php foreach ($productsInCart as $producte) : ?>
          <div class="d-flex justify-content-end">
            <div class="text-primary fs-5">🛒:<?= $producte->getQuantity(); ?></div>
          </div>
          <?php
          $p = $products[$producte->getId()]
          ?>
          <li class="list-group-item">
            <?= $p['name'] ?> R$ <?= $p['price'] ?>
            <a href="?id=<?= $p['id'] ?>">Add</a>
          </li>
        <?php endforeach; ?>
      <?php endif ?>
    </ul>
  </div>
</body>

</html>