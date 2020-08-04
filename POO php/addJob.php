<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Job</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <h1 class="addJob-title">Add Job</h1>
   <form action="addJob.php" method="post">
      <div class="input-container">
         <label for="">Tilte</label>
         <input type="text" name="title" id="">
      </div>
      </br>
      <div class="input-container">
      <label for="">Description</label>
      <input type="text" name="description" id="">
      </div>

      <button type="submit">Save</button>
      
   </form>
</body>
</html>