<?php 
require 'functions.php'; 
require 'header.php';

?>
<?php if (!$_SESSION['auth']):?>

    <?php  header ('location:connexion.php')?>
    <?php endif?>
<div id="container_account">


<aside> 

<h2> Mon compte </h2>

<ul>

<li> <a href="#">Résumé</a> </li>
<li><a href="modif.php">Modifier votre mot de pass</a>  </li>
<li><a href="#">Adresse </a> </li>
<li><a href="#">Commandes</a></li>
<li><a href="#">Profil</a></li>
</ul>


</aside>


<main class="compte">


<h1> Votre compte </h1>
<article class="home_account">

<h1> bien venu </h1>
</article>


</main>

</div>





<?php 
require 'footer.php'
?>