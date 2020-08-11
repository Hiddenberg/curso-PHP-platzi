<?php

namespace App\controllers;
use App\models\{Job,Project};

class JobsController {
   public function getAddJobAction($request) {
      var_dump($request->getMethod());


      if ($request->getMethod() == 'POST'){
         $postData = $request->getParsedBody();

         if ($postData['job-type'] == 'job'){      
            $job = new Job();
            $job->title = $postData['title'];
            $job->description = $postData['description'];
            $job->save();
            echo "<script>alert('Trabajo registrado correctamente')</script>";
         } else if ($postData['job-type'] == 'project'){
            $project = new Project();
            $project->title = $postData['title'];
            $project->description = $postData['description'];
            $project->save();
            echo "<script>alert('Proyecto registrado correctamente')</script>";
         }
      
      }

      include '../views/addJob.php';
   }

}