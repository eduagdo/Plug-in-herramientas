<?php

require_once (dirname ( __FILE__ ) . '/../../config.php');
require_once($CFG->dirroot.'/local/herramientas/forms.php');
global $DB, $USER, $CFG, $OUTPUT;
require_login ();
$baseurl = new moodle_url ( '/local/herramientas/index.php' ); // clase pagina
$context = context_system::instance ();
$PAGE->set_context ( $context );
$PAGE->set_url ( $baseurl );
$PAGE->set_pagelayout ( 'standard' );
$PAGE->set_title ( get_string ( 'title', 'local_herramientas' ) );
$PAGE->set_heading ( get_string ( 'title', 'local_herramientas' ) );
$PAGE->navbar->add ( get_string ( 'herramientas', 'local_herramientas' ) );
// $PAGE->navbar->add('index','reservar.php');
echo $OUTPUT->header (); // shows header
                         // <link rel="stylesheet" href="css/style.css">

echo $OUTPUT->heading ( get_string ( 'title', 'local_herramientas' ) );
echo $USER->firstname . " " . $USER->lastname . "  -  " . $USER->email;
echo "<br>";
// test
/*
 * $user = $DB->get_record('user', array('id'=>'2'));
 * foreach($user as $data){
 * echo $data . "<br>";
 * }
 */
// $table = 'local_fitness';
$email = $USER->email;
// $result = $DB->get_records_sql('SELECT * FROM {local_fitness} WHERE email = ?', array($email));

// hasta aqui llega el header

$sql = "SELECT * from {local_herramientas} order by Nombre asc";
$resultado = $DB->get_records_sql ( $sql );

$data = '';
foreach ( $resultado as $resultados ) {
	$editurl = new moodle_url ( '/local/herramientas/edit.php', array (
			'id' => $resultados->id 
	) );
	$deleteurl = new moodle_url ( '/local/herramientas/delete.php', array (
			'id' => $resultados->id 
	) );
	$data [] = array (
			$resultados->nombre,
			$resultados->codigo,
			$resultados->stock,
			$resultados->disponible,
			$resultados->categoria,
			$OUTPUT->single_button ( $editurl, 'EDIT' ),
			$OUTPUT->single_button ( $deleteurl, 'DELETE' ) 
	);
}

$table = new html_table ();
// Creates the atributes
$table->attributes ['style'] = "text-align:center;";
// Table Headings
$table->head = array (
		'Nombre',
		'Codigo',
		'Stock',
		'Disponible',
		'Categoria',
		'Editar',
		'Eliminar' 
);
// Insert the data in the table
$table->data = $data;
// Render the table in a variable.
echo html_writer::table ( $table );
$inventariourl = new moodle_url ( '/local/herramientas/guardar.php');
echo $OUTPUT->single_button ( $inventariourl, 'Agregar Inventario' );
echo $OUTPUT->footer (); //shows footer 