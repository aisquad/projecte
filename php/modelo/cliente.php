<?php 
    class Cliente {
        private $id;
        private $nombre;
        private $apellidos;
        private $nif;
        private $direccion;
        private $poblacion;
        private $provincia;
        private $cp;
        private $telefono;
        private $email;

        public function __construct($cliente) {
            $this->id = $cliente['id'];
            $this->nombre = $cliente['nombre'];
            $this->apellidos = $cliente['apellidos'];
            $this->nif = $cliente['nif'];
            $this->direccion = $cliente['direccion'];
            $this->poblacion = $cliente['poblacion'];
            $this->provincia = $cliente['provincia'];
            $this->cp = $cliente['cp'];
            $this->telefono = $cliente['telefono'];
            $this->email = $cliente['email'];
        }

        public function obtener_datos() {
            return [
                'id' => $this->id,
                'nombre'=> $this->nombre,
                'apellidos'=> $this->apellidos,
                'nif'=> $this->nif,
                'direccion'=> $this->direccion,
                'poblacion'=> $this->poblacion,
                'provincia'=> $this->provincia,
                'telefono'=> $this->telefono,
                'cp'=> $this->cp,
                'nif'=> $this->nif
            ];
        }
    }
    
?>