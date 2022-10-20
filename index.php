<?php
    require 'conexao.php';

    $item_per_pag = 10;
    $pagina = 0;

    $list = [];
    $sql = $pdo->query("SELECT * FROM movies LIMIT $pagina, $item_per_pag");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
   

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>DOM | Estudos</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

    <h1>Lista de Filmes</h1>
    
    <ul>
        <?php foreach($res as $item): ?>
            <li><?= $item['title']?></li>
        <?php endforeach ?>
    </ul>

    <script src="assets/js/script.js"></script>
</body>
</html>