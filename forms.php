<?php

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir.'/formslib.php');

class BuscarHerramienta extends moodleform{
	
	function definition() {
        global $CFG,$DB,$USER;
 
        $mform = $this->_form; // Don't forget the underscore! 
 
        $mform->addElement('text', 'herramienta', 'herramienta');
        $mform->setType('herramienta', PARAM_TEXT);
        
        $mform->addElement('text', 'codigo', 'codigo');
        $mform->setType('codigo', PARAM_TEXT);
        
        $mform->addElement('text', 'stock', 'stock');
        $mform->setType('stock', PARAM_TEXT);
        
        $mform->addElement('text', 'categoria', 'categoria');
        $mform->setType('categoria', PARAM_TEXT);
        
        $this->add_action_buttons(false,'Agregar');
        
    }
    function validation($data, $files){
    	global $DB;
    	
    	$errors = array();
    	$herramienta=$data['herramienta'];
    	$codigo=$data['codigo'];
    	$stock=$data['stock'];
    	$categoria=$data['categoria'];
    	if($herramienta=null){
    		$errors['herramienta'] = 'Tiene que llenar el campo';
    	}
    	elseif($codigo=null){
    		$errors['codigo'] = 'Tiene que llenar el campo';
    	}
    	elseif($sotck=null){
    		$errors['stock'] = 'Tiene que llenar el campo';
    	}
    	elseif($categoria=null){
    		$errors['categoria'] = 'Tiene que llenar el campo';
    	}
    	return $errors;
    }
}