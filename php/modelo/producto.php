<?php
	class Producto {
		public $id;
		public $nombre;
		public $precio;
		public $stock;
		public $imagen;
		public $descripcion;

		public function __construct($id, $nombre, $precio, $stock, $imagen, $descripcion){
			$this->id = $id;
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->stock = $stock;
			$this->imagen = $imagen;
			$this->descripcion = $descripcion;
		}

		public function existencias() {
			return $this->stock;
		}

	}
?>