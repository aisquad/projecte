$(document).ready(
    $('#clica').click(function () {
        cadena = {id_producto: 1, cantidad: 1, incrementar: 3, tipo: 'modificar'}
        cadena = JSON.stringify(cadena)
        $.ajax({
            data: cadena,
            url: './php/pruebas/pruebas3.php',
            type: 'POST',
            dataType: 'json',
            ContentType: "text/json; charset=utf-8",
            success: function(resp){
                alert("TIPO:\t\t" + resp.tipo + "\nIDPROD:\t" + resp.id_producto +"\nCANT:\t\t"+resp.cantidad + "\nINC:\t\t" + resp.incrementar);
            }
        })
    })
)