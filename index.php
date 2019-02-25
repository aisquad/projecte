<?php
    require_once './php/modelo/almacen.php';
	$almacen = Almacen::instanciar();
    $almacen->obtener_productos();
    require_once './php/pruebas/pruebas.php';
    require_once './php/pruebas/pruebas2.php';
    var_dump($almacen->devolver_productos());
    echo '<br>' . "#{$almacen->talla()}";
?>