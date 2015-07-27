<?php
//include "conexiondb.php";
require_once ('../../config.php');
require_once($CFG->dirroot.'/local/herramientas/forms.php');
global $CFG, $DB;
$id=$_POST['id'];
$delete = array (
			'id' => $id
        );

//$resultado = mysql_query("DELETE from mdl_local_herramientas Where idherramientas=$id") or die(mysql_error());

$Query = $DB->delete_records( 'local_herramientas', $delete );
           
if($Query){
    ?>
    <meta http-equiv="Refresh" content="1;url=index.php">
    <?php
}

?>
