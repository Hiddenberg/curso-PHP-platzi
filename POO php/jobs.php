<?php

require_once 'vendor/autoload.php';

/* a partir de php 7 podemos agrupar los use */
use App\models\{Job, Project};


/* con esto creamos un array directamente con los registros que tengamos en la base de datos */
$jobs = Job::all();

$projects = Project::all();



/* con la interfaz printable nos aseguramos de que esto sea algo printable */
function printElement($job) { /* AQUI USAMOS ESTA FUNCION PARA HACER QUE SI LOS TRABAJOS NO ESTAN SETEADOS PARA SER VISIBLES SE DETENGA LA EJECUCION DE ESTA FUNCION CON EL RETURN*/
/*    if ($job->visible == false) {
     return;
   } */
   /* echo $idx; */
   echo '<li class="work-position">';
   echo '<h5>' . $job->title . '</h5>';
   echo '<p>' . $job->description . '</p>';
   echo '<p>' . $job->getDurationAsString() . '</p>';
   echo '<strong>Achievements:</strong>';
   echo '<ul>';
   echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
   echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
   echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
   echo '</ul>';
   echo '</li>';
 }


