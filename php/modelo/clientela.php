<?php
    require_once 'sql.php';
    require_once 'cliente.php';

    class Clientes {
        /*
            Clase para facilitar el manejo sobre la tabla clientes.
        */
        private static $instancia;
        private static $clientes;
        private $sql;
        private static $tabla;
        private static $id_sql;

        public function __construct() {
            self::$instancia = null;
            self::$clientes = array();
            $this->sql = SQL::instanciar();
            self::$tabla = 'clientes';
            self::$id_sql = 'id_cliente';

        }

        public static function instanciar() {
            if(self::$instancia == null) {
                self::$instancia = new static();
            }
            return self::$instancia;
        }

        public function cargar_clientes() {
            $clientela = $this->sql->cargar_filas_tabla(self::$tabla, self::$id_sql);
            $i=0;
            foreach($clientela as $cliente) {
                $cliente['id'] = intval($cliente['id_cliente']);
                $c = new Cliente($cliente);
                array_push(self::$clientes, $c);
            }
        }

        public function talla() {
            return count(self::$clientes);
        }

        public function obtener_clientes() {
            return self::$clientes;
        }
    }