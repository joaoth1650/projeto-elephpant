<?php 
require 'Cart.php';
require 'Product.php';

$cart = new Cart();

$name = $_GET["name"];

$newItemShopping = new Cart Product->setName($name);
?>