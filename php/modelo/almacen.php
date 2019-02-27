<?php
	require_once 'sql.php';
	require_once 'producto.php';

	class Almacen {
		/*
			Clase para el manejo de los productos entre el almacén (BD) / tienda (cesta).
			Los métodos cargar_* recogen datos de la base de datos.
			Los métodos obtener_* devuelven datos en un formato concreto (json, vector, xml, etc.)

			Una vez se descargan los datos de la base de datos las operaciones se realizan sobre
			el vector PHP hasta que se confirma la venta.

			Del almacén se obtiene las principales características del producto:
			- id y nombre
			- descripción
			- precio de venta
			- existencias (stock).

			El vector de los productos es indexado (no asociativo) y contiene objetos de tipo Producto.

			Usamos una instancia única mediante el patrón Singleton.
		*/
        private static $instancia;
        private static $productos;
        private $sql;

        public function __construct() {
			self::$productos = array();
			self::$instancia = null;
			$this->sql = SQL::instanciar();
        }

		public static function instanciar() {
			if (static::$instancia == null) {
				static::$instancia = new static();
			}
			return static::$instancia;
		}

        public function cargar_productos() {
			// Descargamos los productos de la base de datos.
			$productos = $this->sql->cargar_filas_tabla ('productos', 'id_producto');
			foreach($productos as $producto) {
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

		public function obtener_productos() {
			return self::$productos;
		}

		public function talla() {
			return count(self::$productos);
		}
		
		public function anyadir_producto($id, $nombre, $precio=0.0, $stock=0, $imagen='', $descripcion='') {
			$producto = new Producto($id, $nombre, $precio, $stock, $imagen, $descripcion);
			self::$productos[] = $producto;
		}

		public function cambiar_precio($id, $precio) {
			foreach(self::$productos as &$producto) {
				if ( $producto->pasar_id() == $id) {
					$producto->cambiar_precio($precio);
				}
			}
		}

		public function cambiar_stock($id, $cantidad) {
			foreach(self::$productos as &$producto) {
				if ( $producto->id == $id) {
					$producto->cambiar_existencias($cantidad);
				}
			}
		}

		public function incrementar_stock($id) {
			foreach(self::$productos as &$producto) {
				if ( $producto->pasar_id() == $id) {
					$producto->incrementar_existencias();
				}
			}
		}
		
		public function obtener_producto($id) {
			if ($id<1 || $id > $this->talla() - 1)
				return null;

			foreach(self::$productos as $producto) {
				if ( $producto->pasar_id() == $id) {
					return $producto;
				}
			}

			return null;
		}
    }
?>