<?php
/* esta vez haremos la lista de trabajos con todas sus propiedades, pero usando objetos*/

/* vamos a declarar setters y getters para la propiedad "title" de este objeto*/
/* por lo que ahora cuando querramos utilizar el title tenemos que llamarlo u obtenerlo desde la funcion getTitle() */
class Job {
   private $title;
   public $description;
   public $visible = true; /* de esta forma definimos un valor por defecto para este atributo */
   public $months;

   /* creemos un constructor para esta clase, en PHP se crea de esta manera */

   public function __construct($title, $description){
      $this->setTitle($title); /* aplicandolo de esta forma mantenemos la validacion que hicimos anteriormente para confirmar que no sea un string vacio */
      $this->description = $description;
   }

   public function setTitle($t){
      /* haremos una validacion para confirmar que no se trate de una cadena vacia cuando se declare el titulo*/
      if ($t == '') {
         $this->title = 'N/A';
      } else {
         $this->title = $t;
      }
   }

   public function getTitle() {
      return $this->title;
   }

   public function getDurationAsString() {
      $years = floor($this->months / 12);
      $residualMonths = $this->months % 12;

      if ($this->months >= 12) {
        if($residualMonths == 0 && $years == 1) {
          return "$years Year";
        } else if ($residualMonths == 0 && $years > 1){
          return "$years Years";
        } else if ($residualMonths == 1 && $years == 1){
          return "$years Year and $residualMonths month";
        } else if ($residualMonths == 1 && $years > 1){
          return "$years Years and $residualMonths month";
        } else if ($residualMonths > 1 && $years == 1){
          return "$years Year and $residualMonths months";
        } else {
          return "$years Years and $residualMonths months";
        }
      } else {
        if ($months > 1){
          return "$months months";
        } else {
          return "$month month";
        }
      }
    }
}

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


/* aqui declararemos un array de objetos en lugar de uno con cada job y sus propiedades */

$jobs = [$job1,$job2,$job3];




function printJobs($job) { /* AQUI USAMOS ESTA FUNCION PARA HACER QUE SI LOS TRABAJOS NO ESTAN SETEADOS PARA SER VISIBLES SE DETENGA LA EJECUCION DE ESTA FUNCION CON EL RETURN*/
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


