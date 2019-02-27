<?php
$content = file_get_contents('php://input');
if (isset($GLOBALS['clientela'])) {
    echo "<br><br>SERIOUSLY<br>";
    foreach($clientela as $cliente) {
        print_r($cliente->obtener_datos());
        echo '<br>';
    }
    
}
//header("Content-type: text/json; charset=utf-8");
if($content) {
    global $almacen;
    $json = json_decode($content);
    $GLOBALS['json'] = $json;
    //echo 'obj json->tipo: ' . $json->tipo;
    if (isset($GLOBALS['clientela'])) {
        echo "RIGHT NOW?";
        $clientela[0]->obtener_clientes();
    }

} else {
    //echo '#mem: \'' . file_get_contents('php://memory') . '\'';
}
echo "$content";
?>