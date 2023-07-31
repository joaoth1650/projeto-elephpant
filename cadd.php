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
    <h1>NumbersBrothers</h1>
  </header>
  <main>
    <?php 
      $number = $_GET["number"] ?? "quem é tu zé" ;
      echo "<p>Seu numero é:<strong>$number</strong> e estes são seus irmãos :)";

      $sucessor = $number + 1 ;
      echo "<p>Este é o sucessor: $sucessor </p>" ;
      $antecessor = $number - 1 ;
      echo "<p>Este é o antecessor: $antecessor</p>" ;
    ?>
    <br>
    <a href="javascript:history.go(-1)">Voltar ao fomulario</a>
  </main>
</body>
</html>

