<?php

namespace App\Controllers;
use App\models\{Job,Project};

class IndexController {
   public function indexAction(){
      echo 'indexAction';

      $jobs = Job::all();

      $projects = Project::all();
      
      $name = 'Victor Pazaran';
      $limitMonths = 2004;
      $totalMonths = 0;

      include '../views/index.php';


      }
}