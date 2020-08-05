<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

  protected $table = "jobs";


  /* si creamos una funcion que ya esta creada anteriormente en la clase padre, esta sera sobreescrita
  esto es un tipo de polimorfismo */
  public function getDurationAsString() {
    $years = floor($this->months / 12);
    $residualMonths = $this->months % 12;

    echo "Job duration: ";
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

}