<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Resultado</title>
</head>
<body>
  <header>
    <h1>Resultado da req?ste</h1>
  </header>
  <main>
    <?php 
      $name = $_GET["nome"] ?? "quem é tu zé" ;
      $sobrenome = $_GET["sobrenome"] ?? "hoje nao $name";
      echo "<p>É um prazer conhece-lo, <strong>$name $sobrenome</strong>! Este site é para você :)";
    ?>
    <br>
    <a href="javascript:history.go(-1)">Voltar ao fomulario</a>
  </main>
</body>
</html>

