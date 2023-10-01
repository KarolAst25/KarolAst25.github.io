<!DOCTYPE html>
<html>
<head>
	<title>PruebaCorreo</title>
<link rel="shortcut icon" href="Imagenes\IconoPersonal.png" type="imag/x-icon">
	<meta charset="utf-8">
</head>
<body>
<?php
function limpiarAsunto($asunto)
{
    $cadena = "Subject";
    $longitud = strlen($cadena) + 2;
    return substr(
        iconv_mime_encode(
            $cadena,
            $asunto,
            [
                "input-charset" => "UTF-8",
                "output-charset" => "UTF-8",
            ]
        ),
        $longitud
    );
}

$asunto = limpiarAsunto("Boletín semanal");
$destinatario = "karolce2511@gmail.com";

$encabezados = "MIME-Version: 1.0" . "\r\n";

# ojo, es una concatenación:
$encabezados .= "Content-type:text/html; charset=UTF-8" . "\r\n";
$encabezados .= 'From: Luis Cabrera<contacto@parzibyte.me>' . "\r\n";

$mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Este es un mensaje</title>
    <style type="text/css">
        h1{
            color: #8bc34a;
        }
        p{
            font-size: 1rem;
        }
        img{
            width: 10rem;
            height: 10rem;
        }
    </style>
</head>
<body>
<h1>Este es un t&iacute;tulo con estilo</h1>
<p>Hola, mundo. Este es un mensaje largo</p>
<p>
Tambi&eacute;n se pueden poner links: <a href="https://parzibyte.me/blog">parzibyte.me</a>,cosas
como <strong>negritas</strong> o <code>c&oacute;digo</code>. Es decir, cualquier cosa que tenga que ver con HTML
puede enviarse en los correos.
</p>
<h1>Una imagen...</h1>
<img src="https://github.com/parzibyte.png">
</body>';
$mensaje = wordwrap($mensaje, 70, "\r\n");
$resultado = mail($destinatario, $asunto, $mensaje, $encabezados); #Mandar al final los encabezados
if ($resultado) {
    echo "Correo enviado";
} else {
    echo "Correo NO enviado";
}
?>
</body>
</html>
