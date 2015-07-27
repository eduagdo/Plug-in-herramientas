<?php

require_once (dirname (__FILE__) . '/../../config.php');
require_once($CFG->dirroot.'/local/herramientas/forms.php');
require_once($CFG->dirroot.'/local/herramientas/herramientas.php');

global $DB, $USER, $CFG;
require_login (); 

$baseurl = new moodle_url ('/local/herramientas/guardar.php'); //clase pagina
$context = context_system::instance();
$PAGE->set_context( $context );
$PAGE->set_url( $baseurl );
$PAGE->set_pagelayout ( 'standard' );

$title = "Herramientas";
$PAGE->set_title($title);
$PAGE->set_heading($title);

echo $OUTPUT->header();
echo $OUTPUT->heading($title);


echo $USER->firstname . " " . $USER->lastname . "  -  " . $USER->email;

$form = new BuscarHerramienta();
$form->display();

if($data = $form->get_data()){
	$record= new stdClass();
	$record->nombre = $data->herramienta;
	$record->codigo = $data->codigo;
	$record->stock = $data->stock;
	$record->disponible = $data->stock;
	$record->categoria = $data->categoria;
	if($insert = $DB->insert_record('local_herramientas',$record)==true)
	{
		echo 'datos ingresados correctamente';
	}
	else {
		echo 'no se han podido ingresar los datos';
	}
}

$inventariourl = new moodle_url ( '/local/herramientas/index.php');
echo $OUTPUT->single_button ( $inventariourl, 'volver' );
   
echo $OUTPUT->footer (); //shows footer 