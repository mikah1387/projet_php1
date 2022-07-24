<?php 
if (!session_id()){
    session_start();


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>espace membre</title>
</head>
<body>

<header class="header">

 <?php if (isset($_SESSION['auth'])) :?>
    <a href="deconnexion.php">Sign out </a>
 <?php else :?>
    <a href="index.php">Sign in </a>
   <a href="connexion.php">Login in   </a>
 <?php endif?>


</header>
 <main class="main">  
    <div style="font-weight:bold; color:#e89100;">
  

        <?php if (isset($_SESSION['flash']))  :?>
              <?php foreach ($_SESSION['flash'] as $value) :?>
                   <?= $value?>


                  <?php endforeach?>

        <?php endif?>
  
        <?php unset($_SESSION['flash'])?>

  
</div>

