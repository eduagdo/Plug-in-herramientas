<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * MOODLE VERSION INFORMATION
 *
 *
 * @package    local
 * @copyright  Jorge Cabané (jcabane@alumnos.uai.cl)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
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