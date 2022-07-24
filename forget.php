<?php

require 'functions.php'; 
require 'datapdo.php';
require 'header.php';
$post = $_POST;

if(!empty($post)){

    
                if( isset($post['email']) && (empty($post['email']) ||!filter_var($post['email'], FILTER_VALIDATE_EMAIL) )){

                  $erreur= 'entrez votre email correctement';
                }else {

                    $requet = $pdo->prepare('SELECT * FROM users WHERE email =? ');
                    $requet->execute([$post['email']]);
                    $result= $requet->fetch();

                    if ($result){

                        $user_id = $result['id_user'];
                        $tokken_reset=  tokken(60);

                        $pdo->prepare('UPDATE users SET reset_tokken =?, reset_at= NOW() where id_user = ?')->execute([$tokken_reset,$user_id]);

                        mail($post['email'], 'Rénitialisation de votre mot de passe',"pour modifier votre mot de passe cliquez sur ce lien\n\nhttp://localhost/php6/confirm_reset.php?id=$user_id&tokken=$tokken_reset");
  
                        $_SESSION['flash']['success'] = 'un mail de reinitialisation vous a été envoyer, verifiez votre boite mail';
  
                        header('location:connexion.php');
                        exit();

                    }else{

                        $_SESSION['flash']['danger'] = ' Cet Email n\'nexiste pas';
                    }

                     

          

          }

}





?>

<?php if (isset($erreur)): ?>

    <div class="erreur">
    <?= $erreur ?>
    </div>

<?php endif ?>
<h1 style=" color:white;"> Mot de passe oublier</h1>
<div class="container">


<form action="" method="POST" >


<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email">

</div>



<button type="submit"> Envoyer  </button>

</form>
</div>

<?php 
require 'footer.php'
?>