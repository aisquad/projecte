<?php
	require_once 'sql.php';
	require_once 'producto.php';

	class Almacen {
        private static $instancia;
        private static $productos;
        private $sql;

        public function __construct() {
            self::$productos = array();
            $this->sql = SQL::instanciar();
        }

		public static function instanciar() {
			if (static::$instancia == null) {
				static::$instancia = new static();
			}
			return static::$instancia;
		}

        public function obtener_productos() {
			foreach($this->cargar_productos() as $producto){
				$p = new Producto(
					intval($producto['id_producto']),
					$producto['nombre'],
					floatval($producto['precio_actual']),
					intval($producto['stock']),
					$producto['imagen'],
					$producto['descripcion']
				);
				array_push(self::$productos, $p);
			}
        }

		public function cargar_productos(){
			// Devolvemos los productos del almacén.
			return $this->sql->cargar_filas_tabla ('productos', 'id_producto');
		}

		public function devolver_productos() {
			return self::$productos;
		}

		public function anyadir_producto($id, $nombre, $precio=0.0, $stock=0, $imagen='', $descripcion='') {
			$producto = new Producto($id, $nombre, $precio, $stock, $imagen, $descripcion);
			self::$productos[] = $producto;
		}

		public function talla() {
			return count(self::$productos);
		}
		
		public function cambiar_precio($id, $precio) {
			foreach(self::$productos as &$producto) {
				if ( $producto->id == $id) {
					$producto->precio = $precio;
				}
			}
		}

		public function cambiar_stock($id, $cantidad) {
			foreach(self::$productos as &$producto) {
				if ( $producto->id == $id) {
					$producto->cantidad = $cantidad;
				}
			}
		}

		public function incrementar_stock($id) {
			foreach(self::$productos as &$producto) {
				if ( $producto->id == $id) {
					$producto->stock++;
				}
			}
		}

		
    }
?>