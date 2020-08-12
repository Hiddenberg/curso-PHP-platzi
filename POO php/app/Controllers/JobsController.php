<?php

namespace App\controllers;
use App\models\{Job,Project};
use Respect\Validation\Validator as v;

class JobsController extends BaseController {
   public function getAddJobAction($request) {
      $responseMessage = null;

      if ($request->getMethod() == 'POST'){
         
         $postData = $request->getParsedBody();
         $jobValidator = v::key('title', v::stringType()->notEmpty())->key('description', v::stringType()->notEmpty());
         
         try {

            $jobValidator->assert($postData);

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

         } catch(\Exception $e) {
            $responseMessage = $e->getMessage();
         }
      }

      return $this->renderHTML('addJob.twig', [
         'responseMessage' => $responseMessage
      ]);
   }

}