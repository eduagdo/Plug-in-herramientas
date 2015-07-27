<?php
require_once ('../../config.php');
global $CFG, $DB;
$nombre = $_POST ['nombre'];
$codigo = $_POST ['codigo'];
$stock = $_POST ['stock'];
$categoria = $_POST ['categoria'];

if (isset ( $nombre )) {
	$insert = array (
			'nombre' => $nombre,
			'codigo' => $codigo,
			'disponible' => $stock,
			'stock' => $stock,
			'categoria' => $categoria 
	);
	
	$nuevoinventario = $DB->insert_record ( 'local_herramientas', $insert );
	if (! $nuevoinventario) {
		echo 'error';
	} else {
		echo "<div class='showbox'>";
		echo "Agregaste: ";
		echo $nombre;
		echo " </div>";
	}
}
?>