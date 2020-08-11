<?php

namespace App\controllers;
use App\models\{Job,Project};

class JobsController extends BaseController {
   public function getAddJobAction($request) {

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

      return $this->renderHTML('addJob.twig');
   }

}