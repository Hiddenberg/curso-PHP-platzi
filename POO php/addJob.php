<?php

use App\Models\Job;

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Job</title>
   <link type="text/css" rel="stylesheet" href="E:\Cursos\Desarrollo Web\PHP platzi\src\POO php\css\style.css">
</head>
<body>
   <h1 class="addJob-title">Add Job</h1>
   <form action="addJob.php" method="post">
      <div class="input-container">
         <label for="">Title</label>
         <input type="text" name="title" id="">
      </div>
      </br>
      <div class="input-container">
      <label for="">Description</label>
      <input type="text" name="description" id="">
      </div>
      </br>
      <div class="input-container selector">
      <label for="job-type">Job Type</label>
         <select name="job-type" id="cars">
            <option value="job">Job</option>
            <option value="project">Project</option>
         </select>
      </div>

      <button type="submit">Save</button>
      
   </form>
</body>
</html>