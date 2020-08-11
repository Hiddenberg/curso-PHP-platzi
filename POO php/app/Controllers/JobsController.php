<?php

namespace App\controllers;
use App\models\{Job,Project};

class JobsController {
   public function getAddJobAction() {
      echo "getAddJobAction";

      if (!empty($_POST)){
         if ($_POST['job-type'] == 'job'){
      
            $job = new Job();
            $job->title = $_POST['title'];
            $job->description = $_POST['description'];
            $job->save();
            echo "<script>alert('Trabajo registrado correctamente')</script>";
         } else if ($_POST['job-type'] == 'project'){
            $project = new Project();
            $project->title = $_POST['title'];
            $project->description = $_POST['description'];
            $project->save();
            echo "<script>alert('Proyecto registrado correctamente')</script>";
         }
      
      }

      include '../views/addJob.php';
   }

}