<?php
/* esta vez haremos la  */

class Job {
   public $title;
   public $description;
   public $visible;
   public $months;
}

/* de esta forma declaramos las distintas variables de un objeto en php */
$job1 = new Job();
$job1->title = 'php developer';
$job1->description = 'php developer';
$job1->visible = true;
$job1->months = 13;

/* NOTA: la forma de acceder a un metodo o atributo de un objeto en php es con la sintaxis $objeto->atrubuto */


/* aqui declararemos un array de objetos en lugar de uno con cada job y sus propiedades */

$jobs = [$job1];