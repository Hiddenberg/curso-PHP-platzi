<?php

namespace App\models;


require_once 'app/models/Printable.php';

class BaseElement implements Printable{
   protected $title; /* con la especificacion protected, este atributo solo sera accesible desde esta misma clase, o alguna clase hija */
   public $description;
   public $visible = true; /* de esta forma definimos un valor por defecto para este atributo */
   public $months = 0;

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
      if ($this->months > 1 || $this->months == 0){
        return "$this->months months";
      } else {
        return "$this->months month";
      }
    }
  }

  public function getDescription() {
    return $this->description;
  }
}
