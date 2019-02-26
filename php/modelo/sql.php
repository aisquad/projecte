<?php
	class SQL {
		/*
			Clase para abarcar toda la funcionalidad de las llamadas SQL
			para cualquier BD.
		*/
        protected static $instancia;
		public $servidor;
		public $usuario;
		public $contrasenya;
		public $basedatos;
		public $conexion;
		
		public function __construct($servidor='localhost', $usuario='root', $contrasenya='', $bd='tienda'){
			$this->usuario = $usuario;
			$this->contrasenya = $contrasenya;
			$this->basedatos = $bd;
			$this->conexion = null;
			self::$instancia = null;
		}

		public static function instanciar() {
			if (static::$instancia == null) {
				static::$instancia = new static();
			}
			return static::$instancia;
		}

        public function abrir_conexion() {
			// Creamos conexión pasándole los datos de servidor, usuario, contraseña y base de datos.
			$this->conexion = mysqli_connect($this->servidor, $this->usuario, $this->contrasenya, $this->basedatos);
			$this->conexion->set_charset('utf8');
			if (mysqli_connect_errno()) {
				echo "No se ha podido acceder a la base de datos: " . mysqli_connect_error();
			}
		}

		public function cerrar_conexion () {
			// Cerramos conexión. Se necesita cada vez que acabamos la consulta.
			if($this->conexion) {
				@mysqli_close($this->conexion);
			}
		}
		
		public function consulta_base_de_datos ($consulta) {
			// Función para ejecutar consultas de todo tipo, le pasamos la consulta en crudo.
			$rtn = mysqli_query($this->conexion, $consulta);
			return $rtn;
		}

		public function obtener_resultados($resultado) {
			// Devolvemos el resultado de la consulta obtenida en un
			// vector asociativo.
			return mysqli_fetch_assoc($resultado);
		}
		
		public function cargar_filas_tabla($tabla, $orderby='') {
			/*
				Cargamos cualquier tabla para obtener todo su contenido.
				Se le puede proporcionar un parámetro de ordenación.
				Devolverá un vector asociativo.
			*/
			if ($orderby != ''){
				$orderby = " ORDER BY $orderby";
			}
			$this->abrir_conexion();
			$vector = array();
			$resultado = $this->consulta_base_de_datos("SELECT * FROM $tabla$orderby;");
			while ($fila = $this->obtener_resultados($resultado)){
				$vector[] = $fila;
			}
			$this->cerrar_conexion();
			return $vector;
		}
		
		public function ultimo_id($tabla, $id) {
			// Obtenemos el último elemento introducido.
			// No devuelve únicamente el id.

			$this->abrir_conexion();
			$resultado = $this->consulta_base_de_datos("SELECT MAX($id) AS $id FROM $tabla;");
			$resultado = $this->obtener_resultados($resultado);
			$this->cerrar_conexion();
			return $resultado[$id];
		}

    }
?>