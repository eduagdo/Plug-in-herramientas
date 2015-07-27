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
require_once (dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot.'/local/herramientas/forms.php');
global $DB, $USER, $CFG;
require_login();
$baseurl = new moodle_url('/local/herramientas/edit.php'); //clase pagina
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url($baseurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('title', 'local_herramientas'));
$PAGE->set_heading(get_string('title', 'local_herramientas'));
$PAGE->navbar->add(get_string('herramientas', 'local_herramientas'));
//$PAGE->navbar->add('index','reservar.php');
echo $OUTPUT->header(); //shows header 
//<link rel="stylesheet" href="css/style.css">

echo $OUTPUT->heading(get_string('title', 'local_herramientas'));
echo $USER->firstname . " " . $USER->lastname . "  -  " . $USER->email;
echo "<br>";
//test
/*
  $user = $DB->get_record('user', array('id'=>'2'));
  foreach($user as $data){
  echo $data . "<br>";
  }
 */
//$table = 'local_fitness';
$email = $USER->email;
//$result = $DB->get_records_sql('SELECT * FROM {local_fitness} WHERE email = ?', array($email));
//hasta aqui llega el header
$id = $_POST['id'];
$sql = "SELECT * from {local_herramientas} order by Nombre asc";
$busqueda = array(
    'id' => $id
);
$resultado = $DB->get_records_sql($sql, $busqueda);
$data = '';
foreach ($resultado as $resultados) {
    $data = array(
        $resultados->nombre,
        $resultados->codigo,
        $resultados->stock,
        $resultados->disponible,
        $resultados->categoria,
    );
};
$data [] = $data;
?>

<link href="styles.css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="container">
        <div class="main">
            <h1>Agregue sus Herramientas</h1>

            <!-- empieza input -->

            <form action="update.php" method="POST">
                <table>
                    <tr>
                        <td><input type="text" name="nombre"  value="<?php echo $data[0]; ?>" style="height: 26px;" required></td>
                        <td><input type="number" name="codigo"  value="<?php echo $data[1]; ?>" style="height: 26px;" required></td>
                        <td><input type="number" name="stock"  value="<?php echo $data[2]; ?>" style="height: 26px;" required></td>
                        <td><input type="number" name="disponible"  value="<?php echo $data[3]; ?>" style="height: 26px;" required></td>
                        <td><input type="text" name="categoria"  value="<?php echo $data[4]; ?>" style="height: 26px;" required></td>
                        <td><input type="hidden" name="id"  value="<?php echo $id; ?>" ></td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" value="Editar">
            </form>

            <!-- termino del input -->

            <br>
            <form action="index.php">
                <button type="submit" id="boton" class="btn btn-default">Cancelar edicion</button>
            </form>

        </div> <!-- container -->
        <div class="space"></div>
        <div id="flash"></div>
        <div id="show"></div>
    </div>
    <?php
//hasta aqui llega el body

    echo $OUTPUT->footer(); //shows footer 