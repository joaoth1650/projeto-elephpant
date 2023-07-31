<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Document</title>
</head>

<body>
  <header>
    <h1>Apresente-se!</h1>
  </header>
  <section>
    <form action="cad.php" method="get" onsubmit="return validateForm()">
      <label for="nome">Nome</label>
      <input type="text" name="nome" id="idNome">
      <label for="sobrenome">Sobrenome</label>
      <input type="text" name="sobrenome" id=idSobrenome>
      <input type="submit" value="Enviar">
      <?php
      ?>
    </form>
    <br>
    <br>
    <form action="cadd.php" method="get">
      <label for="number">digite um numero</label>
      <input type="number" name="number" id="idNumber">
      <input type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <form action="caddd.php" method="get">
      <label for="number">Renderize um numero aleatorio :P</label>
      <input type="submit" value="Enviar">
    </form>
  </section>

  <script>
    const validateForm = () => {
      let nome = document.getElementById('idNome').value;
      let sobrenome = document.getElementById('idSobrenome').value;

      if (nome === "" || sobrenome === "") {
        alert("Pls man, preencha o nome e o sobrenome!!!");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>


<!--
        if (isset($_GET['nome']) && isset($_GET['sobrenome'])) {
          $nome = $_GET['nome'];
          $sobrenome = $_GET['sobrenome'];

          if (empty($nome) || empty($sobrenome)) {
            echo "Escreva o nome ou o sobrenome.";
          } else {
            // Processar os dados aqui, pois ambos os campos não estão vazios.
          }
        }
-->