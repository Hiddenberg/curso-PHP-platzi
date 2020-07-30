<?php
/* esta vez haremos la lista de trabajos con todas sus propiedades, pero usando objetos*/

/* vamos a declarar setters y getters para la propiedad "title" de este objeto*/
/* por lo que ahora cuando querramos utilizar el title tenemos que llamarlo u obtenerlo desde la funcion getTitle() */
class Job {
   private $title;
   public $description;
   public $visible;
   public $months;

   public function setTitle($t){
      $this->title = $t;
   }

   public function getTitle() {
      return $this->title;
   }
}

/* de esta forma declaramos las distintas variables de un objeto en php */
$job1 = new Job();
$job1->setTitle('PHP developer');
$job1->description = 'Este trabajo es genial para PHP';
$job1->visible = true;
$job1->months = 13;

$job2 = new Job();
$job2->setTitle('Python developer');
$job2->description = 'Este trabajo es genial para python';
$job2->visible = true;
$job2->months = 16;

/* NOTA: la forma de acceder a un metodo o atributo de un objeto en php es con la sintaxis $objeto->atrubuto */


/* aqui declararemos un array de objetos en lugar de uno con cada job y sus propiedades */

$jobs = [$job1,$job2];