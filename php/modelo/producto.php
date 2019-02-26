<?php
	class Producto {
		/*
			Clase para facilitar el manejo de los productos.
		*/
		protected $id;
		protected $nombre;
		protected $precio;
		protected $stock;
		protected $imagen;
		protected $descripcion;

		public function __construct($id, $nombre, $precio, $stock, $imagen, $descripcion) {
			$this->id = $id;
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->stock = $stock;
			$this->imagen = $imagen;
			$this->descripcion = $descripcion;
		}

		public function pasar_id() {
			return $this->id;
		}

		public function pasar_existencias() {
			return $this->stock;
		}

		public function pasar_nombre() {
			return $this->nombre;
		}

		public function pasar_imagen() {
			return $this->imagen;
		}

		public function pasar_descripcion() {
			return $this->descripcion;
		}

		public function pasar_precio() {
			return $this->precio;
		}

		public function incrementar_existencias() {
			$this->stock++;
		}

		public function cambiar_existencias($cantidad) {
			$this->existencias = $cantidad;
		}

		public function cambiar_precio($precio) {
			$this->precio = $precio;
		}

	}
?>