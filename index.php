<?php
    require 'conexao.php';
/**
 * 1º - Calcular a quantidade total de páginas.
 * 2º - Definir a pagina ($pagina)
 * 3º - fazer a query com LIMIT
 */

    $item_per_pag = 10;
    $pagina = 0;
    $deslocamento;

    $deslocamento = (isset($_GET['pagina']) && !empty($_GET['pagina']) ) ? $_GET['pagina'] : 1;

    $pagina = ( ($deslocamento- 1) * $item_per_pag);


    // calculando a qtd de registros no db
    $total = 0;
    $sql = $pdo->query("SELECT COUNT(*) as total FROM movies");
    $data = $sql->fetch();
    $total = $data['total'];

    $paginas = ceil($total / $item_per_pag);

    $sql = $pdo->query("SELECT * FROM movies LIMIT $pagina, $item_per_pag");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
   
    $k=1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <!-- box-icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  
    <title>DOM | Estudos</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

    <nav>     
        <div class="navbar container">
            <div class="left-navbar">
                LOGO
            </div>
            <div class="right-navbar">
                SEARCH ÁREA
            </div>
        </div>    
    </nav>

    <div class="container">
        <h1>Lista de Filmes</h1>
        <div class="table-area">
            <table width="100%">
                <thead>
                    <tr>
                        <th class="inactive">Id</th>
                        <th>Title</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($res as $item): ?>
                    <tr>
                        <td class="inactive"><?=$item['id'];?></td>
                        <td><?=$item['title'];?></td>
                        <td>
                            <div class="actions">
                                <a href="#"><i class='bx bx-edit'></i></a>
                                <a href="#"><i class='bx bx-trash' onclick="return confirm('Deseja realmente excluir o item?')"></i></a>
                            </div>
                        </td>
                       
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <div class="pag-area">
                <?php for($i = 0; $i < $paginas; ++$i): ?>
                    <a href="./?pagina=<?=$i+1?>"><?=$i+1?></a>
                <?php endfor ?>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
</body>
</html>