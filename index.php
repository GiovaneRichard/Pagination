<?php
    require 'conexao.php';
/**
 * 1º - Calcular a quantidade total de páginas.
 * 2º - Definir a pagina ($pagina)
 * 3º - fazer a query com LIMIT
 *  - max-links - qtd de links mostrados antes e depois
 */

    $maximo = 10;
    $pagina = 0;
    $deslocamento;
    $max_links = 2; 

    $pagina = (isset($_GET['pagina']) && !empty($_GET['pagina']) ) ? $_GET['pagina'] : 0;
    // $deslocamento = (isset($_GET['pagina']) && !empty($_GET['pagina']) ) ? $_GET['pagina'] : 1;

    // $pagina = ( ($deslocamento- 1) * $maximo);

       

    // calculando a qtd de registros no db
    $total = 0;
    $sql = $pdo->query("SELECT COUNT(*) as total FROM movies");
    $data = $sql->fetch();
    $total = $data['total'];

    
    $total_paginas = ceil($total / $maximo);
    
    $sql = $pdo->query("SELECT * FROM movies LIMIT $pagina, $maximo");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    
  
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
                <div class="search-area">
                    <input type="text" />
                    <i class='bx bx-search-alt-2' ></i>
                </div>
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
                        <td>
                        <div class="title-list">
                            <?=$item['title'];?>
                        </div>
                        </td>
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
            <?php if($total > $maximo): ?>

                <a href="./?pagina=0">Primeira</a>
                
                
                <?php for($i = $pagina - $max_links; $i <= $pagina - 1; $i++): ?>
               
                    <?php if($i >= 1): ?>
                        <a href="./?pagina=<?=$i;?>"><?=$i;?></a>
                    <?php endif ?>

                <?php endfor ?>

                <span class="active"><?=$pagina;?></span>

                
                <?php for($i = $pagina + 1; $i <= $pagina + $max_links; ++$i): ?>
                    
                    <?php if($i <= $total_paginas): ?>
                        <a href="./?pagina=<?=$i;?>"><?=$i;?></a>
                    <?php endif ?>

                <?php endfor ?>

                <a href="./?pagina=<?=$total_paginas;?>">Ultima</a>
            <?php endif?>



                


            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
</body>
</html>