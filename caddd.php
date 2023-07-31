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
    <h1>Number Random</h1>
  </header>
  <main>
    <?php
    $min = 1;
    $max = 1000;
    echo "seu numero aleatorio é:" . random_int($min, $max);
    ?>
    <br>
    <a href="javascript:history.go(-1)">Voltar ao fomulario</a>
  </main>
</body>

</html>