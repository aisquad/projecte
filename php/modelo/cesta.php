<?php
    require_once 'fichero.php';
    require_once 'producto.php';
    require_once 'utilidades.php';

	class Cesta{
		/*
			Vector asociativo de productos que desea comprar el usuario.
            ['idprod'=> ['prod' => Producto(), 'cant'=> int]]
            
            Con cesta únicamente manejamos la cantidad de producto que el usuario
            desea adquirir, asociándola a un objeto de tipo Producto.

            Cesta retiene el pedido en un fichero XML.

            Por diferenciar la clase Almacén de Cesta, los elementos de cesta se denominan
            artículos, ya que además de las características del producto también tienen la
            propiedad de cantidad que nos indica el número de artículos que desea adquirir
            el usuario.

            Los métodos cargar_* actualizan el vector asociativo del fichero XML.
            Los métodos articulos_a_* devuelven un vector en algún formato (json, xml, etc.)
		*/
		private static $instancia = null;
		private $cesta;
		private $fichero;

        public function __construct() {
            $this->cesta = array();
            $this->fichero = new Fichero();
            $this->fichero->crear('cesta.xml');
            self::$instancia = null;
        }

		public static function instanciar() {
			if (static::$instancia === null) {
				static::$instancia = new static();
			}    
			return static::$instancia;
		}    

		public function pasar_cesta(){
			return $this->cesta;
		}

        public function talla(){
			return count($this->cesta);
        }
        
        public function cargar_articulos() {
            // Leemos el documento cesta.xml y lo convertimos a vector asociativo.
            global $almacen;
            if ($this->fichero->existe()) {
                $contenido = $this->fichero->leer();
                $xml = new SimpleXMLElement($contenido);
                $lineas = array();
                foreach($xml->producto as $prod){
                        $this->cesta[(integer) $prod->id] = [
                            'articulo' => $almacen->obtener_producto((integer) $prod->id),
                            'cantidad' => (integer) $prod->cantidad
                        ];
                }
            } else {
                echo "<br>Fichero inexistente: '{$this->fichero->pasar_nombre()}'<br>";
            }
        }

        public function obtener_articulos() {
            if ($this->cesta->talla() == 0) {
                $this->cargar_articulos();
            }
            return $this->cesta;
        }
		
		public function articulos_a_vector() {
			$rtn = ['cesta' => array()];
            foreach($this->cesta as $item) {
                $producto = $item['articulo']; 
				$rtn['cesta'][$producto->pasar_id()] = [
					'nombre' => $producto->pasar_nombre(),
					'imagen' => $producto->pasar_imagen(),
					'precio' => $producto->pasar_precio(),					
					'stock' => $producto->pasar_existencias(),
					'cantidad' => $item['cantidad'],
                ];
            }
			return $rtn;
		}
        
        public function articulos_a_json() {
            return json_encode($this->articulos_a_vector());
        }

		public function actualizar_de_vector($json){
            /* 
                El vector que se le pasa es el que le llega a través
                json. Se almacena en un fichero xml, al tiempo que se actualiza
                el propio vector de $cesta.

                Recibimos un objeto json de dos tipos 
                    - {"id": i, "incrementar": j}, para incrementar el número de artículos con esa id.
                    - {"id": i, "actualizar": j}, para actualizar el número de artículos con esa id.
            */
            global $almacen;
            $producto = &$almacen->obtener_producto($json->id);
            $articulo = &$this->cesta[$json->id];

            if(isset($json->incrementar)) {
                $articulo['cantidad'] += $json->incremetar;
            } else {
                $articulo['cantidad'] = $json->actualizar;
            }
            $cantidad = $articulo['cantidad'];
            $producto->stock -= $cantidad;
            $this->actualizar_xml();
		}

		public function actualizar_xml() {
            // Pasa el vector asociativo al fichero XML.
			$cesta_xml = ['cesta' => array()];
			foreach ($this->cesta as $vector) {
                $cesta_xml['cesta']['producto'][] = [
                    'id'=> $vector['producto']->id,
                    'cantidad' => $vector['cantidad'],
                ];
			}
			$this->fichero->escribir(utf8_decode(assocarray_to_xml($cesta_xml)));
		}

        public function retirar_articulo($id) {
            // Elimina un producto de la cesta.
            unset($this->cesta[$id]);
            $this->actualizar_xml();
        }

		public function vaciar() {
            // Vacía la cesta.
            $this->cesta = array();
			$cesta_xml = utf8_decode(assocarray_to_xml(['cesta' => array()]));
            $this->fichero->escribir($cesta_xml);
        }
	}
?>