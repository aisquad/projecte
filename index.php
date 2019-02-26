<?php
    require_once './php/modelo/almacen.php';
    require_once './php/modelo/cesta.php';
    require_once './php/modelo/clientela.php';
    require_once './php/pruebas/pruebas.php';
    require_once './php/pruebas/pruebas2.php';
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
    $clientes->cargar_clientes();
    echo '<br>';
    var_dump($clientes->obtener_clientes());
?>