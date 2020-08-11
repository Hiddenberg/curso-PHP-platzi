<?php

namespace App\Controllers;
use App\models\{Job,Project};

class IndexController extends BaseController{
   public function indexAction(){
      $jobs = Job::all();

      $projects = Project::all();
      
      $name = 'Victor Pazaran';
      $limitMonths = 2004;
      $totalMonths = 0;

      
      return $this->renderHTML('index.twig', [
         'name' => $name,
         'jobs' => $jobs,
         'projects' => $projects
      ]);
      }
}