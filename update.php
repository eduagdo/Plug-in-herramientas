<?php
require_once ('../../config.php');
global $PAGE, $CFG, $OUTPUT, $DB;
$id = intval($_POST['id']);
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$stock = $_POST['stock'];
$disponible = $_POST['disponible'];
$categoria = $_POST['categoria'];

$update = new stdClass();
$update->id= $id;
$update->nombre = $nombre;
$update->codigo = $codigo;
$update->stock = $stock;
$update->disponible = $disponible;
$update->categoria = $categoria;

if ($DB->update_record('local_herramientas', $update)) {
    ?>
    <meta http-equiv="Refresh" content="1;url=index.php">
    <?php
}
?>
