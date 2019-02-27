<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <!--/* jQuery links: https://code.jquery.com/ */-->
    <script 
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
</head>
<body>
<?php
    require_once './php/modelo/almacen.php';
    require_once './php/modelo/cesta.php';
    require_once './php/modelo/clientela.php';
    require_once './php/pruebas/pruebas.php';
    require_once './php/pruebas/pruebas2.php';
    require_once './php/pruebas/pruebas3.php';
    $almacen = Almacen::instanciar();
    $almacen->cargar_productos();
    espera_1();
    espera_2();
    echo 'ALMACEN<br>';
    var_dump($almacen->obtener_productos());
    echo '<br>' . "#{$almacen->talla()}";
    $cesta = Cesta::instanciar();
    $cesta->cargar_articulos();
    echo '<br><br>CESTA<br>';
    var_dump($cesta->pasar_cesta());
    echo '<br>';
    var_dump($cesta->articulos_a_vector());
    echo '<br><br>CLIENTES<br>';
    var_dump($cesta->articulos_a_json());
    $clientes = Clientes::instanciar();
    $clientela = $clientes->cargar_clientes();
    echo '<br>';
    $clientela = $clientes->obtener_clientes();
    var_dump($clientela);
    echo '<br><br>CLIENTE 0:';
    print_r ($clientela[0]->obtener_datos());
    require_once './php/pruebas/pruebas3.php';
    ?>
    <div id='clica'>click aquí</div>
    <script src='./js/main.js'></script>
</body>
</html>