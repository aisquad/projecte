<?php
	class Fichero {
        /*
             Clase para simplificar funciones sobre ficheros.
             Los métodos pasar_* devuelven un valor de alguna propiedad.
             Los métodos tomar_* asignan el valor a la propiedad que se le pasa como argumento.
        */
		private $nombre;

		public function __construct() {
			$this->nombre = '';
		}

		public function crear($nombre, $path='./data/'){
            $this->nombre = $path . $nombre; 
		}

		public function escribir($texto) {
			$fh = fopen($this->nombre, 'w+');
			$texto = utf8_encode($texto);
			fwrite($fh, "$texto\n");
			fclose($fh);			
		}
		
		public function anyadir($texto){
			$fh = fopen($this->nombre, 'a+');
			$texto = utf8_encode($texto);
			fwrite($fh, "$texto\n");
			fclose($fh);			
		}
		
		public function leer(){
            $contenido = '';
            if ($this->existe()) {
                $fh = fopen($this->nombre, 'r+');
                $contenido = fread($fh, filesize($this->nombre));
                fclose($fh);
            }			
			return utf8_decode($contenido);
        }

        public function existe(){
            return file_exists($this->nombre);
        }

        public function pasar_nombre() {
            return $this->nombre;
        }        
	}
?>