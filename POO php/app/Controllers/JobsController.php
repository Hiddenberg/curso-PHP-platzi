<?php

namespace App\controllers;
use App\models\{Job,Project};
use Respect\Validation\Validator as v;

class JobsController extends BaseController {
   public function getAddJobAction($request) {
      $responseMessage = null;

      if ($request->getMethod() == 'POST'){
         
         $postData = $request->getParsedBody();
         $jobValidator = v::key('title', v::stringType()->notEmpty())
         ->key('description', v::stringType()->notEmpty())
         ->key('month', v::numericVal()->notEmpty()->max(99));
         
         try {

            $jobValidator->assert($postData);

            $files = $request->getUploadedFiles();
            $logo = $files['logo'];
            $filename = null;

            if ($logo->getError() == UPLOAD_ERR_OK) {
               $lastId = ($postData['job-type'] == 'job') ? Job::latest('id')->first()->id : Project::latest('id')->first()->id ;
               $thisId = $lastId + 1;
               var_dump($thisId);
               $filename = "ID$thisId " . $logo->getClientFilename();
               $logo->moveTo("uploads/$filename");
            }
            if ($postData['job-type'] == 'job'){      
               $job = new Job();
               $job->title = $postData['title'];
               $job->description = $postData['description'];
               $job->months = $postData['month'];
               $job->logoFile = $filename;
               $job->save();
               $filename = null;
               echo "<script>alert('Trabajo registrado correctamente')</script>";
            } else if ($postData['job-type'] == 'project'){
               $project = new Project();
               $project->title = $postData['title'];
               $project->description = $postData['description'];
               $project->months = $postData['month'];
               $project->logoFile = $filename;
               $project->save();
               $filename = null;
               echo "<script>alert('Proyecto registrado correctamente')</script>";
            }

         } catch(\Exception $e) {
            $responseMessage = "
            <div class='alert alert-primary' role='alert'>
               $e->getMessage()
            </div>
            ";
         }
      }

      return $this->renderHTML('addJob.twig', [
         'responseMessage' => $responseMessage
      ]);
   }

}