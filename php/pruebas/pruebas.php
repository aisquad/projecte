<?php
    function espera_1 () {
        global $almacen;
        $almacen->anyadir_producto(8, 'Trufa 8');
        $almacen->incrementar_stock(4);
        $almacen->incrementar_stock(4);
        $almacen->incrementar_stock(4);
    }
?>