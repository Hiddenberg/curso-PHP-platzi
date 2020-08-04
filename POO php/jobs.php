<?php
/* esta vez haremos la lista de trabajos con todas sus propiedades, pero usando objetos*/

/* vamos a declarar setters y getters para la propiedad "title" de este objeto*/
/* por lo que ahora cuando querramos utilizar el title tenemos que llamarlo u obtenerlo desde la funcion getTitle() */

  require 'app/models/Job.php';
  require 'app/models/Project.php';

/* ahora tenemos con los constructores podemos declarar el titulo y la descripcion al momento de crear el nuevo Job (objeto) */
$job1 = new Job('PHP developer','Este trabajo es genial para PHP');
$job1->visible = true;
$job1->months = 13;

$job2 = new Job('Python developer','Este trabajo es genial para python');
$job2->visible = true;
$job2->months = 16;

$job3 = new Job('','Este trabajo es genial para sin titulo');
$job3->setTitle('');
$job3->description = 'Este trabajo es genial para sin titulo';
$job3->visible = true;
$job3->months = 23;

/* NOTA: la forma de acceder a un metodo o atributo de un objeto en php es con la sintaxis $objeto->atrubuto */

$project1 = new Project('Project 1', 'Description');

/* aqui declararemos un array de objetos en lugar de uno con cada job y sus propiedades */

$jobs = [$job1,$job2,$job3];

$projects = [$project1];




function printElement($job) { /* AQUI USAMOS ESTA FUNCION PARA HACER QUE SI LOS TRABAJOS NO ESTAN SETEADOS PARA SER VISIBLES SE DETENGA LA EJECUCION DE ESTA FUNCION CON EL RETURN*/
   if ($job->visible == false) {
     return;
   }
   /* echo $idx; */
   echo '<li class="work-position">';
   echo '<h5>' . $job->getTitle() . '</h5>';
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


