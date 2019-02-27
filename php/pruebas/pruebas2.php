<?php
    function espera_2 () {
        global $almacen;
        $almacen->anyadir_producto(9, 'Trufa 9');
        $almacen->incrementar_stock(4);
        $almacen->incrementar_stock(4);
        $almacen->incrementar_stock(4);
    }
 
    if (isset($GLOBALS['clientela'])) {
        echo "SERIOUSLY";
        $clientela[0]->obtener_clientes();
    }

?>